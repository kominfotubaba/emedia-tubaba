@extends('panel.master')
@section('content')
    <main>
        <section class="scroll-section" id="title">
            <div class="page-title-container">
                <h1 class="mb-0 pb-0 display-4">Bukti Tayang Tahun {{ $tahun }}</h1>
                <div id="tahuns" hidden>{{ $tahun }}</div>
                <div id="users" hidden>{{ Auth::user()->role }}</div>
            </div>
        </section>
        <div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <section class="scroll-section" id="hover">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-5 col-lg-3 col-xxl-2 mb-1">
                                <div
                                    class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 border border-separator bg-foreground search-sm">
                                    <input class="form-control form-control-sm datatable-search" placeholder="Search"
                                        data-datatable="#tbBuktiTayang">
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
                                        type="button" data-datatable="#tbBuktiTayang">
                                        <i data-acorn-icon="print"></i>
                                    </button>
                                    <div class="d-inline-block datatable-export" data-datatable="#tbBuktiTayang">
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
                                        data-datatable="#tbBuktiTayang">
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
                            <table class="data-table nowrap hover" id="tbBuktiTayang" data-order='[[ 0, "desc" ]]'>
                                <thead>
                                    <tr>
                                        <th class="text-muted text-small text-uppercase">No</th>
                                        <th class="text-muted text-small text-uppercase">Tahun</th>
                                        <th class="text-muted text-small text-uppercase">Nomor Order</th>
                                        <th class="text-muted text-small text-uppercase">Nama Media</th>
                                        <th class="text-muted text-small text-uppercase">Jumlah Paket</th>
                                        <th class="text-muted text-small text-uppercase">Total Nilai</th>
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

    <div id="modalDetail" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Data</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Nomor Order</label>
                        <input type="text" class="form-control" id="nomorOrder" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Nama Media</label>
                        <input type="text" class="form-control" id="namaMedia" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Nama Paket</label>
                        <input type="text" class="form-control" id="namaPaket" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Detail Paket</label>
                        <input type="text" class="form-control" id="detailPaket" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Jumlah Paket</label>
                        <input type="number" class="form-control" id="jumlahPaket" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" readonly>
                    </div>
                    <div id="files"></div>
                </div>
                <div class="modal-footer">
                    <div class="buttons"></div>
                    <button type="button" class="closed btn btn-dark" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            var tahun = $('#tahuns').html()
            $('#tbBuktiTayang').DataTable({
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
                ajax: '/bukti_tayang/' + tahun + '/show',
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
                        data: 'nomor_order',
                    },
                    {
                        data: 'nama_media',
                    },
                    {
                        data: 'volume',
                    },
                    {
                        data: 'total_nilai',
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
                        if (param == 'post') {
                            Swal.fire({
                                title: response.title,
                                text: response.text,
                                icon: response.icon,
                            })
                        } else if (param == 'get_bukti') {
                            test(response);
                        };
                        $('#tbBuktiTayang').DataTable().ajax.reload();
                    }
                });
            }


            function test(response) {
                $('#nomorOrder').val(response.nomor_order);
                $('#namaMedia').val(response.nama_media);
                $('#namaPaket').val(response.paket);
                $('#detailPaket').val(response.detail_paket);
                $('#jumlahPaket').val(response.volume);
                $('#keterangan').val(response.keterangan);
                var user = $('#users').html();
                if (response.data_files != null) {
                    $('#files').html(
                        '<div class="mb-3"><label for="files" class="form-label">Files</label><br><a onclick = "window.open(`/tmp/bukti_tayang/' +
                    response.data_files +
                    '`,`name`,`width=600,height=600`)" target="popup" href="/tmp/bukti_tayang/' +
                        response.data_files +
                        '" class="btn btn-info files"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-text-fill" viewBox="0 0 16 16"><path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1z"/> </svg></a> </div>'
                    );
                }
                if (user == 'admin') {
                    if (!((response.status == 'terima') || (response.status == 'tolak') || (response.status ==
                            'selesai') || (response.status == 'tunggu'))) {
                        $('.buttons').html(
                            '<button type="button" class="terima btn btn-success">Terima</button> <button type="button" class="tolak btn btn-danger">Tolak</button>'
                        );
                    }
                }
            }

            /**
             * button
             **/

            function clears() {
                $('#files').html('');
                $('.buttons').html('');
            }

            $(document).on('click', '.closed', function() {
                clears();
            });

            $(document).on('click', '.cekdetail', function() {
                var no = $(this).attr('data-id');
                $('#modalDetail').modal('show');
                queryAjax('/bukti_tayang/create', 'get', 'get_bukti', no, '')

                $(document).on('click', '.terima', function() {
                    var noOrder = $('#nomorOrder').val();
                    queryAjax('/bukti_tayang/update', 'post', 'terima', noOrder);
                    $('#modalDetail').modal('toggle');
                    clears();
                });

                $(document).on('click', '.tolak', function() {
                    var noOrder = $('#nomorOrder').val();
                    queryAjax('/bukti_tayang/update', 'post', 'tolak', noOrder);
                    $('#modalDetail').modal('toggle');
                    clears();
                });
            });

            $(document).on('click', '.dataPrint', function() {
                var no_order = $(this).attr('data-id');
                window.open(`/bukti_tayang/print/` + no_order, `Berita Acara`, `width=700,height=600`)
            });

            /**
             * uploads
             **/
            // function uploads(params) {
            //     var Dropzones = new Dropzone('#uploadsFiles', {
            //         url: '/pengajuan/uploads',
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },

            //         init: function() {
            //             var nameMock = params;
            //             var mockFiles = {
            //                 name: nameMock,
            //                 size: 1
            //             };

            //             if (params == 'destroy') {
            //                 this.emit("resetFiles", mockFiles);
            //             }

            //             this.emit("addedfile", mockFiles);
            //             this.emit("thumbnail", mockFiles,
            //                 '/assets/img/logo/pdf_logo.png');
            //             this.files.push(nameMock);
            //             this.on('addedfile', function(file) {
            //                 this.removeFile(mockFiles);
            //             });


            //             this.on('success', function(file, response) {
            //                 Swal.fire({
            //                     toast: true,
            //                     position: 'bottom-right',
            //                     icon: 'success',
            //                     title: 'Berhasil',
            //                     text: response.original_name +
            //                         ' Berhasil diupload!',
            //                     showConfirmButton: false,
            //                     timer: 3500
            //                 });
            //                 $('#' + param + ' .dz-details').html('<span>' + response.name +
            //                     '</span>');
            //             });
            //             this.on('error', function() {
            //                 Swal.fire({
            //                     toast: true,
            //                     position: 'bottom-right',
            //                     icon: 'error',
            //                     title: 'Upload Gagal',
            //                     text: 'Cek file atau koneksi!',
            //                     showConfirmButton: false,
            //                     timer: 3500
            //                 });
            //                 this.removeAllFiles();
            //             });
            //             this.on('resetFiles', function() {
            //                 this.removeAllFiles();
            //             });
            //             this.on('sending', function(file, response, formData) {
            //                 formData.append('data', param);
            //             });
            //             this.on("maxfilesexceeded", function(file) {
            //                 this.removeAllFiles();
            //                 this.addFile(file);
            //             });
            //         },
            //         acceptedFiles: '.pdf',
            //         maxFiles: 1,
            //         uploadMultiple: false,
            //         thumbnailWidth: 160,
            //         dictDefaultMessage: 'Uploads Disini',
            //         previewTemplate: DropzoneTemplates.previewTemplate,
            //     });
            // }
        });
    </script>
@endpush
