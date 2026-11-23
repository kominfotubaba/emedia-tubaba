@include('admin.pengajuan._dua_step_form')

<script>
$(function () {
    const form = $('#pengajuanDuaStep');
    const csrf = $('meta[name="csrf-token"]').attr('content');
    const sync = (source, selector) => $(selector).not(source).val($(source).val());
    const toggleElectronic = () => {
        const electronic = form.find('[name="jenis_media"]').val() === 'elektronik';
        form.find('.electronic-only').toggle(electronic);
        form.find('[name="subjenis_elektronik"], [name="izinIpp"]').prop('required', electronic);
        form.find('.document-upload[data-target="fileIzinIpp"]').prop('required', electronic && !form.find('[name="fileIzinIpp"]').val());
    };
    const toggleWebsite = () => form.find('.website-field').toggle(form.find('[name="jenis_media"]').val() !== 'siber');
    const togglePrintCompany = () => {
        const print = form.find('[name="jenis_media"]').val() === 'cetak';
        form.find('.print-only').toggle(print);
        form.find('[name="namaPercetakan"], [name="alamatPercetakan"]').prop('required', print);
    };
    const toggleKbli = () => {
        const jenis = form.find('[name="jenis_media"]').val();
        const subjenis = form.find('[name="subjenis_elektronik"]').val();
        const field = form.find('[name="noKlbi"]');
        field.find('[data-kbli-option]').each(function () {
            const option = $(this);
            const mediaMatches = option.data('media').split(',').includes(jenis);
            const optionSubjenis = option.data('subjenis');
            const subjenisMatches = !optionSubjenis || optionSubjenis === subjenis;
            option.prop('disabled', !(mediaMatches && subjenisMatches)).prop('hidden', !(mediaMatches && subjenisMatches));
        });
        if (field.find('option:selected').is(':disabled')) field.val('');
    };
    form.on('input', '.media-name', function () { sync(this, '.media-name'); });
    form.on('change', '.media-type', function () { sync(this, '.media-type'); toggleElectronic(); toggleWebsite(); togglePrintCompany(); toggleKbli(); });
    form.on('change', '[name="subjenis_elektronik"]', toggleKbli);
    const toggleOrganizationOther = () => {
        if (!form.find('[data-organization]:not(:disabled)').length) return;
        form.find('.organization-other').each(function () {
            const input = $(this), other = form.find('[name="' + input.data('for') + '"]:checked').val() === 'lainnya';
            input.prop('disabled', !other).prop('required', other);
            if (!other) input.val('');
        });
    };
    form.on('change', '[data-organization]', toggleOrganizationOther);
    toggleElectronic(); toggleWebsite(); togglePrintCompany(); toggleKbli(); toggleOrganizationOther();
    form.on('change', '.document-upload', function () {
        const input = this, target = $(input).data('target'), file = input.files[0]; if (!file) return;
        const allowedTypes = ['application/pdf', 'image/png', 'image/jpeg'];
        if (!allowedTypes.includes(file.type)) { input.value = ''; alert('Dokumen harus berformat PNG, JPG, atau PDF.'); return; }
        const body = new FormData(); body.append('file', file); body.append('data', target);
        $.ajax({ url: '/pengajuan/uploads', method: 'POST', data: body, processData: false, contentType: false, headers: {'X-CSRF-TOKEN': csrf} })
            .done(response => form.find('[name="' + target + '"]').val(response.name)).fail(() => { input.value = ''; alert('Upload dokumen gagal.'); });
    });
    form.on('submit', function (event) {
        event.preventDefault(); if (!this.checkValidity()) { this.reportValidity(); return; }
        const data = {}; form.serializeArray().forEach(item => { data[item.name] = item.value; }); data.subjenis_elektronik = form.find('[name="subjenis_elektronik"]').val();
        $.ajax({ url: '/pengajuan/store', method: 'POST', data, headers: {'X-CSRF-TOKEN': csrf} })
            .done(response => { alert(response.massage || 'Data berhasil disimpan.'); window.location = '/daftar/' + new Date().getFullYear() + '/detail'; })
            .fail(xhr => alert(xhr.responseJSON?.message || xhr.responseJSON?.massage || 'Data gagal disimpan.'));
    });
});
</script>
