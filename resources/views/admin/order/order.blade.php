@extends('panel.master')
@section('content')
    <main>
        <section class="scroll-section" id="title">
            <div class="page-title-container">
                <h1 class="mb-0 pb-0 display-4">Daftar Order</h1>
                <div id='tahuns' hidden>{{ $tahun }}</div>
            </div>
        </section>
        <div>
            <section class="scroll-section" id="hover">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-5 col-lg-3 col-xxl-2 mb-1">
                                <div
                                    class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 border border-separator bg-foreground search-sm">
                                    <input class="form-control form-control-sm datatable-search" placeholder="Search"
                                        data-datatable="#tbOrder">
                                    <span class="search-magnifier-icon">
                                        <i data-acorn-icon="search"></i>
                                    </span>
                                    <span class="search-delete-icon d-none">
                                        <i data-acorn-icon="close"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-7 col-lg-9 col-xxl-10 text-end mb-1">
                                <div class="d-inline-block">
                                    <button class="btn btn-icon btn-icon-only btn-outline-muted btn-sm datatable-print"
                                        type="button" data-datatable="#tbOrder">
                                        <i data-acorn-icon="print"></i>
                                    </button>
                                    <div class="d-inline-block datatable-export" data-datatable="#tbOrder">
                                        <button class="btn btn-icon btn-icon-only btn-outline-muted btn-sm dropdown"
                                            data-bs-toggle="dropdown" type="button" data-bs-offset="0,3">
                                            <i data-acorn-icon="download"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                            <button class="dropdown-item export-copy" type="button">Copy</button>
                                            <button class="dropdown-item export-excel" type="button">Excel</button>
                                            <button class="dropdown-item export-cvs" type="button">Cvs</button>
                                        </div>
                                    </div>
                                    <div class="dropdown-as-select d-inline-block datatable-length"
                                        data-datatable="#tbOrder">
                                        <button class="btn btn-outline-muted btn-sm dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            data-bs-offset="0,3">
                                            10 Items
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                            <a class="dropdown-item" href="#">10 Items</a>
                                            <a class="dropdown-item active" href="#">20 Items</a>
                                            <a class="dropdown-item" href="#">50 Items</a>
                                            <a class="dropdown-item" href="#">100 Items</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="data-table-responsive-wrapper">
                            <table class="data-table nowrap hover" id="tbOrder" data-order='[[ 0, "desc" ]]'>
                                <thead>
                                    <tr>
                                        <th class="text-muted text-small text-uppercase">No</th>
                                        <th class="text-muted text-small text-uppercase">Nomor Order</th>
                                        <th class="text-muted text-small text-uppercase">Tahun</th>
                                        <th class="text-muted text-small text-uppercase">Nama Media</th>
                                        <th class="text-muted text-small text-uppercase">Nama Perusahaan</th>
                                        <th class="text-muted text-small text-uppercase">Status</th>
                                        <th class="text-muted text-small text-uppercase">Aksi</th>
                                        <th class="text-muted text-small text-uppercase">Nama Paket</th>
                                        <th class="text-muted text-small text-uppercase">Jumlah Paket</th>
                                        <th class="text-muted text-small text-uppercase">Detail Paket</th>
                                        <th class="text-muted text-small text-uppercase">Nilai Order</th>
                                        <th class="text-muted text-small text-uppercase">Total Nilai Order</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <div class="modal fade" id="id_ekatalog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTitle"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="ekatalog" novalidate>
                        <div class="position-relative form-group mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" id="id_input_ekatalog" placeholder="ID E-Katalog"
                                required>
                        </div>
                        <input type="text" class="form-control" id="id_nomor_order" readonly>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="setuju btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            var tahun = $('#tahuns').html()
            $('#tbOrder').DataTable({
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
                responsive: true,
                ajax: '/order/' + tahun + '/show',
                columns: [{
                        'data': null,
                        'sortable': false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1
                        },

                    },
                    {
                        data: 'no_order',
                    },
                    {
                        data: 'tahun',
                    },
                    {
                        data: 'nama_media',
                    },
                    {
                        data: 'nama_perusahaan',
                    },
                    {
                        data: 'status',
                    },
                    {
                        data: 'aksi',
                    },
                    {
                        data: 'nama_paket',
                    },
                    {
                        data: 'jumlah_paket',
                    },
                    {
                        data: 'detail_paket',
                    },
                    {
                        data: 'nilai_order',
                    },
                    {
                        data: 'total_nilai_order',
                    },
                ],
                sDom: '<"row"<"col-sm-12"<"table-container"t>r>><"row"<"col-12"p>>',
                language: {
                    paginate: {
                        previous: '<i class="cs-chevron-left"></i>',
                        next: '<i class="cs-chevron-right"></i>',
                    },
                },

            });

            function queryAjax(url, method, param, id, data) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: method,
                    url: url,
                    data: {
                        param: param,
                        id: id,
                        data: data,
                    },
                    success: function(response) {
                        Swal.fire({
                            title: response.title,
                            text: response.text,
                            icon: response.icon,
                        });
                        $('#id_ekatalog').modal('hide')
                        $('#id_input_ekatalog').val('');
                        $('#tbOrder').DataTable().ajax.reload();
                    }
                });
            }

            $(document).on('click', '.pickup', function() {
                var id = $(this).attr('data-id');
                var param = $(this).attr('data-status');
                var method = 'POST';
                var url = '/order/update';

                Swal.fire({
                    title: 'Apakah Anda Akan Memproses Pesanan',
                    text: "Anda Yakin Akan Memproses Data Ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    if (result.isConfirmed) {
                        queryAjax(url, method, param, id);
                    };
                })
            });

            $(document).on('click', '.kirim', function() {
                var id = $(this).attr('data-id');
                var param = $(this).attr('data-status');
                var method = 'POST';
                var url = '/order/update';

                Swal.fire({
                    title: 'Mengirimkan Notifikasi Ke Perusahaan Pers',
                    text: "Pastikan Anda Telah Melakukan Pesanan Pada E-Katalog",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    if (result.isConfirmed) {
                        queryAjax(url, method, param, id);
                    };
                })
            });

            $(document).on('click', '.nego', function() {
                var id = $(this).attr('data-id');
                var param = $(this).attr('data-status');
                var method = 'POST';
                var url = '/order/update';

                Swal.fire({
                    title: 'Apakah Negosiasi Telah Selesai',
                    text: "Anda Yakin Akan Menyelesaikan Negosiasi!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    if (result.isConfirmed) {
                        queryAjax(url, method, param, id);
                    };
                })
            });

            $(document).on('click', '.modal_Input', function(e) {
                e.preventDefault();
                $('#id_ekatalog').modal('show')
                var noOrder = $(this).attr('data-id');
                $('#modalTitle').text(noOrder);
                $('#id_nomor_order').val(noOrder);
            });

            $(document).on('click', '.setuju', function() {
                var id = $('#id_nomor_order').val()
                var param = 'setuju';
                var data = $('#id_input_ekatalog').val();

                var method = 'post';
                var url = '/order/update';

                if ($('#ekatalog').valid()) {
                    Swal.fire({
                        title: 'ID Ekatalog',
                        text: "Data Yang Di Masukan Benar?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            queryAjax(url, method, param, id, data);
                        };
                    })
                }
            });

            $(document).on('click', '.suratPesanan', function() {
                var id = $(this).attr('data-id');
                var param = $(this).attr('data-status');
                var method = 'POST';
                var url = '/order/update';
                console.log(id);

                window.open(`/order/print/` + id, `Surat Pesanan`, `width=700,height=600`)

            });

            $(document).on('click', '.cancels', function() {
                var id = $(this).attr('data-id');
                var param = $(this).attr('data-status');
                var method = 'POST';
                var url = '/order/update';

                Swal.fire({
                    title: 'Apakah Sepakat Dengan Negosiasi',
                    text: "Anda Yakin Akan Menyetujui Hasil Negosiasi!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    if (result.isConfirmed) {
                        queryAjax(url, method, param, id);
                    };
                })
            });
        });

        /**
         * button
         **/
    </script>
@endpush
