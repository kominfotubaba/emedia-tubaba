@extends('panel.master')
@section('content')
    <main>
        <section class="scroll-section" id="title">
            <div class="page-title-container">
                <h1 class="mb-0 pb-0 display-4">Tambah Paket</h1>
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
                        <form action="/paket/store" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="jenis_media" class="form-label">Jenis Media</label>
                            <div class="mb-3">
                                <select style="width: 100%" class="form-select selected" name="jenis_media"
                                    id="jenis_media">
                                    <option label="&nbsp;"></option>
                                    <option value="harian">Media Cetak Harian</option>
                                    <option value="siber">Media Siber</option>
                                    <option value="elektronik">Media Elektronik</option>
                                </select>
                                @error('jenis_media')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="klasifikasi_paket" class="form-label">Klasifikasi Paket</label>
                                <div class="input-group">
                                    <input style="max-width: 5%;" type="text" class="form-control" name="kode"
                                        id="kode" readonly>
                                    <input type="number" class="form-control" name="klasifikasi_paket"
                                        id="klasifikasi_paket" value="{{ old('klasifikasi_paket') }}">
                                </div>
                                @error('klasifikasi_paket')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nama_paket" class="form-label">Nama Paket</label>
                                <input type="text" class="form-control" name="nama_paket" id="nama_paket"
                                    value="{{ old('nama_paket') }}">
                                @error('nama_paket')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
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
        $('#jenis_media').select2({
            placeholder: 'Input Jenis Media'
        });
        $('.selected').change(function(e) {
            e.preventDefault();
            var jenisMedia = $(this).val();
            if (jenisMedia == 'siber') {
                $('#kode').val('S-')
            } else if (jenisMedia == 'harian') {
                $('#kode').val('C-')
            } else if (jenisMedia == 'elektronik') {
                $('#kode').val('E-')
            }
        });
    </script>
@endpush
