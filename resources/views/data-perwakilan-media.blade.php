@extends('panel_theme.master')
@section('content')
    <section class="data-perpers">
        <div class="content">
            <div class="logo d-flex justify-content-end pe-lg-4 pe-md-4 pe-3">
                <img class="img-fluid" src="/assets/img/pemda.svg" alt="" />
            </div>
            <div class="row mb-4 mt-2 mt-md-0 mt-lg-0">
                <div class="col-12 jud">Data Perwakilan Media</div>
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
                        <option value="cetak">Cetak</option>
                        <option value="siber">Siber</option>
                        <option value="tv">TV</option>
                        <option value="radio">Radio</option>
                        <option value="fotografi">Fotografi</option>
                    </select>
                </div>
            </div>
            <div id="filter_result_count" class="text-muted small mb-3" aria-live="polite">Memuat data...</div>
            <div class="data mt-3 m-0 p-0">
                <div class="table-responsive">
                    <table id="myTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="nom" scope="col">No</th>
                                <th class="xx" scope="col">Nama Media</th>
                                <th class="xx" scope="col">Nama Lengkap</th>
                                <th class="xx" scope="col">Alamat</th>
                                {{-- <th class="xx" scope="col">Kabupaten</th>
                                <th class="xx" scope="col">Provinsi</th> --}}
                                {{-- <th scope="col">Telp</th>
                                <th scope="col">Email</th>
                                <th scope="col">NPWP</th> --}}
                                <th class="xx" scope="col">Sertifikasi Kompetensi</th>
                                <th class="xx" scope="col">Afiliasi Organisasi Pers</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Slamet Jaya</td>
                                <td>Tirta Kencana</td>
                                <td>Tulang Bawang Barat</td>
                                <td>Lampung</td>
                                <td>08123456789</td>
                                <td>test@gmail.com</td>
                                <td><a href="#">123.132.123</a></td> <!-- ini ngelink ke file NPWP perwakilan -->
                                <td><a href="#">newbie</a></td> <!-- ini ngelink ke file sertifikasi ukw -->
                                <td><a href="#">PWI</a></td> <!-- ini ngelink ke file kartu tanda anggota -->
                            </tr>
                        </tbody> --}}
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        // PAGE DATA PERUSAHAAN PERS
        $(document).ready(function() {
            const filterLabels = {
                '': 'Semua media',
                cetak: 'Cetak',
                siber: 'Siber',
                tv: 'TV',
                radio: 'Radio',
                fotografi: 'Fotografi'
            };

            const table = $("#myTable").DataTable({
                // dom: "Bfrltip",
                ordering: false,
                processing: true,
                serverSide: true,
                destroy: true,
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
                        request.param = 'perwakilan';
                        request.jenis_media = $('#filter_jenis_media').val();
                    },
                    dataSrc: function(response) {
                        const total = response.recordsFiltered || 0;
                        const activeFilter = $('#filter_jenis_media').val();
                        const parts = [];
                        if (activeFilter) {
                            parts.push(filterLabels[activeFilter]);
                        }
                        $('#filter_result_count').text(`${total} data` + (parts.length ? ' · ' + parts.join(' · ') : ''));
                        return response.data;
                    }
                },
                columns: [{
                        'data': null,
                        'sortable': false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1
                        },

                    },
                    {
                        data: 'namaMedia',
                    },
                    {
                        data: 'namaPerwakilan',
                    },
                    {
                        data: 'alamatPerwakilan',
                    },
                    // {
                    //    data: 'kabupaten_perwakilan',
                    // },
                    // {
                    //    data: 'provinsi_perwakilan',
                    // },
                    // {
                    //     data: 'tlpn_perwakilan',
                    // },
                    // {
                    //     data: 'email_perwakilan',
                    // },
                    // {
                    //     data: 'npwp_perwakilan',
                    // },
                    {
                        data: 'kompetensi_perwakilan',
                    },
                    {
                        data: 'afiliasi_perwakilan',
                        render: function (data, type, row) {
                            if(data){
                                return `
                                    <div style="display: flex; flex-direction: column; gap: 5px;">
                                        <span style="font-weight: bold; color: #333; margin-bottom: 5px;">${data}</span>
                                        <div class="btn-group" style="display: flex; gap: 5px;">
                                            <a href="https://emedia.tubaba.go.id/tmp/uploads/fileafiliasipersperwakilan/${row.fileafiliasiPersPerwakilan}" 
                                            class="btn-custom-action" 
                                            style="background-color: #5d2e2e; color: white; padding: 4px 10px; border-radius: 4px; font-size: 11px; text-decoration: none; text-align: center; border: none;">
                                            Detail
                                            </a>
                                        </div>
                                    </div>
                                `;
                            }else{
                                 return `
                                    <div style="display: flex; flex-direction: column; gap: 5px;">
                                        <span style="font-weight: bold; color: #333; margin-bottom: 5px;">data tidak di temukan</span>
                                    </div>
                                `;
                    }
                    }
                    },
                ],
                sDom: '<"row"<"col-sm-12"<"table-container"t>r>><"row"<"col-12"p>>',
                responsive: false,
                language: {
                    processing: 'Memuat data...',
                    emptyTable: 'Belum ada data perwakilan untuk jenis media ini.',
                    zeroRecords: 'Data perwakilan yang dicari tidak ditemukan.',
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
                            // console.log(column.search());
                            // Create input element
                            let input = document.createElement('input');
                            input.placeholder = title;
                            column.header().replaceChildren(input);

                            // Event listener for user input
                            input.addEventListener('keypress', (e) => {
                                if (e.keyCode == '13') {
                                    if (column.search() !== this.value) {
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
