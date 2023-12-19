@extends('panel_theme.master')
@section('content')
    <section class="data-perpers">
        <div class="content">
            <div class="logo d-flex justify-content-end">
                <img class="img-fluid" src="/assets/img/logo-gabung.png" alt="" />
            </div>
            <div class="row mb-4 mt-2 mt-md-0 mt-lg-0">
                <div class="col-12 jud">Data Media</div>
                <div class="col-12 mt-2">
                    Data yang ditampilkan diperoleh dari form pendaftaran kerjasama
                    antara Pemerintah Kabupaten Tulang Bawang Barat dengan Perusahaan
                    Pers pada aplikasi e-media yang diinput langsung oleh pihak
                    perusahaan pers dan diverifikasi dengan data Dewan Pers. Jika
                    terdapat ketidak sesuaian data dapat menghubungi Dinas Komunikasi
                    dan Informatika Pemerintah Kabupaten Tulang Bawang Barat melalui
                    email kominfo@tubaba.go.id.
                </div>
            </div>

            <div class="data mt-3 m-0 p-0">
                <div class="table-responsive">
                    <table id="myTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Media</th>
                                <th scope="col">Jenis Media</th>
                                <th scope="col">Tahun Berdiri</th>
                                <th scope="col">Status Verifikasi</th>
                                <th scope="col">Sertifikasi Pimred</th>
                                <th scope="col">No Sertifikasi Pimred</th>
                                <th scope="col">Afiliasi Organisasi Pers</th>
                                <th scope="col">Domisili Redaksi Media</th>
                                <th scope="col">Kanal Program Tubaba</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>SlebewNews.com</td>
                                <td>Siber</td>
                                <td>2005</td>
                                <td>Terverifikasi</td>
                                <td>Utama</td>
                                <td><a href="#">123/QQ/2009</a></td>
                                <!-- ini ngelink ke file sertifikat ukw pimred -->
                                <td><a href="#">PWI</a></td> <!-- ini ngelink ke file bukti afiliasi-->
                                <td><a href="#">Tulang Bawang Barat</a></td>
                                <!-- ini ngelink ke file bukti domisili-->
                                <td><a href="#">-</a></td> <!-- ini ngelink ke file bukti kanal-->
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
                ajax: '/data-all?param=media',
                columns: [{
                        'data': null,
                        'sortable': false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1
                        },

                    },
                    {
                        data: 'nama_media',
                    },
                    {
                        data: 'jenis_media',
                    },
                    {
                        data: 'tahun_berdiri',
                    },
                    {
                        data: 'status_verifikasi',
                    },
                    {
                        data: 'sertifikat_pimred',
                    },
                    {
                        data: 'no_sertifikat_pimred',
                    },
                    {
                        data: 'afiliasi_media',
                    },
                    {
                        data: 'domisili_redaksi',
                    },
                    {
                        data: 'kanal_program',
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
