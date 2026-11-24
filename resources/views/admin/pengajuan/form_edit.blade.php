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
    const fieldLabel = field => $(field).closest('[class*="col-"]').find('.form-label').first().text().trim() || field.name;
    const showFirstInvalidField = () => { const field=form.find(':input').filter(function(){return !this.disabled&&!this.validity.valid;}).first()[0]; if(!field)return; const pane=$(field).closest('.tab-pane'), tab=form.closest('.card').find(`[data-bs-toggle="tab"][href="#${pane.attr('id')}"]`)[0]; if(tab&&window.bootstrap)bootstrap.Tab.getOrCreateInstance(tab).show(); field.reportValidity(); };
    form[0].addEventListener('invalid', event => { const field=event.target, label=fieldLabel(field); let message=''; if(field.validity.valueMissing)message=`${label} wajib diisi.`; else if(field.validity.typeMismatch)message=field.type==='email'?`${label} harus menggunakan alamat email yang valid.`:`${label} harus berupa URL yang valid.`; else if(field.validity.patternMismatch)message=field.title||`${label} memiliki format yang tidak valid.`; field.setCustomValidity(message); }, true);
    form.on('input change', ':input', function(){this.setCustomValidity('');});
    const setupKbliTags = () => { const input=form.find('#noKlbi')[0]; if(!input || input.disabled || typeof Tagify==='undefined')return; new Tagify(input,{whitelist:[{value:'58120',title:'Penerbitan Surat Kabar'},{value:'58130',title:'Penerbitan Jurnal dan Penerbitan Berkala'},{value:'60101',title:'Radio Analog'},{value:'60102',title:'Radio Digital'},{value:'60202',title:'Televisi Digital'},{value:'60311',title:'Aktivitas Kantor Berita oleh Pemerintah'},{value:'60312',title:'Aktivitas Kantor Berita oleh Swasta'}],enforceWhitelist:true,duplicates:false,originalInputValueFormat:values=>values.map(item=>item.value).join(', '),dropdown:{enabled:0,maxItems:7,closeOnSelect:false},templates:{dropdownItem:function(item){return `<div class="tagify__dropdown__item d-flex justify-content-between gap-3" ${this.getAttributes(item)}><span>${item.value}</span><small class="text-muted text-end">${item.title}</small></div>`;}}}); };
    const toggle = () => { const on = form.find('[name="jenis_media"]').val() === 'elektronik'; form.find('.electronic-only').toggle(on); form.find('[name="subjenis_elektronik"], [name="izinIpp"]').prop('required', on); form.find('.document-upload[data-target="fileIzinIpp"]').prop('required', on && !form.find('[name="fileIzinIpp"]').val()); };
    const toggleWebsite = () => form.find('.website-field').toggle(form.find('[name="jenis_media"]').val() !== 'siber');
    const togglePrintCompany = () => { const print=form.find('[name="jenis_media"]').val()==='cetak'; form.find('.print-only').toggle(print); form.find('[name="namaPercetakan"], [name="alamatPercetakan"]').prop('required', print); };
    form.on('input', '.media-name', function(){ $('.media-name').not(this).val(this.value); });
    form.on('change', '.media-type', function(){ $('.media-type').not(this).val(this.value); toggle(); toggleWebsite(); togglePrintCompany(); });
    const toggleOrganizationOther = () => { form.find('.organization-other').each(function(){ const input=$(this), other=form.find('[name="'+input.data('for')+'"]:checked').val()==='lainnya'; input.prop('disabled',!other).prop('required',other); if(!other)input.val(''); }); };
    form.on('change','[data-organization]',toggleOrganizationOther);
    setupKbliTags();
    toggleOrganizationOther();
    toggle(); toggleWebsite(); togglePrintCompany();
    form.on('change', '.document-upload', function(){ const file=this.files[0], target=$(this).data('target'), allowedTypes=['application/pdf','image/png','image/jpeg']; if(!file)return; if(!allowedTypes.includes(file.type)){this.value='';alert('Dokumen harus berformat PNG, JPG, atau PDF.');return;} const body=new FormData();body.append('file',file);body.append('data',target);$.ajax({url:'/pengajuan/uploads',method:'POST',data:body,processData:false,contentType:false,headers:{'X-CSRF-TOKEN':csrf}}).done(r=>form.find('[name="'+target+'"]').val(r.name)).fail(()=>alert('Upload dokumen gagal.')); });
    form.on('submit', function(e){ e.preventDefault(); if(!this.checkValidity()){showFirstInvalidField();return;} const data={};form.serializeArray().forEach(x=>data[x.name]=x.value);data.subjenis_elektronik=form.find('[name="subjenis_elektronik"]').val();$.ajax({url:'/pengajuan/update',method:'PUT',data,headers:{'X-CSRF-TOKEN':csrf}}).done(r=>{alert(r.massage);window.location='/daftar/'+r.tahun_buka+'/detail';}).fail(x=>{const errors=x.responseJSON?.errors;alert(errors?Object.values(errors).flat().join('\n'):(x.responseJSON?.message||x.responseJSON?.massage||'Data gagal diperbarui.'));}); });
});
</script>
@endpush
