@extends('panel.master')
@section('content')
<main>
    <h1>Daftar Media dengan Catatan</h1>
    <p>Pengajuan yang belum diterima beserta hasil pemeriksaan dan catatan admin.</p>
    <a class="btn btn-primary mb-3" href="{{ url('/pengajuan/catatan?export=1') }}">Export Excel</a>
    @forelse($records as $record)
        <div class="card mb-3"><div class="card-body">
            <h5>{{ $record->namaMedia }} — {{ $record->jenis_media }} ({{ $record->tahun_pengajuan }})</h5>
            <a href="{{ url('/pengajuan/verifikasi/'.$record->pengajuan_no) }}">Buka verifikasi {{ $record->pengajuan_no }}</a>
            <div class="table-responsive"><table class="table">
                <thead><tr><th>Data</th><th>Status</th><th>Catatan</th></tr></thead>
                <tbody>
                @php
                    $reviews = \App\Support\PengajuanReview::reviews($record);
                @endphp
                @foreach(\App\Support\PengajuanReview::fields($record) as $key => $label)
                    @php
                        $item = $reviews[$key] ?? [];
                        $verified = !empty($item['verified']) && ($item['value'] ?? null) === (string) $record->$key;
                    @endphp
                    @if(!$verified || !empty($item['note']))
                    <tr><td>{{ $label }}</td><td>{{ $verified ? 'Terverifikasi' : 'Belum terverifikasi' }}</td><td style="white-space: pre-wrap">{{ $item['note'] ?? '' }}</td></tr>
                    @endif
                @endforeach
                </tbody>
            </table></div>
        </div></div>
    @empty
        <p>Tidak ada pengajuan yang belum diverifikasi.</p>
    @endforelse
</main>
@endsection
