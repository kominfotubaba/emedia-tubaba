@extends('panel.master')
@section('content')
    <main>
        <section class="scroll-section" id="title">
            <div class="page-title-container">
                <h1 class="mb-0 pb-0 display-4">Tambah Produk</h1>
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
                        {{-- <form action="{{ route('paket.store_detail') }}" method="POST" enctype="multipart/form-data"> --}}
                        <form action="/paket/store_detail" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" class="form-control" name="id_paket" id="id_paket"
                                value="{{ Request::segment(3) }}" readonly hidden>
                            <div class="mb-3">
                                <label for="no_rup" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" name="produk" id="produk"
                                    value="{{ old('produk') }}">
                                @error('produk')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nominal_murni" class="form-label">Detail Produk</label>
                                <input type="text" class="form-control" name="detail_produk" id="detail_produk"
                                    value="{{ old('detail_produk') }}">
                                @error('detail_produk')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga Produk</label>
                                <input type="text" class="form-control" name="harga" id="harga">
                                @error('harga')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="grade" class="form-label">Grade (A, B, C)</label>
                                <input type="text" class="form-control" name="grade" id="grade"
                                    value="{{ old('grade') }}">
                                @error('grade')
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
        // harga
        var harga = IMask(
            document.getElementById('harga'), {
                mask: 'num',
                blocks: {
                    num: {
                        mask: Number,
                        thousandsSeparator: '.'
                    }
                }
            });

        // grade
        var grade = IMask(
            document.getElementById('grade'), {
                mask: IMask.MaskedEnum,
                // all values should be same length!
                enum: ['A', 'B', 'C'],

                // also Pattern options can be set
                lazy: false
            });
    </script>
@endpush
