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
    const toTitleCase = value => value.toLocaleLowerCase('id-ID').replace(/(^|[\s-])\p{L}/gu, match => match.toLocaleUpperCase('id-ID'));
    const fieldLabel = field => $(field).closest('[class*="col-"]').find('.form-label').first().text().trim() || field.name;
    const fieldContainer = field => $(field).closest('[class*="col-"]').first();
    const clearFieldWarning = field => { const container=fieldContainer(field); $(field).removeClass('is-invalid'); container.find('.client-validation-feedback').remove(); };
    const showFieldWarning = (field, message) => { const container=fieldContainer(field); clearFieldWarning(field); $(field).addClass('is-invalid'); container.append(`<div class="invalid-feedback d-block client-validation-feedback">${message}</div>`); };
    const validationMessage = field => { const label=fieldLabel(field); if(field.validity.valueMissing)return field.dataset.validationMessage||`${label} wajib diisi.`; if(field.validity.typeMismatch)return field.type==='email'?`${label} harus menggunakan alamat email yang valid.`:`${label} harus berupa URL yang valid.`; if(field.validity.patternMismatch)return field.title||`${label} memiliki format yang tidak valid.`; return field.validationMessage||`${label} tidak valid.`; };
    const validateScope = (scope=form) => { const invalidFields=[],pimred=form.find('[name="namaPimred"]').val().trim().toLocaleLowerCase('id-ID'),pimprus=form.find('[name="namaPimprus"]').val().trim().toLocaleLowerCase('id-ID'),sameLeadershipName=pimred!==''&&pimred===pimprus; scope.find(':input').each(function(){ if(this.disabled||this.type==='hidden')return; this.setCustomValidity(''); if(sameLeadershipName&&['namaPimred','namaPimprus'].includes(this.name)){const message='Nama Pimpinan Redaksi tidak boleh sama dengan Nama Pimpinan Perusahaan.';this.setCustomValidity(message);showFieldWarning(this,message);invalidFields.push(this);return;} if(this.validity.valid)return clearFieldWarning(this); const message=validationMessage(this); this.setCustomValidity(message); showFieldWarning(this,message); invalidFields.push(this); }); scope.find('.client-validation-summary').remove(); if(invalidFields.length){scope.prepend(`<div class="alert alert-danger client-validation-summary" role="alert">Data Perusahaan Pers belum lengkap. Lengkapi field yang diberi tanda merah.</div>`);invalidFields[0].focus();} return invalidFields.length===0; };
    form[0].addEventListener('invalid', event => { const field=event.target; field.setCustomValidity(''); const message=validationMessage(field); field.setCustomValidity(message); showFieldWarning(field,message); }, true);
    form.on('input change', ':input', function(){this.setCustomValidity('');clearFieldWarning(this);$(this).closest('.tab-pane').find('.client-validation-summary').remove();});
    const setupKbliTags = () => { const input=form.find('#noKlbi')[0]; if(!input || input.disabled || typeof Tagify==='undefined')return; new Tagify(input,{whitelist:[{value:'58120',title:'Penerbitan Surat Kabar'},{value:'58130',title:'Penerbitan Jurnal dan Penerbitan Berkala'},{value:'60101',title:'Radio Analog'},{value:'60102',title:'Radio Digital'},{value:'60202',title:'Televisi Digital'},{value:'60311',title:'Aktivitas Kantor Berita oleh Pemerintah'},{value:'60312',title:'Aktivitas Kantor Berita oleh Swasta'}],enforceWhitelist:false,duplicates:false,originalInputValueFormat:values=>values.map(item=>item.value).join(', '),dropdown:{enabled:0,maxItems:7,closeOnSelect:false},templates:{dropdownItem:function(item){return `<div class="tagify__dropdown__item d-flex justify-content-between gap-3" ${this.getAttributes(item)}><span>${item.value}</span><small class="text-muted text-end">${item.title}</small></div>`;}}}); };
    const toggle = () => { const on = form.find('[name="jenis_media"]').val() === 'elektronik'; form.find('.electronic-only').toggle(on); form.find('[name="subjenis_elektronik"], [name="izinIpp"]').prop('required', on); form.find('.document-upload[data-target="fileIzinIpp"]').prop('required', on && !form.find('[name="fileIzinIpp"]').val()); };
    const toggleWebsite = () => form.find('.website-field').toggle(form.find('[name="jenis_media"]').val() !== 'siber');
    const togglePrintCompany = () => { const print=form.find('[name="jenis_media"]').val()==='cetak'; form.find('.print-only').toggle(print); form.find('[name="namaPercetakan"], [name="alamatPercetakan"]').prop('required', print); };
    const togglePimredStatement = () => { const madya=form.find('[name="jenisSerfikatUkwPimred"]').val()==='madya', upload=form.find('.document-upload[data-target="fileSuratPernyataanPimred"]'); form.find('.madya-only').toggle(madya); upload.prop('disabled',!madya).prop('required',madya&&!form.find('[name="fileSuratPernyataanPimred"]').val()); };
    form.on('input', '.title-case', function(){ const start=this.selectionStart, end=this.selectionEnd, titleCased=toTitleCase(this.value); if(this.value===titleCased)return; this.value=titleCased; this.setSelectionRange(start,end); });
    const duplicateTimers = new WeakMap();
    const checkDuplicate = input => { clearTimeout(duplicateTimers.get(input)); const container=$(input).closest('[class*="col-"]').first(); container.find('.duplicate-warning').remove(); if(!input.name||!input.value.trim()||input.disabled)return; duplicateTimers.set(input,setTimeout(()=>{ const value=input.value.trim(); $.post('/pengajuan/check-duplicate',{_token:csrf,field:input.name,value,pengajuan_no:form.find('[name="pengajuan_no"]').val()}).done(result=>{ if(!result.duplicate||input.value.trim()!==value)return; container.append(`<div class="text-warning small mt-1 duplicate-warning">${result.message}</div>`); }); },500)); };
    form.on('input change','input:not([type="hidden"]):not([type="file"]):not(:radio):not(:checkbox):not(.skip-duplicate-check)',function(){ checkDuplicate(this); });
    form.on('input', '.media-name', function(){ $('.media-name').not(this).val(this.value); });
    form.on('change', '.media-type', function(){ $('.media-type').not(this).val(this.value); toggle(); toggleWebsite(); togglePrintCompany(); });
    const toggleOrganizationOther = () => { form.find('.organization-other').each(function(){ const input=$(this), other=form.find('[name="'+input.data('for')+'"]:checked').val()==='lainnya'; input.prop('disabled',!other).prop('required',other); if(!other)input.val(''); }); };
    form.on('change','[data-organization]',toggleOrganizationOther);
    form.on('change','[name="jenisSerfikatUkwPimred"]',togglePimredStatement);
    form.on('click', '.next-tab', function(){ const companyPane=form.find('#perusahaanPers'); if(!validateScope(companyPane))return; const next=$(this).data('next-tab'); if(next)document.querySelector(next).click(); });
    setupKbliTags();
    toggleOrganizationOther();
    toggle(); toggleWebsite(); togglePrintCompany(); togglePimredStatement();
    form.on('change', '.document-upload', function(){ const input=this, file=input.files[0], target=$(input).data('target'); if(!file)return; const extension=file.name.split('.').pop().toLowerCase(); if(!['pdf','png','jpg','jpeg'].includes(extension)){input.value='';alert('Dokumen harus berformat PDF, PNG, JPG, atau JPEG.');return;} if(file.size>10*1024*1024){input.value='';alert('Ukuran dokumen maksimal 10 MB.');return;} const body=new FormData();body.append('file',file);body.append('data',target);$.ajax({url:'/pengajuan/uploads',method:'POST',data:body,processData:false,contentType:false,headers:{'X-CSRF-TOKEN':csrf}}).done(r=>form.find('[name="'+target+'"]').val(r.name)).fail(xhr=>{input.value='';const message=xhr.responseJSON?.errors?.file?.[0]||xhr.responseJSON?.message||'Upload dokumen gagal. Silakan coba lagi.';alert(message);}); });
    form.on('submit', function(e){ e.preventDefault(); if(!validateScope(form))return; const data={};form.serializeArray().forEach(x=>data[x.name]=x.value);data.subjenis_elektronik=form.find('[name="subjenis_elektronik"]').val();$.ajax({url:'/pengajuan/update',method:'PUT',data,headers:{'X-CSRF-TOKEN':csrf}}).done(r=>{alert(r.massage);window.location='/daftar/'+r.tahun_buka+'/detail';}).fail(x=>{const errors=x.responseJSON?.errors;alert(errors?Object.values(errors).flat().join('\n'):(x.responseJSON?.message||x.responseJSON?.massage||'Data gagal diperbarui.'));}); });
});
</script>
@endpush
