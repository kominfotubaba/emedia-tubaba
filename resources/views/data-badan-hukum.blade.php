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
            {{-- <select name="" id="">
                <option value="">all</option>
                <option value="">siber</option>
                <option value="">cetak</option>
                <option value="">eletronik</option>
            </select> --}}
            <div class="data mt-3 m-0 p-0">
                <div class="table-responsive">
                    <table id="myTables" class="table data-table data-table-pagination data-table-standard responsive nowrap">
                        <thead>
                            <tr>
                                <th class="nom" scope="col">No</th>
                                <th class="xx" scope="col">Nama Media</th>
                                <th class="xx" scope="col">Nama Badan Hukum</th>
                                <th class="xx" scope="col">Status Verifikasi</th>
                                <th class="xx" scope="col">Kabupaten/Kota</th>
                                <th class="xx" scope="col">Pimpinan Perusahaan</th>
                                <th class="xx" scope="col">Pimpinan Redaksi</th>
                                <th class="xx" scope="col">Administrasi Perusahaan</th>
                            </tr>
                        </thead>

                        {{-- <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>PT. Test</td>
                                <td>Slamet</td>
                                <td>Mujur</td>
                                <td><a href="#">Lihat</a></td>
                                <!-- ini ngelink ke file surat pernyataan pimred -->
                                <td><a href="#">02</a></td>
                                <!-- ini ngelink ke file pengesahan kemenkumham -->
                                <td>Panaragan</td>
                                <td>Tulang Bawang Barat</td>
                                <td>Lampung</td>
                                <td>08123456789</td>
                                <td>test@gmail.com</td>
                                <td>Valid</td>
                                <td><a href="#">142.223.222.222</a></td>
                                <!-- ini ngelink ke file npwp perusahaan -->
                                <td><a href="#">123456</a></td>
                                <!-- ini ngelink ke file surat NIB -->
                                <td>6213 ; 6321 ; 4567 ; 8910 ;</td>
                                <td>1234</td>
                                <td><a href="#">13456</a></td>
                                <!-- ini ngelink ke file izin IPP -->
                                <td>PT. Sejahtera Pecetakan</td>
                                <td>Panaragan Jaya</td>
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
            $("#myTables").DataTable({
                // dom: "Bfrltip",
                //             columnDefs: [{ width: 200, targets: 0 }],
                // fixedColumns: true,
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
                ajax: '/data-all?param=badan',
                render: function(data, type, row) {
                    return '<span style="white-space:nowrap">' + data + "</span>";
                },
                columns: [{
                        'data': null,
                        'sortable': false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1
                            // return '<span>a</span>';
                        },

                    },
                    {
                        data: 'namaMedia',
                    },
                    {
                        data: 'namaPerusahaan',
                    },
                    {
                        data: 'verifikasiDewanPers',
                    },
                    {
                        data: 'alamatKabPerusahaan',
                    },
                    {
                        data: 'namaPenanggungJawab',
                    },
                    {
                        data: 'namaPimred',
                       render: function (data, type, row) {
                        console.log(row.fileSuratPernyataanPimred)
                            return `
                                <div style="display: flex; flex-direction: column; gap: 5px;">
                                    <span style="font-weight: bold; color: #333; margin-bottom: 5px;">${data}</span>
                                    <div class="btn-group" style="display: flex; gap: 5px;">
                                        <a href="https://emedia.tubaba.go.id/tmp/uploads/fileserfikatukwpimred/${row.fileSerfikatUkwPimred}" 
                                        class="btn-custom-action" 
                                        style="background-color: #5d2e2e; color: white; padding: 4px 10px; border-radius: 4px; font-size: 11px; text-decoration: none; text-align: center; border: none;">
                                        Bukti Sertifikasi Dewan Pers
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
                        render: function (data, type, row) {
                        console.log(row.fileSuratPernyataanPimred)
                            return `
                                <div style="display: flex; flex-direction: column; gap: 5px;">
                                    <div class="">
                                        <table>
                                            <tr>
                                                <td class="bold">No. AHU</td>
                                                <td>:</td>
                                                <td>${row.kumhamPerusahaan}</td>
                                            </tr>
                                            <tr>
                                                <td class="bold">NIB</td>
                                                <td>:</td>
                                                <td>${row.nibPerusahaan}</td>
                                            </tr>
                                            <tr>
                                                <td class="bold">NPWP</td>
                                                <td>:</td>
                                                <td>${row.npwpPerusahaan}</td>
                                            </tr>
                                             <tr>
                                                <td class="bold">Alamat</td>
                                                <td>:</td>
                                                <td>${row.alamatPerusahaan}</td>
                                            </tr>
                                            <tr>
                                                <td class="bold">Provinsi</td>
                                                <td>:</td>
                                                <td>${row.alamatProvPerusahaan}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            `;
                        }
                    },
                ],
                sDom: '<"row"<"col-sm-12"<"table-container"t>r>><"row"<"col-12"p>>',
                language: {
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
                        // $(this).css("background-color", "yellow");
                    });

                    $(this.api().columns().nodes()).each(function() {
                        $(this).css("text-wrap", "wrap");
                    });
                }
            });
        });
    </script>
@endpush
