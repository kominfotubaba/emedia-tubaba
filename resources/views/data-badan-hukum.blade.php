@extends('panel_theme.master')
@section('content')
<section class="data-perpers"><div class="content">
    <div class="logo d-flex justify-content-end pe-lg-4 pe-md-4 pe-3"><img class="img-fluid" src="/assets/img/pemda.svg" alt="Pemkab Tulang Bawang Barat"></div>
    <div class="row mb-4"><div class="col-12 jud">Data Perusahaan Pers</div><div class="col-12 mt-2">Daftar perusahaan pers terdaftar beserta data redaksi dan status persyaratannya.</div></div>
    <div class="row mb-3"><div class="col-md-4"><label class="form-label fw-bold" for="filter_jenis_media">Jenis Media</label><select id="filter_jenis_media" class="form-control"><option value="">Semua</option><option value="siber">Siber</option><option value="cetak">Cetak</option><option value="elektronik">Elektronik</option></select></div></div>
    <div id="filter_result_count" class="text-muted small mb-3" aria-live="polite">Memuat data...</div>
    <div class="data mt-3 m-0 p-0"><div class="table-responsive"><table id="companyTable" class="table table-hover" style="width:100%"><thead><tr><th>No.</th><th>Nama Media</th><th>Perusahaan Pers</th><th>Alamat Redaksi</th><th>Kontak</th><th>Pimpinan Redaksi</th><th>Pimpinan Perusahaan</th><th>status perusahaan pers</th><th>keterangan</th></tr></thead></table></div></div>
</div></section>

<div class="modal fade" id="catatanPersyaratanModal" tabindex="-1" aria-labelledby="catatanPersyaratanTitle" aria-hidden="true">
 <div class="modal-dialog modal-dialog-scrollable"><div class="modal-content">
  <div class="modal-header"><h5 class="modal-title" id="catatanPersyaratanTitle">Catatan Kelengkapan Data</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button></div>
  <div class="modal-body"><p id="catatanPersyaratanIsi" class="mb-3 text-break" style="white-space:pre-line"></p><p id="batasPelengkapanIsi" class="mb-0 small text-muted"></p></div>
 </div></div>
</div>
@endsection
@push('script')
<script>
$(function(){
 const link=(folder,file,label)=>file?`<a target="_blank" class="btn btn-sm btn-outline-primary mt-1" href="/dokumen/${folder}/${encodeURIComponent(file)}">${label}</a>`:'-';
 const text=value=>$('<div>').text(value || '').html();
 const attribute=value=>text(value).replace(/"/g,'&quot;').replace(/'/g,'&#039;');
 const socialLink=(label,value)=>{
  if(!value)return '';
  const source=String(value).trim(), href=/^https?:\/\//i.test(source)?source:`https://${source}`;
  try{const url=new URL(href);if(!['http:','https:'].includes(url.protocol))return '';}catch(error){return '';}
  return `<strong>${label}:</strong> <a target="_blank" rel="noopener noreferrer" href="${attribute(href)}">${text(source)}</a>`;
 };
 const address=record=>[record.alamatPerusahaan,record.alamatKecPerusahaan,record.alamatKabPerusahaan,record.alamatProvPerusahaan].filter(Boolean).map(text).join(', ') || '-';
 const contact=(record)=>{
  const details=[
   record.emailPerusahaan&&`<strong>Email:</strong> <a href="mailto:${attribute(record.emailPerusahaan)}">${text(record.emailPerusahaan)}</a>`,
   record.tlpnPerusahaan&&`<strong>No. HP:</strong> <a href="tel:${attribute(record.tlpnPerusahaan)}">${text(record.tlpnPerusahaan)}</a>`,
   socialLink('Website',record.alamatWebsite||record.alamat_website),socialLink('YouTube',record.linkYoutube),socialLink('Facebook',record.linkFacebook),
   socialLink('Instagram',record.linkInstagram),socialLink('TikTok',record.linkTiktok),socialLink('Threads',record.linkThreads),socialLink('X',record.linkX)
  ].filter(Boolean).join('<br>');
  return details ? `<small>${details}</small>` : '-';
 };
 const keterangan=(value,record)=>{
  if(value==='Memenuhi Syarat') return '<span class="badge bg-success">Memenuhi Syarat</span>';
  const expired=value==='Belum Lengkap', catatan=record.catatan_persyaratan||'Catatan kelengkapan belum tersedia.';
  const title=expired ? 'Batas waktu pelengkapan telah berakhir. Klik untuk melihat catatan.' : 'Arahkan mouse atau klik untuk melihat catatan kelengkapan.';
  return `<button type="button" class="btn btn-sm ${expired?'btn-danger':'btn-warning'} requirement-note" title="${attribute(title)}" data-catatan="${attribute(catatan)}" data-batas="${attribute(record.batas_pelengkapan||'')}">${text(value)}</button>`;
 };
 const table=$('#companyTable').DataTable({processing:true,serverSide:true,ordering:false,ajax:{url:'/data-all',data:d=>{d.param='badan';d.jenis_media=$('#filter_jenis_media').val()},dataSrc:r=>{ $('#filter_result_count').text(`${r.recordsFiltered||0} data`);return r.data;}},columns:[
  {data:null,render:(d,t,r,m)=>m.row+m.settings._iDisplayStart+1},{data:'namaMedia'},{data:'namaPerusahaan'},
  {data:null,render:(d,t,r)=>address(r)},
  {data:null,render:(d,t,r)=>contact(r)},
  {data:null,render:(d,t,r)=>(r.namaPimred||'-')+'<br><small>Kompetensi: '+text(r.jenisSerfikatUkwPimred||'-')+'</small><br>'+link('fileserfikatukwpimred',r.fileSerfikatUkwPimred,'Sertifikat')+' '+link('filesuratpernyataanpimred',r.fileSuratPernyataanPimred,'Surat Pernyataan')},
  {data:'pimprus'}, {data:'status_perusahaan_pers'}, {data:'keterangan_perusahaan_pers',render:(d,t,r)=>keterangan(d,r)}]});
 $('#filter_jenis_media').on('change',()=>table.ajax.reload());
 $('#companyTable').on('click','.requirement-note',function(){
  const catatan=$(this).data('catatan'), batas=$(this).data('batas');
  $('#catatanPersyaratanIsi').text(catatan);
  $('#batasPelengkapanIsi').text(batas ? `Batas waktu pelengkapan: ${batas}.` : 'Batas waktu pelengkapan belum tersedia.');
  bootstrap.Modal.getOrCreateInstance(document.getElementById('catatanPersyaratanModal')).show();
 });
});
</script>
@endpush
