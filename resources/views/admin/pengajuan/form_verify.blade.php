@extends('panel.master')
@section('content')
<main>
@foreach($media_data as $record)
    <div class="h3 text-primary text-capitalize">Verifikasi Pengajuan</div>
    @if($tahun_verifikasi == 1)
    <div class="card mb-3"><div class="card-body d-flex gap-2">
        <button class="btn btn-primary verify-action" data-param="terima">Terima</button>
        <button class="btn btn-danger verify-action" data-param="tolak">Tolak</button>
        <button class="btn btn-dark verify-action" data-param="undefinedValue">Tidak Dapat Dinilai</button>
    </div></div>
    @endif
    @include('admin.pengajuan._dua_step_form', ['record' => $record, 'readonly' => true, 'verify' => true])
@endforeach
</main>
@endsection
@push('script')
<script>
$(function(){
    const csrf=$('meta[name="csrf-token"]').attr('content'), no=$('#pengajuanDuaStep [name="pengajuan_no"]').val();
    $('.verify-action').on('click', function(){
        const param=$(this).data('param'), unchecked=$('.verification-check:not(:checked)').map(function(){return this.value;}).get();
        if(param!=='terima' && !unchecked.length){alert('Hilangkan centang kelompok data yang ditolak.');return;}
        const note=param==='terima' ? '' : prompt('Catatan verifikasi (opsional):') || '';
        $.ajax({url:'/pengajuan/verifikasi',method:'POST',headers:{'X-CSRF-TOKEN':csrf},data:{pengajuan_no:no,param:param,status:param==='terima'?'terima':'tolak',keterangan:unchecked,note:note}})
          .done(r=>{alert(r.massage);window.location='/daftar/'+r.tahun+'/detail';}).fail(x=>alert(x.responseJSON?.message||'Verifikasi gagal.'));
    });
});
</script>
@endpush
