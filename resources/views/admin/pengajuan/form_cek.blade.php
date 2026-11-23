@extends('panel.master')
@section('content')
<main>
    @foreach($media_data as $record)
        <div class="h3 text-primary text-capitalize">Cek Data Pengajuan</div>
        @include('admin.pengajuan._dua_step_form', ['record' => $record, 'readonly' => true])
    @endforeach
</main>
@endsection
