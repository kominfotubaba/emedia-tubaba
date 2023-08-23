@extends('panel.master')
@section('content')
    <main>
        <section class="scroll-section" id="title">
            <div class="page-title-container">
                <h1 class="mb-0 pb-0 display-4">Detail Produk</h1>
                <span id="id_detail" hidden>{{ Request::segment(3) }}</span>
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
                                        data-datatable="#tbPaketDetail">
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
                                    <a class="btn btn-icon btn-icon-only btn-outline-muted btn-sm"
                                        href="/paket/create_detail/{{ Request::segment(3) }}">
                                        <i data-acorn-icon="plus"></i>
                                    </a>
                                    <button class="btn btn-icon btn-icon-only btn-outline-muted btn-sm datatable-print"
                                        type="button" data-datatable="#tbPaketDetail">
                                        <i data-acorn-icon="print"></i>
                                    </button>
                                    <div class="d-inline-block datatable-export" data-datatable="#tbPaketDetail">
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
                                        data-datatable="#tbPaketDetail">
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
                            <table class="data-table nowrap hover" id="tbPaketDetail" data-order='[[ 0, "desc" ]]'>
                                <thead>
                                    <tr>
                                        {{-- <th class="text-muted text-small text-uppercase" hidden>id</th> --}}
                                        <th class="text-muted text-small text-uppercase">no</th>
                                        <th class="text-muted text-small text-uppercase">Nama Paket</th>
                                        <th class="text-muted text-small text-uppercase">Detail Produk</th>
                                        <th class="text-muted text-small text-uppercase">Harga</th>
                                        <th class="text-muted text-small text-uppercase">Grade</th>
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
        // setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // table
        $(document).ready(function() {
            var id = $('#id_detail').html();
            $('#tbPaketDetail').DataTable({
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
                ajax: '/paket/show_detail/' + id,
                columns: [{
                        'data': null,
                        'sortable': false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1
                        },

                    },
                    {
                        data: 'detail_nama',
                    },
                    {
                        data: 'detail_paket',
                    },
                    {
                        data: 'price',
                    },
                    {
                        data: 'grade',
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
        });

        /**
         * button
         **/
        $(document).on('click', '.destroyed', function() {
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Data Akan Di Hapus',
                text: "Kamu tidak bisa mengembalikan data yang dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "/paket/destroy_detail",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            $('#tbPaketDetail').DataTable().ajax.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
