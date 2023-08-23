@extends('panel.master')
@section('content')
    <main>
        <section class="scroll-section" id="title">
            <div class="page-title-container">
                <h1 class="mb-0 pb-0 display-4">Edit Bugdet</h1>
            </div>
        </section>
        <div>
            <section class="scroll-section" id="hover">
                <div class="card mb-5">
                    <div class="card-body">
                        <form action="/budget/update" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" class="form-control" name="no_id" id="no_id"
                                value="{{ Request::segment(3) }}" readonly hidden>
                            <div class="mb-3">
                                <label for="no_rup" class="form-label">No RUP</label>
                                <input type="text" class="form-control" name="no_rup" id="no_rup"
                                    value="{{ $rup }}">
                                @error('no_rup')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nominal_murni" class="form-label">Nominal Murni</label>
                                <input type="text" class="form-control" name="nominal_murni" id="nominal_murni"
                                    value="{{ $murni }}">
                                @error('nominal_murni')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nominal_perubahan" class="form-label">Penyesuaian Anggaran</label>
                                <input type="text" class="form-control" name="nominal_perubahan" id="nominal_perubahan"
                                    value="{{ $penyesuaian }}">
                                @error('nominal_perubahan')
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
        // nominal murni
        var murni = IMask(
            document.getElementById('nominal_murni'), {
                mask: 'num',
                blocks: {
                    num: {
                        mask: Number,
                        thousandsSeparator: '.'
                    }
                }
            });
        // perubahan
        $(document).keypress(function(e) {
            if (e.which == 45) {

            }
        });

        var perubahan = IMask(
            document.getElementById('nominal_perubahan'), {
                mask: 'num',
                blocks: {
                    num: {
                        mask: Number,
                        signed: true,
                        thousandsSeparator: '.'
                    }
                },
            });
    </script>
@endpush
