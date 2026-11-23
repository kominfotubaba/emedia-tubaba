@extends('panel_theme.master')
@section('content')
<section class="data-perpers"><div class="content">
    <div class="logo d-flex justify-content-end pe-lg-4 pe-md-4 pe-3"><img class="img-fluid" src="/assets/img/pemda.svg" alt="Pemkab Tulang Bawang Barat"></div>
    <div class="row mb-4"><div class="col-12 jud">Data Perwakilan Media</div><div class="col-12 mt-2">Daftar wartawan biro/perwakilan media beserta kompetensi dan keanggotaan organisasinya.</div></div>
    <div class="row mb-3"><div class="col-md-4"><label class="form-label fw-bold" for="filter_jenis_media">Jenis Media</label><select id="filter_jenis_media" class="form-control"><option value="">Semua</option><option value="siber">Siber</option><option value="cetak">Cetak</option><option value="elektronik">Elektronik</option></select></div></div>
    <div id="filter_result_count" class="text-muted small mb-3" aria-live="polite">Memuat data...</div>
    <div id="representative_error" class="alert alert-danger" role="alert" hidden>
        Data perwakilan belum dapat dimuat. Koneksi ke server sedang bermasalah. Silakan coba lagi.
        <button type="button" id="retry_representatives" class="btn btn-sm btn-outline-danger ms-2">Coba lagi</button>
    </div>
    <div class="data mt-3 m-0 p-0"><div class="table-responsive"><table id="representativeTable" class="table table-hover" style="width:100%"><thead><tr><th>No.</th><th>Nama Media</th><th>Wartawan Biro/Perwakilan</th><th>Sertifikat Kompetensi</th><th>Alamat Wartawan</th><th>Organisasi Wartawan</th><th>Organisasi Perusahaan Pers</th></tr></thead></table></div></div>
</div></section>
@endsection
@push('script')
<script>
$(function(){
 $('#representativeTable').on('xhr.dt', function(event, settings, json, xhr){
  const failed = !json || !!json.error || xhr.status >= 400;
  $('#representative_error').prop('hidden', !failed);
  if(failed){
   $('#filter_result_count').text('Gagal memuat data.');
   return true; // Error ditampilkan di halaman, bukan popup bawaan DataTables.
  }
 });
 const link=(folder,file,label)=>file?`<br><a target="_blank" class="btn btn-sm btn-outline-primary mt-1" href="/dokumen/${folder}/${encodeURIComponent(file)}">${label}</a>`:'';
 const table=$('#representativeTable').DataTable({processing:true,serverSide:true,ordering:false,ajax:{url:'/data-all',data:d=>{d.param='perwakilan';d.jenis_media=$('#filter_jenis_media').val()},dataSrc:r=>{ $('#filter_result_count').text(`${r.recordsFiltered||0} data`);return r.data;}},columns:[
  {data:null,render:(d,t,r,m)=>m.row+m.settings._iDisplayStart+1},{data:'namaMedia'},
  {data:null,render:(d,t,r)=>(r.namaPerwakilan||'-')+link('filesuratketeranganwartawan',r.fileSuratKeteranganWartawan,'Surat Keterangan')},
  {data:null,render:(d,t,r)=>'No. '+(r.serfikatUkwPerwakilan||'-')+link('fileserfikatukwperwakilan',r.kompetensi_perwakilan,'Lihat Sertifikat')},
  {data:null,render:(d,t,r)=>[r.alamatPerwakilan,r.alamatKecPerwakilan,r.alamatKabPerwakilan,r.alamatProvPerwakilan].filter(Boolean).join(', ')},
  {data:null,render:(d,t,r)=>(r.organisasi_wartawan||'-')+link('filebuktikeanggotaanorganisasiwartawan',r.afiliasi_perwakilan,'Bukti Keanggotaan')},
  {data:null,render:(d,t,r)=>(r.organisasi_perusahaan_pers||'-')+link('filebuktikeanggotaanorganisasiperusahaanpers',r.bukti_organisasi_perusahaan_pers,'Bukti Keanggotaan')}]});
 $('#filter_jenis_media').on('change',()=>table.ajax.reload());
 $('#retry_representatives').on('click',()=>table.ajax.reload());
});
</script>
@endpush
