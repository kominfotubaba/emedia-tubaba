@extends('panel.master')
@section('content')
    <main>
        <section class="scroll-section" id="title">
            <div class="page-title-container">
                <h1 class="mb-0 pb-0 display-4">List Pengajuan Tahun {{ $tahun }}</h1>
                <div id="tahuns" hidden>{{ $tahun }}</div>
                <div id="users" hidden>{{ Auth::user()->role }}</div>
                {{-- <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                    <ul class="breadcrumb pt-0">
                        <li class="breadcrumb-item"><a href="Dashboards.Default.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="Interface.html">Interface</a></li>
                        <li class="breadcrumb-item"><a href="Interface.Plugins.html">Plugins</a></li>
                        <li class="breadcrumb-item"><a href="Interface.Plugins.Datatables.html">Datatables</a>
                        </li>
                    </ul>
                </nav> --}}
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
                                    @if ($pengajuan_buka == 1)
                                        @if ($pengajuan_tahun == 0)
                                            <button id="addPengajuan" class="btn btn-sm btn-outline-muted" type="button">
                                                Pengajuan
                                            </button>
                                        @endif
                                    @endif
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
                                            <a class="dropdown-item" href="#">-1 All Items</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="data-table-responsive-wrapper">
                            <table class="data-table nowrap hover" id="tbDaftarPengajuan" data-order='[[ 0, "desc" ]]'>
                                <thead>
                                    <tr>
                                        {{-- <th class="text-muted text-small text-uppercase" hidden>id</th> --}}
                                        <th class="text-muted text-small text-uppercase">no</th>
                                        <th class="text-muted text-small text-uppercase">Nomor Pengajuan</th>
                                        <th class="text-muted text-small text-uppercase">Nama Perusahaan</th>
                                        <th class="text-muted text-small text-uppercase">Nama Media</th>
                                        <th class="text-muted text-small text-uppercase">Jenis Media</th>
                                        <th class="text-muted text-small text-uppercase">Keterangan</th>
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

    <div class="modal fade" id="addModalMenu" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pengajuan Baru {{ $tahun }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="w-100">
                        <select id="dataTahunPengajuan">
                            <option label="&nbsp;">-- Pilih Data Untuk Pengajuan {{ $tahun }} --</option>
                            @foreach ($data_pengajuan as $dp)
                                <option value="{{ $dp->id }}">{{ $dp->tahun_pengajuan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="savePengajuanBaru">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        // if (performance.navigation.type == 2) {
        //     // location.reload(true);
        // }
        $(window).bind("pageshow", function(event) {
            if (event.originalEvent.persisted) {
                $('#tbDaftarPengajuan').DataTable().ajax.reload(null, false);
                // window.location.reload()
            }
        });

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
                ajax: '/daftar/' + tahun + '/show',
                columns: [
                    // {
                    //     data: 'id',
                    //     name: 'id',
                    //     visible: false
                    // },
                    {
                        'data': null,
                        'sortable': false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1
                        },

                    },
                    {
                        data: 'pengajuan_no',
                        name: 'pengajuan_no'
                    },
                    {
                        data: 'namaPerusahaan',
                        name: 'namaPerusahaan'
                    },
                    {
                        data: 'namaMedia',
                        name: 'namaMedia'
                    },
                    {
                        data: 'jenis_media',
                        name: 'jenis_media'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'nilai',
                        name: 'nilai'
                    },
                    {
                        data: 'action',
                        name: 'action'
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

        /**@argument
         * Select
         **/
        jQuery('#dataTahunPengajuan').select2({
            dropdownParent: $('#addModalMenu'),
            placeholder: 'Pilih Data Pengajuan'
        });
        /**
         * button
         **/
        $('#addPengajuan').click(function(e) {
            e.preventDefault();
            $('#addModalMenu').modal('show');
        });
        $('#savePengajuanBaru').click(function(e) {
            e.preventDefault();

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            $.ajax({
                type: "POST",
                url: "/pengajuan/create",
                data: {
                    id: $('#dataTahunPengajuan').val()
                },
                success: function(response) {
                    console.log(response.text);
                    $('#tbDaftarPengajuan').DataTable().ajax.reload(null, false);
                    $('#addPengajuan').prop('hidden', true)
                    $('#savePengajuanBaru').prop('disabled', true)
                    $('#addModalMenu').modal('hide');
                }
            });
        });


        $(document).on('click', '.verifikasi', function(e) {
            e.preventDefault();
            var noPengajuan = $(this).attr('data-id');
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            $.ajax({
                type: "GET",
                url: "/pengajuan/verifikasi/" + noPengajuan,
                success: function(response) {
                    // $("main").load("/pengajuan/verifikasi/" + noPengajuan);
                    window.open("/pengajuan/verifikasi/" + noPengajuan, "_parent")
                }
            });
        });

        $(document).on('click', '.cekdaftar', function(e) {
            e.preventDefault();
            var noPengajuan = $(this).attr('data-id');
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            $.ajax({
                type: "GET",
                url: "/pengajuan/cek_data/" + noPengajuan,
                success: function(response) {
                    // $("main").load("/pengajuan/cek_data/" + noPengajuan);
                    window.open("/pengajuan/cek_data/" + noPengajuan, "_parent")
                }
            });
        });

        $(document).on('click', '.editdaftar', function(e) {
            e.preventDefault();
            var noPengajuan = $(this).attr('data-id');
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            $.ajax({
                type: "GET",
                url: "/pengajuan/edit/" + noPengajuan,
                success: function(response) {
                    // $("main").load("/pengajuan/edit/" + noPengajuan);
                    window.open("/pengajuan/edit/" + noPengajuan, "_parent")
                }
            });
        });

        $(document).on('click', '.bukaEdit', function(e) {
            e.preventDefault();
            var noPengajuan = $(this).attr('data-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "PUT",
                url: "/pengajuan/edit/" + noPengajuan,
                data: {
                    pengajuan_no: noPengajuan,
                    status: 'tidak'
                },
                success: function(response) {
                    // $("main").load("/pengajuan/edit/" + noPengajuan);
                    // window.open("/pengajuan/edit/" + noPengajuan, "_parent")
                    $('#tbDaftarPengajuan').DataTable().ajax.reload(null, false);
                }
            });
        });

        $(document).on('click', '.tutupEdit', function(e) {
            e.preventDefault();
            var noPengajuan = $(this).attr('data-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "PUT",
                url: "/pengajuan/edit/" + noPengajuan,
                data: {
                    pengajuan_no: noPengajuan,
                    status: 'buka'
                },
                success: function(response) {
                    // $("main").load("/pengajuan/edit/" + noPengajuan);
                    // window.open("/pengajuan/edit/" + noPengajuan, "_parent")
                    $('#tbDaftarPengajuan').DataTable().ajax.reload(null, false);
                }
            });
        });
    </script>
@endpush
