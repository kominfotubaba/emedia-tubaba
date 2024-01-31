@extends('panel.master')
@section('content')
    <main>
        <section class="scroll-section" id="title">
            <div class="page-title-container">
                <h1 class="mb-0 pb-0 display-4">Daftar Pengajuan</h1>
            </div>
        </section>
        <div>
            <section class="scroll-section" id="hover">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-5 col-lg-3 col-xxl-2 mb-1">
                                <div class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 border border-separator bg-foreground search-sm">
                                    <input class="form-control form-control-sm datatable-search" placeholder="Search" data-datatable="#tbDaftarPengajuan">
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
                                    <button class="btn btn-icon btn-icon-only btn-outline-muted btn-sm datatable-print" type="button" data-datatable="#tbDaftarPengajuan">
                                        <i data-acorn-icon="print"></i>
                                    </button>
                                    <div class="d-inline-block datatable-export" data-datatable="#tbDaftarPengajuan">
                                        <button class="btn btn-icon btn-icon-only btn-outline-muted btn-sm dropdown" data-bs-toggle="dropdown" type="button" data-bs-offset="0,3">
                                            <i data-acorn-icon="download"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                            <button class="dropdown-item export-copy" type="button">Copy</button>
                                            <button class="dropdown-item export-excel" type="button">Excel</button>
                                            <button class="dropdown-item export-cvs" type="button">Cvs</button>
                                        </div>
                                    </div>
                                    <div class="dropdown-as-select d-inline-block datatable-length" data-datatable="#tbDaftarPengajuan">
                                        <button class="btn btn-outline-muted btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-offset="0,3">
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
                            <table class="data-table nowrap hover" id="tbDaftarPengajuan" data-order='[[ 0, "desc" ]]'>
                                <thead>
                                    <tr>
                                        <th class="text-muted text-small text-uppercase">No</th>
                                        <th class="text-muted text-small text-uppercase">Tahun</th>
                                        <th class="text-muted text-small text-uppercase">Status</th>
                                        <th class="text-muted text-small text-uppercase">Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            var tahun = $('#tahuns').html()
            $('#tbDaftarPengajuan').DataTable({
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
                ajax: '/daftar/show',
                columns: [{
                        'data': null,
                        'sortable': false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1
                        },

                    },
                    {
                        data: 'tahun',
                    },
                    {
                        data: 'status',
                    },
                    {
                        data: 'aksi',
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
                        })
                        $('#tbDaftarPengajuan').DataTable().ajax.reload();
                    }
                });
            }
        });

        /**
         * button
         **/
    </script>
@endpush
