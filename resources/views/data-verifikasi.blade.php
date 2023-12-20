@extends('panel_theme.master')
@section('content')
    <section class="data-perpers">
        <div class="content">
            <div class="logo d-flex justify-content-end">
                <img class="img-fluid" src="/assets/img/logo-gabung.png" alt="" />
            </div>
            <div class="row mb-4 mt-2 mt-md-0 mt-lg-0">
                <div class="col-12 jud">Data Verifikasi</div>
                <div class="col-12 mt-2">
                    Daftar Media yang telah melalui tahap verifikasi dan validasi, untuk dapat dijadikan rujukan bagi
                    instansi vertikal, OPD, Pemerintahan Tiyuh dan pihak-pihak yang berkepentingan di Kabupaten Tulang
                    Bawang Barat.
                </div>

            </div>

            <div class="data mt-3 m-0 p-0">
                <div class="table-responsive">
                    <table id="myTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Perusahaan</th>
                                <th scope="col">Nama Media</th>
                                <th scope="col">Jenis Media</th>
                                <th scope="col">Keterangan Verval</th>
                                <th scope="col">Kategori</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">-</th>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- @push('script')
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
                            input.addEventListener('keypress', () => {
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
@endpush --}}
