@extends('panel_theme.master')
@section('content')
    <section class="data-perpers">
        <div class="content">
            <div class="logo d-flex justify-content-end">
                <img class="img-fluid" src="/assets/img/logo-gabung.png" alt="" />
            </div>
            <div class="row mb-4 mt-2 mt-md-0 mt-lg-0">
                <div class="col-12 jud">Data Badan Hukum</div>
                <div class="col-12 mt-2">

                    Informasi, Data dan Dokumen yang diinput/diunggah sesuai dengan aslinya dan dapat dipertanggungjawabkan
                    legalitasnya. Bilamana terdapat kesulitan dalam menginput/mengunggah informasi, data dan dokumen dapat
                    menghubungi Diskominfo Tubaba melalui email dengan alamat kominfo@tubaba.go.id
                </div>
            </div>

            <div class="data mt-3 m-0 p-0">
                <div class="table-responsive">
                    <table id="myTables"
                        class="table data-table data-table-pagination data-table-standard responsive nowrap">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Badan Hukum</th>
                                <th scope="col">Penanggung Jawab</th>
                                <th scope="col">Pimpinan Redaksi</th>
                                <th scope="col">Surat Pernyataan Pimred</th>
                                <th scope="col">No Pengesahan KemenkumHAM</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Kabupaten</th>
                                <th scope="col">Provinsi</th>
                                <th scope="col">Telp</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status KSWP</th>
                                <th scope="col">NPWP</th>
                                <th scope="col">NIB</th>
                                <th scope="col">KBLI</th>
                                <th scope="col">KBKI</th>
                                <th scope="col">IZIN IPP</th>
                                <th scope="col">Nama Percetakan</th>
                                <th scope="col">Alamat Percetakan</th>
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
                columns: [{
                        'data': null,
                        'sortable': false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1
                        },

                    },
                    {
                        data: 'nama_perusahaan',
                    },
                    {
                        data: 'penanggung_jawab',
                    },
                    {
                        data: 'nama_pimred',
                    },
                    {
                        data: 'surat_pernyataan_pimred',
                    },
                    {
                        data: 'kumham_perusahaan',
                    },
                    {
                        data: 'alamat_perusahaan',
                    },
                    {
                        data: 'alamat_kabupaten',
                    },
                    {
                        data: 'alamat_provinsi',
                    },
                    {
                        data: 'tlpn_perusahaan',
                    },
                    {
                        data: 'email_perusahaan',
                    },
                    {
                        data: 'status_kswp',
                    },
                    {
                        data: 'npwp_perusahaan',
                    },
                    {
                        data: 'nib_perusahaan',
                    },
                    {
                        data: 'klbi_perusahaan',
                    },
                    {
                        data: 'kbki_perusahaan',
                    },
                    {
                        data: 'izin_ipp_perusahaan',
                    },
                    {
                        data: 'nama_percetakan',
                    },
                    {
                        data: 'alamat_percetakan',
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
                }
            });
        });
    </script>
@endpush
