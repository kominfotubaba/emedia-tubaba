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
        <button class="btn btn-outline-primary" id="save-field-reviews">Simpan Checklist & Catatan</button>
    </div></div>
    @endif
    @include('admin.pengajuan._dua_step_form', ['record' => $record, 'readonly' => true, 'verify' => true])
    @php
        $reviewFields = \App\Support\PengajuanReview::fields($record);
        $reviewData = [
            'fields' => $reviewFields,
            'saved' => \App\Support\PengajuanReview::reviews($record),
            'values' => $record->only(array_keys($reviewFields)),
            'editable' => $tahun_verifikasi == 1,
        ];
    @endphp
    <script type="application/json" id="review-data">@json($reviewData)</script>
@endforeach
</main>
@endsection
@push('script')
<script>
$(function(){
    const csrf=$('meta[name="csrf-token"]').attr('content'), no=$('#pengajuanDuaStep [name="pengajuan_no"]').val();
    const config = JSON.parse(document.getElementById('review-data').textContent);
    const form = $('#pengajuanDuaStep');
    $('.verification-check').closest('label').remove();
    Object.entries(config.fields).forEach(([key, label]) => {
        const name = key === 'jenisJangkauanSiarMediaElektronik' ? 'subjenis_elektronik' : key;
        const target = form.find('[name="'+name+'"], [data-review-document="'+key+'"]').first();
        if (!target.length) return;
        const saved = config.saved[key] || {};
        const verified = !!saved.verified && saved.value === String(config.values[key] ?? '');
        const box = $('<div class="field-review border rounded p-2 my-2 w-100"></div>').attr('data-field', key);
        const check = $('<input type="checkbox" class="form-check-input me-2 field-verified">')
            .prop('checked', verified).prop('disabled', !config.editable || !config.values[key]);
        const status = $('<span class="review-status"></span>');
        const update = () => status.text(check.prop('checked') ? 'Terverifikasi' : 'Belum terverifikasi');
        check.on('change', update); update();
        box.append($('<label class="d-block"></label>').append(check, $('<span></span>').text('Verifikasi: '+label)));
        box.append(status);
        box.append($('<textarea class="form-control mt-2 field-note" rows="2" maxlength="2000" placeholder="Catatan tambahan (opsional)"></textarea>')
            .attr('aria-label', 'Catatan '+label).val(saved.note || '').prop('disabled', !config.editable));
        target.closest('[class*="col-"]').append(box);
    });
    form.on('click', '.next-tab', function(){ document.querySelector($(this).data('next-tab')).click(); });
    const saveReviews = () => {
        const reviews = {};
        $('.field-review').each(function(){
            reviews[$(this).data('field')] = {verified: $(this).find('.field-verified').prop('checked') ? 1 : 0, note: $(this).find('.field-note').val()};
        });
        return $.ajax({url:'/pengajuan/catatan/'+encodeURIComponent(no), method:'POST', headers:{'X-CSRF-TOKEN':csrf}, data:{reviews}});
    };
    $('#save-field-reviews').on('click', function(){
        const button = $(this).prop('disabled', true);
        saveReviews().done(r=>alert(r.message)).fail(x=>alert(x.responseJSON?.message || 'Catatan gagal disimpan.')).always(()=>button.prop('disabled', false));
    });
    $('.verify-action').on('click', function(){
        const param=$(this).data('param'), unchecked=$('.field-review').filter(function(){return !$(this).find('.field-verified').prop('checked');}).map(function(){return config.fields[$(this).data('field')];}).get();
        if(param==='terima' && unchecked.length){alert('Masih ada field wajib yang belum terverifikasi.');return;}
        if(param!=='terima' && !unchecked.length){alert('Tandai data yang belum terverifikasi.');return;}
        const note=param==='terima' ? '' : prompt('Catatan verifikasi (opsional):') || '';
        saveReviews().then(()=>$.ajax({url:'/pengajuan/verifikasi',method:'POST',headers:{'X-CSRF-TOKEN':csrf},data:{pengajuan_no:no,param:param,status:param==='terima'?'terima':'tolak',keterangan:unchecked,note:note}}))
          .done(r=>{alert(r.massage);if(r.icon==='success')window.location='/daftar/'+r.tahun+'/detail';}).fail(x=>alert(x.responseJSON?.message||'Verifikasi gagal.'));
    });
});
</script>
@endpush
