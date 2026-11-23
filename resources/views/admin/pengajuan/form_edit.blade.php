@extends('panel.master')
@section('content')
<main>
    @foreach($media_data as $record)
        <div class="h3 text-primary text-capitalize">Edit Pengajuan Perusahaan Pers</div>
        @include('admin.pengajuan._dua_step_form', ['record' => $record])
    @endforeach
</main>
@endsection
@push('script')
<script>
$(function () {
    const form = $('#pengajuanDuaStep'), csrf = $('meta[name="csrf-token"]').attr('content');
    const toggle = () => { const on = form.find('[name="jenis_media"]').val() === 'elektronik'; form.find('.electronic-only').toggle(on); form.find('[name="subjenis_elektronik"], [name="izinIpp"]').prop('required', on); form.find('.document-upload[data-target="fileIzinIpp"]').prop('required', on && !form.find('[name="fileIzinIpp"]').val()); };
    const toggleWebsite = () => form.find('.website-field').toggle(form.find('[name="jenis_media"]').val() !== 'siber');
    const togglePrintCompany = () => { const print=form.find('[name="jenis_media"]').val()==='cetak'; form.find('.print-only').toggle(print); form.find('[name="namaPercetakan"], [name="alamatPercetakan"]').prop('required', print); };
    const toggleKbli = () => { const jenis=form.find('[name="jenis_media"]').val(), subjenis=form.find('[name="subjenis_elektronik"]').val(), field=form.find('[name="noKlbi"]'); field.find('[data-kbli-option]').each(function(){ const option=$(this), mediaMatches=option.data('media').split(',').includes(jenis), optionSubjenis=option.data('subjenis'), subjenisMatches=!optionSubjenis||optionSubjenis===subjenis; option.prop('disabled',!(mediaMatches&&subjenisMatches)).prop('hidden',!(mediaMatches&&subjenisMatches)); }); if(field.find('option:selected').is(':disabled'))field.val(''); };
    form.on('input', '.media-name', function(){ $('.media-name').not(this).val(this.value); });
    form.on('change', '.media-type', function(){ $('.media-type').not(this).val(this.value); toggle(); toggleWebsite(); togglePrintCompany(); toggleKbli(); });
    form.on('change', '[name="subjenis_elektronik"]', toggleKbli);
    const toggleOrganizationOther = () => { form.find('.organization-other').each(function(){ const input=$(this), other=form.find('[name="'+input.data('for')+'"]:checked').val()==='lainnya'; input.prop('disabled',!other).prop('required',other); if(!other)input.val(''); }); };
    form.on('change','[data-organization]',toggleOrganizationOther);
    toggleOrganizationOther();
    toggle(); toggleWebsite(); togglePrintCompany(); toggleKbli();
    form.on('change', '.document-upload', function(){ const file=this.files[0], target=$(this).data('target'), allowedTypes=['application/pdf','image/png','image/jpeg']; if(!file)return; if(!allowedTypes.includes(file.type)){this.value='';alert('Dokumen harus berformat PNG, JPG, atau PDF.');return;} const body=new FormData();body.append('file',file);body.append('data',target);$.ajax({url:'/pengajuan/uploads',method:'POST',data:body,processData:false,contentType:false,headers:{'X-CSRF-TOKEN':csrf}}).done(r=>form.find('[name="'+target+'"]').val(r.name)).fail(()=>alert('Upload dokumen gagal.')); });
    form.on('submit', function(e){ e.preventDefault(); if(!this.checkValidity()){this.reportValidity();return;} const data={};form.serializeArray().forEach(x=>data[x.name]=x.value);data.subjenis_elektronik=form.find('[name="subjenis_elektronik"]').val();$.ajax({url:'/pengajuan/update',method:'PUT',data,headers:{'X-CSRF-TOKEN':csrf}}).done(r=>{alert(r.massage);window.location='/daftar/'+r.tahun_buka+'/detail';}).fail(x=>alert(x.responseJSON?.message||x.responseJSON?.massage||'Data gagal diperbarui.')); });
});
</script>
@endpush
