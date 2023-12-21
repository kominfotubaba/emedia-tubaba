@extends('panel.master')
@section('content')
    <main>
        <div class="container">
            <!-- Title and Top Buttons Start -->
            <div class="page-title-container">
                <div class="row">
                    <!-- Title Start -->
                    <div class="col-12 col-md-7">
                        <h1 class="mb-0 pb-0 display-4" id="title">Pilih Jenis Media</h1>
                    </div>
                    <!-- Title End -->
                </div>
            </div>
            <!-- Title and Top Buttons End -->
        </div>

        <section class="scroll-section" id="filled">
            <div class="card mb-5">
                <div class="card-body">
                    {{-- <form action="/pengajuan/jenis/siber" method="GET"> --}}
                    @csrf
                    <div class="mb-3 w-100">
                        <label class="form-label">Jenis Media</label>
                        @if ($message = Session::get('errors'))
                            <div class="alert alertSlide alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <select name="jenis" id="jenisPengajuan">
                            <option label="&nbsp;"></option>
                            <option value="cetak">Media Cetak</option>
                            <option value="siber">Media Siber</option>
                            <option value="elektronik">Media Elektronik</option>
                        </select>
                    </div>
                    {{-- <button id="submitJenis" type="button" class="btn btn-primary mb-1" disabled>Primary</button> --}}
                    {{-- <button id="submitJenis" type="submit" class="btn btn-primary mb-1" disabled>Primary</button> --}}
                    {{-- </form> --}}
                </div>
            </div>
        </section>

        <div id="inputData">
        </div>
    </main>
@endsection
