@extends('panel.master')
@section('content')
    <main>
        <form method="POST" action="/dashboard/update">
            @csrf
            <input class="form-control mb-3" type="text" name="id" placeholder="username" value="{{ $data->id }}">
            <input class="form-control mb-3" type="text" name="username" placeholder="username" value="{{ $data->name }}">
            <input class="form-control mb-5" type="text" name="role" placeholder="role" value="{{ $data->role }}">
            <button type="submit" class="btn btn-primary">save</button>
        </form>
    </main>
@endsection
@push('script')
    <script></script>
@endpush
