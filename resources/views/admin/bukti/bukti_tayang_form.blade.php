@extends('panel.master')
@section('content')
    <main>
        <section class="scroll-section" id="title">
            <div class="page-title-container">
                <h1 class="mb-0 pb-0 display-4">Input Bukti Tayang</h1>
            </div>
        </section>

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div>
            <section class="scroll-section" id="hover">
                <div class="card mb-5">
                    <div class="card-body">
                        <form id="formOrder" action="/bukti_tayang/store" method="POST" enctype="multipart/form-data">
                            @csrf
                            @foreach ($data as $d)
                                <div class="mb-3">
                                    <label for="tahun" class="form-label">Nomor Order</label>
                                    <input type="text" class="form-control" id="nomorOrder" name="nomor_order" value="{{ $d->nomor_order }}" readonly>
                                    @error('nomor_order')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tahun" class="form-label">Nama Media</label>
                                    <input type="text" class="form-control" id="namaMedia" name="nama_media" value="{{ $d->nama_media }}" readonly>
                                    @error('nama_media')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tahun" class="form-label">Nama Paket</label>
                                    <input type="text" class="form-control" id="namaPaket" name="nama_paket" value="{{ $d->paket }}" readonly>
                                    @error('nama_paket')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tahun" class="form-label">Detail Paket</label>
                                    <input type="text" class="form-control" id="detailPaket" name="detail_paket" value="{{ $d->detail_paket }}" readonly>
                                    @error('detail_paket')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tahun" class="form-label">Jumlah Paket</label>
                                    <input type="number" class="form-control" id="jumlahPaket" name="jumlah_paket" value="{{ $d->volume }}" readonly>
                                    @error('jumlah_paket')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tahun" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan') ?? $d->keterangan }}" readonly>
                                    <input type="text" class="form-control" id="filePdf" name="file_pdf" value="{{ old('file_pdf') ?? $d->data_files }}" hidden>
                                    @error('keterangan')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if ($d->data_files != null)
                                    <div class="mb-3">
                                        <label for="tahun" class="form-label">File PDF</label>
                                        <br>
                                        <a href='/tmp/bukti_tayang/{{ $d->data_files }}'>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
                                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1h-4z" />
                                            </svg>
                                        </a>
                                    </div>
                                @endif
                                <div class="mb-3">
                                    <label for="tahun" class="form-label">Uploads File PDF</label>
                                    <br>
                                    <div class="form-floating">
                                        <div class="dropzone dropzone-floating-label" id="uploadsFiles"></div>
                                        <label class="ps-4">File PDF Bukti Tayang</label>
                                    </div>
                                    @error('file_pdf')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach
                            <button id="sending" type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
@push('script')
    <script>
        //
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function uploads(params, nomorOrder) {
            var Dropzones = new Dropzone('#uploadsFiles', {
                url: '/bukti_tayang/store',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                init: function() {
                    var nameMock = params;
                    var param = 'uploads_bukti';

                    if (nameMock == '') {

                    } else {
                        var mockFiles = {
                            name: nameMock,
                            size: 1
                        };

                        this.emit("addedfile", mockFiles);
                        this.emit("thumbnail", mockFiles,
                            '/assets/img/logo/pdf_logo.png');
                        this.files.push(nameMock);
                        this.on('addedfile', function(file) {
                            this.removeFile(mockFiles);
                        });
                    }

                    this.on('success', function(file, response) {
                        Swal.fire({
                            toast: true,
                            position: 'bottom-right',
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.original_name +
                                ' Berhasil diupload!',
                            showConfirmButton: false,
                            timer: 3500
                        });
                        $('#filePdf').val(response.name)
                        $('#uploadsFiles .dz-details span').html(response.name);
                    });
                    this.on('error', function() {
                        Swal.fire({
                            toast: true,
                            position: 'bottom-right',
                            icon: 'error',
                            title: 'Upload Gagal',
                            text: 'Cek file atau koneksi!',
                            showConfirmButton: false,
                            timer: 3500
                        });
                        this.removeAllFiles();
                    });
                    this.on('resetFiles', function() {
                        this.removeAllFiles();
                    });
                    this.on('sending', function(file, response, formData) {
                        formData.append('param', param);
                        formData.append('nomor_order', nomorOrder);
                    });
                    this.on("maxfilesexceeded", function(file) {
                        this.removeAllFiles();
                        this.addFile(file);
                    });
                },
                acceptedFiles: '.pdf',
                maxFiles: 1,
                maxFilesize: 10, //MB
                uploadMultiple: false,
                thumbnailWidth: 160,
                dictDefaultMessage: 'Uploads File PDF Disini',
                previewTemplate: DropzoneTemplates.previewTemplate,
            });
        }

        $(document).ready(function() {
            var cekdata = $('#filePdf').val()
            var nomor_order = $('#nomorOrder').val()
            uploads(cekdata, nomor_order)
        });
    </script>
@endpush
