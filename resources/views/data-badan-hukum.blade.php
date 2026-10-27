@extends('panel_theme.master')
@section('content')
    <section class="data-perpers">
        <div class="content">
            <div class="logo d-flex justify-content-end pe-lg-4 pe-md-4 pe-3">
                <img class="img-fluid" src="/assets/img/pemda.svg" alt="" />
            </div>
            <div class="row mb-4 mt-2 mt-md-0 mt-lg-0">
                <div class="col-12 jud">Data Badan Hukum</div>
                <div class="col-12 mt-2">

                    Informasi, Data dan Dokumen yang diinput/diunggah sesuai dengan aslinya dan dapat dipertanggungjawabkan
                    legalitasnya. Bilamana terdapat kesulitan dalam menginput/mengunggah informasi, data dan dokumen dapat
                    menghubungi Diskominfo Tubaba melalui email dengan alamat kominfo@tubaba.go.id
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Jenis Media</label>
                    <select id="filter_jenis_media" class="form-control">
                        <option value="">All</option>
                        <option value="siber">Siber</option>
                        <option value="cetak">Cetak</option>
                        <option value="elektronik">Elektronik</option>
                    </select>
                </div>
            </div>
            <div id="filter_result_count" class="text-muted small mb-3" aria-live="polite">Memuat data...</div>

            <style>
                #myTables td,
                #myTables th {
                    white-space: normal !important;
                    word-break: break-word;
                    vertical-align: top;
                }
            </style>

            <div class="data mt-3 m-0 p-0">
                <div class="table-responsive">
                    <table id="myTables" class="table data-table data-table-pagination data-table-standard responsive" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="nom" scope="col">No</th>
                                <th class="xx" scope="col">Nama Media</th>
                                <th class="xx" scope="col">Badan Hukum</th>
                                <th class="xx" scope="col">Pimpinan Redaksi</th>
                                <th class="xx" scope="col">Alamat, Email &amp; No. HP</th>
                                <th class="xx" scope="col">Kepala Biro</th>
                                <th class="xx" scope="col">Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        // PAGE DATA BADAN HUKUM
        $(document).ready(function() {
            const filterLabels = {
                '': 'Semua media',
                siber: 'Siber',
                cetak: 'Cetak',
                elektronik: 'Elektronik'
            };

            const table = $("#myTables").DataTable({
                ordering: false,
                processing: true,
                serverSide: true,
                destroy: true,
                autoWidth: false,
                paging: true,
                length: 10,
                pageLength: 20,
                buttons: ['copy', 'excel', 'csv', 'print'],
                order: [
                    [0, "asc"]
                ],
                responsive: false,
                ajax: {
                    url: '/data-all',
                    data: function(request) {
                        request.param = 'badan';
                        request.jenis_media = $('#filter_jenis_media').val();
                    },
                    dataSrc: function(response) {
                        const total = response.recordsFiltered || 0;
                        const activeFilter = $('#filter_jenis_media').val();
                        const label = activeFilter ? filterLabels[activeFilter] : '';
                        $('#filter_result_count').text(`${total} data` + (label ? ' · ' + label : ''));
                        return response.data;
                    }
                },
                columns: [{
                        'data': null,
                        'sortable': false,
                        'width': '4%',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1
                        },

                    },
                    {
                        data: 'namaMedia',
                        'width': '12%',
                    },
                    {
                        data: 'namaPerusahaan',
                        'width': '14%',
                    },
                    {
                        data: 'namaPimred',
                        'width': '15%',
                        render: function(data, type, row) {
                            return `
                                <div style="display: flex; flex-direction: column; gap: 5px;">
                                    <span style="font-weight: bold; color: #333; margin-bottom: 5px;">${data ?? '-'}</span>
                                    <div class="btn-group" style="display: flex; gap: 5px; flex-wrap: wrap;">
                                        <a href="https://emedia.tubaba.go.id/tmp/uploads/fileserfikatukwpimred/${row.fileSerfikatUkwPimred}"
                                        class="btn-custom-action"
                                        style="background-color: #5d2e2e; color: white; padding: 4px 10px; border-radius: 4px; font-size: 11px; text-decoration: none; text-align: center; border: none;">
                                        Sertifikat
                                        </a>

                                        <a href="https://emedia.tubaba.go.id/tmp/uploads/filesuratpernyataanpimred/${row.fileSuratPernyataanPimred}"
                                        class="btn-custom-action"
                                        style="background-color: #d4af37; color: white; padding: 4px 10px; border-radius: 4px; font-size: 11px; text-decoration: none; text-align: center; border: none;">
                                        Surat Pernyataan Pimred
                                        </a>
                                    </div>
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'alamatPerusahaan',
                        'width': '35%',
                        render: function(data, type, row) {
                            const kota = [row.alamatKabPerusahaan, row.alamatProvPerusahaan]
                                .filter(function(v) {
                                    return v && v !== '-';
                                })
                                .join(', ');
                            const telp = row.tlpnPerusahaan ? `<span style="margin-top: 4px; display: inline-block;"><strong>Telp:</strong> ${row.tlpnPerusahaan}</span>` : '';
                            const email = row.emailPerusahaan ? `<span style="margin-top: 4px; display: inline-block;"><strong>Email:</strong> ${row.emailPerusahaan}</span>` : '';
                            return `
                                <div style="display: flex; flex-direction: column; gap: 3px;">
                                    <span>${data ?? '-'}</span>
                                    ${kota ? `<span class="text-muted" style="font-size: 12px;">${kota}</span>` : ''}
                                    ${email}
                                    ${telp}
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'namaPenanggungJawab',
                        'width': '7%',
                    },
                    {
                        data: 'status_persyaratan',
                        'width': '9%',
                        render: function(data, type, row) {
                            const memenuhi = data === 'Memenuhi syarat';
                            const warna = memenuhi ? '#2e7d32' : '#b3261e';
                            const latar = memenuhi ? '#e8f5e9' : '#fdecea';
                            return `
                                <div style="display: flex; flex-direction: column; gap: 4px;">
                                    <span style="display: inline-block; padding: 4px 10px; border-radius: 999px; background-color: ${latar}; color: ${warna}; font-weight: 700; font-size: 12px; text-align: center;">
                                        ${data ?? '-'}
                                    </span>
                                    <span class="text-muted" style="font-size: 12px;">${row.verifikasiDewanPers ?? '-'}</span>
                                </div>
                            `;
                        }
                    },
                ],
                sDom: '<"row"<"col-sm-12"<"table-container"t>r>><"row"<"col-12"p>>',
                language: {
                    processing: 'Memuat data...',
                    emptyTable: 'Belum ada data badan hukum untuk jenis media ini.',
                    zeroRecords: 'Data yang dicari tidak ditemukan.',
                    paginate: {
                        // previous: '<i class="cs-chevron-left"></i>',
                        // next: '<i class="cs-chevron-right"></i>',
                    },
                },
                initComplete: function() {
                    this.api()
                        .columns()
                        .every(function() {
                            let column = this;
                            let title = column.header().textContent;
                            // Create input element
                            let input = document.createElement('input');
                            input.placeholder = title;
                            column.header().replaceChildren(input);

                            // Event listener for user input
                            input.addEventListener('keypress', (e) => {
                                if (e.keyCode == '13') {
                                    if (column.search() !== input.value) {
                                        column.search(input.value).draw();
                                    }
                                }
                            });
                        });


                    var data = $(this.api().columns(0).nodes()).each(function() {
                        // $(this).css("background-color", "yellow");
                        $(this).attr('class', 'hasu');
                    });

                    $(this.api().columns().nodes()).each(function() {
                        $(this).css("text-wrap", "wrap");
                    });
                }
            });

            $('#filter_jenis_media').on('change', function() {
                $('#filter_result_count').text('Memuat data...');
                table.ajax.reload();
            });
        });
    </script>
@endpush
