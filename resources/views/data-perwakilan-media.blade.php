@extends('panel_theme.master')
@section('content')
    <section class="data-perpers">
        <div class="content">
            <div class="logo d-flex justify-content-end">
                <img class="img-fluid" src="/assets/img/logo-gabung.png" alt="" />
            </div>
            <div class="row mb-4 mt-2 mt-md-0 mt-lg-0">
                <div class="col-12 jud">Data Perwakilan Media</div>
                <div class="col-12 mt-2">

                    Informasi, Data dan Dokumen yang diinput/diunggah sesuai dengan aslinya dan dapat dipertanggungjawabkan
                    legalitasnya. Bilamana terdapat kesulitan dalam menginput/mengunggah informasi, data dan dokumen dapat
                    menghubungi Diskominfo Tubaba melalui email dengan alamat kominfo@tubaba.go.id
                </div>
            </div>

            <div class="data mt-3 m-0 p-0">
                <div class="table-responsive">
                    <table id="myTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Kabupaten</th>
                                <th scope="col">Provinsi</th>
                                <th scope="col">Telp</th>
                                <th scope="col">Email</th>
                                <th scope="col">NPWP</th>
                                <th scope="col">Sertifikasi Kompetensi</th>
                                <th scope="col">Afiliasi Organisasi Pers</th>
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
            $("#myTable").DataTable({
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
                ajax: '/data-all?param=perwakilan',
                columns: [{
                        'data': null,
                        'sortable': false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1
                        },

                    },
                    {
                        data: 'nama_biro_perwakilan',
                    },
                    {
                        data: 'alamat_perwakilan',
                    },
                    {
                        data: 'kabupaten_perwakilan',
                    },
                    {
                        data: 'provinsi_perwakilan',
                    },
                    {
                        data: 'tlpn_perwakilan',
                    },
                    {
                        data: 'email_perwakilan',
                    },
                    {
                        data: 'npwp_perwakilan',
                    },
                    {
                        data: 'kompetensi_perwakilan',
                    },
                    {
                        data: 'afiliasi_perwakilan',
                    },
                ],
                sDom: '<"row"<"col-sm-12"<"table-container"t>r>><"row"<"col-12"p>>',
                responsive: false,
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
