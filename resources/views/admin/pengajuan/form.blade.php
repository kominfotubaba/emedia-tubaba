@include('admin.pengajuan._dua_step_form')

<script>
$(function () {
    const form = $('#pengajuanDuaStep');
    const csrf = $('meta[name="csrf-token"]').attr('content');
    const sync = (source, selector) => $(selector).not(source).val($(source).val());
    const fieldLabel = field => $(field).closest('[class*="col-"]').find('.form-label').first().text().trim() || field.name;
    const showFirstInvalidField = () => {
        const field = form.find(':input').filter(function () { return !this.disabled && !this.validity.valid; }).first()[0];
        if (!field) return;
        const pane = $(field).closest('.tab-pane');
        const tab = form.closest('.card').find(`[data-bs-toggle="tab"][href="#${pane.attr('id')}"]`)[0];
        if (tab && window.bootstrap) bootstrap.Tab.getOrCreateInstance(tab).show();
        field.reportValidity();
    };
    form[0].addEventListener('invalid', event => {
        const field = event.target;
        const label = fieldLabel(field);
        let message = '';
        if (field.validity.valueMissing) message = `${label} wajib diisi.`;
        else if (field.validity.typeMismatch) message = field.type === 'email' ? `${label} harus menggunakan alamat email yang valid.` : `${label} harus berupa URL yang valid.`;
        else if (field.validity.patternMismatch) message = field.title || `${label} memiliki format yang tidak valid.`;
        field.setCustomValidity(message);
    }, true);
    form.on('input change', ':input', function () { this.setCustomValidity(''); });
    const setupKbliTags = () => {
        const input = form.find('#noKlbi')[0];
        if (!input || input.disabled || typeof Tagify === 'undefined') return;
        new Tagify(input, {
            whitelist: [
                { value: '58120', title: 'Penerbitan Surat Kabar' },
                { value: '58130', title: 'Penerbitan Jurnal dan Penerbitan Berkala' },
                { value: '60101', title: 'Radio Analog' },
                { value: '60102', title: 'Radio Digital' },
                { value: '60202', title: 'Televisi Digital' },
                { value: '60311', title: 'Aktivitas Kantor Berita oleh Pemerintah' },
                { value: '60312', title: 'Aktivitas Kantor Berita oleh Swasta' },
            ],
            enforceWhitelist: true,
            duplicates: false,
            originalInputValueFormat: values => values.map(item => item.value).join(', '),
            dropdown: { enabled: 0, maxItems: 7, closeOnSelect: false },
            templates: {
                dropdownItem: function (item) {
                    return `<div class="tagify__dropdown__item d-flex justify-content-between gap-3" ${this.getAttributes(item)}><span>${item.value}</span><small class="text-muted text-end">${item.title}</small></div>`;
                },
            },
        });
    };
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
    form.on('input', '.media-name', function () { sync(this, '.media-name'); });
    form.on('change', '.media-type', function () { sync(this, '.media-type'); toggleElectronic(); toggleWebsite(); togglePrintCompany(); });
    const toggleOrganizationOther = () => {
        if (!form.find('[data-organization]:not(:disabled)').length) return;
        form.find('.organization-other').each(function () {
            const input = $(this), other = form.find('[name="' + input.data('for') + '"]:checked').val() === 'lainnya';
            input.prop('disabled', !other).prop('required', other);
            if (!other) input.val('');
        });
    };
    form.on('change', '[data-organization]', toggleOrganizationOther);
    setupKbliTags();
    toggleElectronic(); toggleWebsite(); togglePrintCompany(); toggleOrganizationOther();
    form.on('change', '.document-upload', function () {
        const input = this, target = $(input).data('target'), file = input.files[0]; if (!file) return;
        const allowedTypes = ['application/pdf', 'image/png', 'image/jpeg'];
        if (!allowedTypes.includes(file.type)) { input.value = ''; alert('Dokumen harus berformat PNG, JPG, atau PDF.'); return; }
        const body = new FormData(); body.append('file', file); body.append('data', target);
        $.ajax({ url: '/pengajuan/uploads', method: 'POST', data: body, processData: false, contentType: false, headers: {'X-CSRF-TOKEN': csrf} })
            .done(response => form.find('[name="' + target + '"]').val(response.name)).fail(() => { input.value = ''; alert('Upload dokumen gagal.'); });
    });
    form.on('submit', function (event) {
        event.preventDefault(); if (!this.checkValidity()) { showFirstInvalidField(); return; }
        const data = {}; form.serializeArray().forEach(item => { data[item.name] = item.value; }); data.subjenis_elektronik = form.find('[name="subjenis_elektronik"]').val();
        $.ajax({ url: '/pengajuan/store', method: 'POST', data, headers: {'X-CSRF-TOKEN': csrf} })
            .done(response => { alert(response.massage || 'Data berhasil disimpan.'); window.location = '/daftar/' + new Date().getFullYear() + '/detail'; })
            .fail(xhr => {
                const errors = xhr.responseJSON?.errors;
                alert(errors ? Object.values(errors).flat().join('\n') : (xhr.responseJSON?.message || xhr.responseJSON?.massage || 'Data gagal disimpan.'));
            });
    });
});
</script>
