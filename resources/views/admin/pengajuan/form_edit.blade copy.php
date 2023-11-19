@foreach ($media_data as $md)
<div class="container">
    <!-- Title and Top Buttons Start -->
    <div class="page-title-container">
        <div class="row">
            <!-- Title Start -->
            <div class="col-12 col-md-7">
                <h1 class="mb-0 pb-0 display-4 text-capitalize" id="title">Edit Pengajuan media
                    {{ $md->jenis_media }}
                </h1>
                <!-- <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                                                                                                                                                                                                                            <ul class="breadcrumb pt-0">
                                                                                                                                                                                                                                <li class="breadcrumb-item"><a href="Dashboards.Default.html">Home</a></li>
                                                                                                                                                                                                                                <li class="breadcrumb-item"><a href="Interface.html">Interface</a></li>
                                                                                                                                                                                                                                <li class="breadcrumb-item"><a href="Interface.Content.html">Content</a></li>
                                                                                                                                                                                                                                <li class="breadcrumb-item"><a href="Interface.Content.Menu.html">Menu</a></li>
                                                                                                                                                                                                                            </ul>
                                                                                                                                                                                                                        </nav> -->
            </div>
            <!-- Title End -->
        </div>
    </div>
    <!-- Title and Top Buttons End -->

    <!-- Content Start -->
    <form class="validasi" novalidate>
        <section class="scroll-section">
            <div class="h3 text-primary text-capitalize">Data Perusahaan</div>
            <div class="card mb-5">
                <div class="card-body">
                    <section class="scroll-section" id="breakpointSpecificResponsive">
                        <div class="row mb-4">
                            <h2 class="small-title">Nama Perusahaan</h2>
                            <div class="form-floating">
                                <input id="namaPerusahaan" name="namaPerusahaan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->nama_perusahaan }}">
                                <div id="pengajuanNo" data-nopengajuan="{{ $md->pengajuan_no }}"></div>
                                <div id="pengajuanJenisMedia" data-jenisMedia="{{ $md->jenis_media }}"></div>
                                <label class="ps-4">Nama Perusahaan Sesuai AHU</label>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title">Nama Pimpinan Perusahaan</h2>
                            <div class="form-floating">
                                <input id="namaPimred" name="namaPimred" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->nama_pimred }}">
                                <label class="ps-4">Nama Pimpinan Perusahaan</label>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title">Kontak</h2>
                            <div class="col-lg-4 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">
                                <div class="form-floating">
                                    <input id="alamatPerusahaan" name="alamatPerusahaan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->alamat_perusahaan }}">
                                    <label class="ps-4">Alamat Perusahaan</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="tlpnPerusahaan" name="tlpnPerusahaan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->tlpn_perusahaan }}">
                                    <label class="ps-4">No Telpon Perusahaan</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="emailPerusahaan" name="emailPerusahaan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->email_perusahaan }}">
                                    <label class="ps-4">Email Perusahaan</label>
                                </div>
                            </div>
                        </div>

                        {{-- cok disini tambahin 2 kolom lagi  --}}
                        {{-- 1.  nama media cetak harian  --}}
                        <hr class="mb-4">

                        {{-- 2. nama dan alamat percetakan --}}
                        {{-- opsional harian --}}
                        @if ($md->jenis_media == 'harian')
                        <div class="row mb-4">
                            <h2 class="small-title">Percetakan</h2>
                            <div class="col-lg-6 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">
                                <div class="form-floating">
                                    <input id="namaPercetakan" name="namaPercetakan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->nama_percetakan }}">
                                    <label class="ps-4">Nama Percetakan</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-12 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="alamatPercetakan" name="alamatPercetakan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->alamat_percetakan }}">
                                    <label class="ps-4">Alamat Percetakan</label>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">
                        @endif

                        {{-- opsional Elektronik --}}
                        @if ($md->jenis_media == 'elektronik')
                        <div class="row mb-4">
                            <h2 class="small-title mb-md-0 mb-2">Dokumen izin Penyelenggaraan Penyiaran</h2>
                            <div class="form-floating">
                                <div class="dropzone dropzone-floating-label" id="fileIzinIpp"></div>
                                <label class="ps-4">File izin Penyelenggaraan Penyiaran</label>
                            </div>
                            <div class="col-12 mt-3">
                                <a href="/tmp/uploads/fileIzinIpp/{{ $md->file_izin_ipp }}" target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                    Izin IPP</a>
                            </div>
                        </div>

                        <hr class="mb-4">
                        @endif


                        <div class="row mb-4">
                            <h2 class="small-title">NPWP Perusahaan</h2>
                            <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input id="npwpPerusahaan" name="npwpPerusahaan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->npwp_perusahaan }}">
                                        <label class="ps-4">No NPWP Perusahaan</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <a href="/tmp/uploads/fileNpwpPerusahaan/{{ $md->file_npwp_perusahaan }}" target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                        Npwp</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-floating">
                                    <div class="dropzone dropzone-floating-label" id="fileNpwpPerusahaan" name="fileNpwpPerusahaan"></div>
                                    <label class="ps-4">File
                                        NPWP Perusahaan</label>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title mb-md-0 mb-2">Akta Pendirian dan Perubahan Perusahaan</h2>
                            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="aktaPerusahaan" name="aktaPerusahaan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->akta_perusahaan }}">
                                    <label class="ps-4">No Akta Pendirian Perusahaan</label>
                                </div>
                                <div class="col-12 mt-3">
                                    <a href="/tmp/uploads/fileAktaPerusahaan/{{ $md->file_akta_perusahaan }}" target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                        File</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <div class="dropzone dropzone-floating-label" id="fileAktaPerusahaan">
                                    </div>
                                    <label class="ps-4">File Akta Pendirian dan Perubahan Perusahaan</label>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title mb-md-0 mb-2">Pengesahan Kemenkumham Perusahaan</h2>
                            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="kumhamPerusahaan" name="kumhamPerusahaan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->kumham_perusahaan }}">
                                    <label class="ps-4">No Pengesahan Kemenkumham Perusahaan</label>
                                </div>
                                <div class="col-12 mt-3">
                                    <a href="/tmp/uploads/fileKumhamPerusahaan/{{ $md->file_kumham_perusahaan }}" target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                        File</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <div class="dropzone dropzone-floating-label" id="fileKumhamPerusahaan">
                                    </div>
                                    <label class="ps-4">File Pengesahan Kemenkumham Perusahaan</label>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title mb-md-0 mb-2">Wartawan Kompeten Perusahaan</h2>
                            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="wartawanKompetenPerusahaan" name="wartawanKompetenPerusahaan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->wartawan_kompeten_perusahaan }}"">
                                        <label class=" ps-4">Jumlah Wartawan
                                    Kompeten</label>
                                </div>
                                <div class="col-12 mt-3">
                                    <a href="/tmp/uploads/fileWartawanKompetenPerusahaan/{{ $md->file_wartawan_kompeten_perusahaan }}" target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                        File</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <div class="dropzone dropzone-floating-label" id="fileWartawanKompetenPerusahaan">
                                    </div>
                                    <label class="ps-4">File Wartawan Kompeten Perusahaan</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <h2 class="small-title mb-md-0 mb-2">Laporan SPT Pajak Tahunan Perusahaan</h2>
                            <div class="form-floating">
                                <div class="dropzone dropzone-floating-label" id="fileSptPerusahaan"></div>
                                <label class="ps-4">File Laporan Pajak Perusahaan</label>
                            </div>
                            <div class="col-12 mt-3">
                                <a href="/tmp/uploads/fileSptPerusahaan/{{ $md->file_spt_perusahaan }}" target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                    File</a>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title mb-md-0 mb-2">Verifikasi Dewan Pers Perusahaan</h2>
                            <div class="form-floating">
                                <div class="dropzone dropzone-floating-label" id="fileDewanPersPerusahaan">
                                </div>
                                <label class="ps-4">File Verifikasi Dewan Pers Perusahaan</label>
                            </div>
                            <div class="col-12 mt-3">
                                <a href="/tmp/uploads/fileDewanPersPerusahaan/{{ $md->file_dewan_pers_perusahaan }}" target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                    File</a>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title mb-md-0 mb-2">Afiliasi Organisasi Perusahaan Pers (Perusahaan)
                            </h2>
                            <div class="form-floating">
                                <div class="dropzone dropzone-floating-label" id="fileAfiliasiPerusahaan"></div>
                                <label class="ps-4">File Afiliasi Organisasi Pers</label>
                            </div>
                            <div class="col-12 mt-3">
                                <a href="/tmp/uploads/fileAfiliasiPerusahaan/{{ $md->file_afiliasi_perusahaan }}" target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                    File</a>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title mb-md-0 mb-2">Surat Pernyataan Nama Media dan Domisili</h2>
                            <div class="form-floating">
                                <div class="dropzone dropzone-floating-label" id="fileDomisiliPerusahaan">
                                </div>
                                <label class="ps-4">File Surat Pernyataan Nama Media dan Domisili </label>
                            </div>
                            <div class="col-12 mt-3">
                                <a href="/tmp/uploads/fileDomisiliPerusahaan/{{ $md->file_domisili_perusahaan }}" target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                    File</a>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title">Surat Kuasa Perwakilan Media</h2>
                            <div class="form-floating">
                                <div class="dropzone dropzone-floating-label" id="fileKuasaPerwakilan"></div>
                                <label class="ps-4">File Surat Kuasa Perwakilan Media</label>
                            </div>
                            <div class="col-12 mt-3">
                                <a href="/tmp/uploads/fileKuasaPerwakilan/{{ $md->file_kuasa_perwakilan }}" target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                    File</a>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title mb-md-0 mb-2">Surat Permohonan Kerjasama dan CV Perusahaan
                            </h2>
                            <div class="form-floating">
                                <div class="dropzone dropzone-floating-label" id="fileKerjasama"></div>
                                <label class="ps-4">Surat Permohonan Kerjasama</label>
                            </div>
                            <div class="col-12 mt-3">
                                <a href="/tmp/uploads/fileKerjasama/{{ $md->file_kerjasama }}" target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                    File</a>
                            </div>
                        </div>

                    </section>
                </div>
            </div>

            <div class="h3 text-primary">Data Perwakilan</div>
            <div class="card mb-5">
                <div class="card-body">
                    <section class="scroll-section" id="breakpointSpecificResponsive">

                        <div class="row mb-4">
                            <h2 class="small-title mb-md-0 mb-2">Nama Media</h2>
                            <div class="col-lg-12 col-md-12 col-12 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="namaMedia" name="namaMedia" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->nama_media }}">
                                    <label class="ps-4">Nama Media</label>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title">Nama Biro Perwakilan Media</h2>
                            <div class="form-floating">
                                <input id="namaBiroPerwakilan" name="namaBiroPerwakilan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->nama_biro_perwakilan }}">
                                <label class="ps-4">Nama Biro Perwakilan Media</label>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title">Kontak Perwakilan</h2>
                            <div class="col-lg-4 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">
                                <div class="form-floating">
                                    <input id="alamatPerwakilan" name="alamatPerwakilan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->alamat_perwakilan }}">
                                    <label class="ps-4">Alamat Perwakilan</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="tlpnPerwakilan" name="tlpnPerwakilan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->tlpn_perwakilan }}">
                                    <label class="ps-4">No Telpon Perwakilan</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="emailPerwakilan" name="emailPerwakilan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->email_perwakilan }}">
                                    <label class="ps-4">Email Perwakilan</label>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title mb-1">KTP Perwakilan</h2>
                            <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="ktpPerwakilan" name="ktpPerwakilan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->ktp_perwakilan }}">
                                    <label class="ps-4">No KTP Perwakilan</label>
                                </div>
                                <div class="col-12 mt-3">
                                    <a href="/tmp/uploads/fileKtpPerwakilan/{{ $md->file_ktp_perwakilan }}" target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                        File</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <div class="dropzone dropzone-floating-label" id="fileKtpPerwakilan">
                                    </div>
                                    <label class="ps-4">File KTP Perwakilan</label>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title mb-1">KK Perwakilan</h2>
                            <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="kkPerwakilan" name="kkPerwakilan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->kk_perwakilan }}">
                                    <label class="ps-4">No KK Perwakilan</label>
                                </div>
                                <div class="col-12 mt-3">
                                    <a href="/tmp/uploads/fileKKPerwakilan/{{ $md->file_kk_perwakilan }}" target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                        File</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <div class="dropzone dropzone-floating-label" id="fileKKPerwakilan"></div>
                                    <label class="ps-4">File KK Perwakilan</label>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title mb-1">NPWP Perwakilan</h2>
                            <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="npwpPerwakilan" name="npwpPerwakilan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->npwp_perwakilan }}">
                                    <label class="ps-4">No NPWP Perwakilan</label>
                                </div>
                                <div class="col-12 mt-3">
                                    <a href="/tmp/uploads/fileNpwpPerwakilan/{{ $md->file_npwp_perwakilan }}" target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                        File</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <div class="dropzone dropzone-floating-label" id="fileNpwpPerwakilan">
                                    </div>
                                    <label class="ps-4">File NPWP Perwakilan </label>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title mb-1">Dokumen Kompetensi Perwakilan Media</h2>
                            <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="kompetensiPerwakilan" name="kompetensiPerwakilan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->kompetensi_perwakilan }}">
                                    <label class="ps-4">Jenis Kompetensi Perwakilan Media</label>
                                </div>
                                <div class="col-12 mt-3">
                                    <a href="/tmp/uploads/fileKopetensiPerwakilan/{{ $md->file_kopetensi_perwakilan }}" target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                        File</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <div class="dropzone dropzone-floating-label" id="fileKopetensiPerwakilan">
                                    </div>
                                    <label class="ps-4">File Dokumen Kompetensi Perwakilan Media</label>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title mb-1">Afiliasi Organisasi Pers (Organisasi Wartawan)</h2>
                            <div class="form-floating">
                                <div class="dropzone dropzone-floating-label" id="fileAfiliasiPerwakilan">
                                </div>
                                <label class="ps-4">File Afiliasi Organisasi Pers (Organisasi Wartawan)
                                </label>
                            </div>
                            <div class="col-12 mt-3">
                                <a href="/tmp/uploads/fileAfiliasiPerwakilan/{{ $md->file_afiliasi_perwakilan }}" target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                    File</a>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title mb-1">Keterangan Domisili Perwakilan Media</h2>
                            <div class="form-floating">
                                <div class="dropzone dropzone-floating-label" id="fileDomisiliPerwakilan">
                                </div>
                                <label class="ps-4">File Keterangan Domisili Perwakilan Media</label>
                            </div>
                            <div class="col-12 mt-3">
                                <a href="/tmp/uploads/fileDomisiliPerwakilan/{{ $md->file_domisili_perwakilan }}" target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                    File</a>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title mb-1">Surat Pernyataan Mematuhi Kode Etik Jurnalistik</h2>
                            <div class="form-floating">
                                <div class="dropzone dropzone-floating-label" id="fileKodeEtikPerwakilan">
                                </div>
                                <label class="ps-4">File Surat Pernyataan Mematuhi Kode Etik
                                    Jurnalistik</label>
                            </div>
                            <div class="col-12 mt-3">
                                <a href="/tmp/uploads/fileKodeEtikPerwakilan/{{ $md->file_kode_etik_perwakilan }}" target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                    File</a>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title">Surat Pernyataan 1 Perusahaan 1 Media</h2>
                            <div class="form-floating">
                                <div class="dropzone dropzone-floating-label" id="filePernyataanMediaPerwakilan">
                                </div>
                                <label class="ps-4">File Surat Pernyataan 1 Perusahaan 1 Media </label>
                            </div>
                            <div class="col-12 mt-3">
                                <a href="/tmp/uploads/filePernyataanMediaPerwakilan/{{ $md->file_pernyataan_media_perwakilan }}" target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                    File</a>
                            </div>
                        </div>

                    </section>
                </div>
            </div>

            <div class="h3 text-primary">Data Rekening</div>
            <div class="card mb-5">
                <div class="card-body">
                    <section class="scroll-section" id="breakpointSpecificResponsive">
                        <div class="row mb-4">
                            <h2 class="small-title">Rekening Bank</h2>
                            <div class="col-lg-6 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">

                                <div class="top-label mb-2 w-100">
                                    <select name="jenisRekening" id="jenisRekening">
                                        <option value="{{ $md->jenis_rekening }}">{{ $md->jenis_rekening }}
                                        </option>
                                        <option value="perusahaan">perusahaan</option>
                                        <option value="perwakilan">Perwakilan</option>
                                    </select>
                                    <span>Jenis Rekening</span>
                                </div>

                                <div class="form-floating mb-2">
                                    <input id="namaBank" name="namaBank" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->nama_bank }}">
                                    <label class="ps-4">Nama Bank</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <input id="pemilikRekening" name="pemilikRekening" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->pemilik_rekening }}">
                                    <label class="ps-4">Nama Pemilik Rekening</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <input id="noRekening" name="noRekening" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->no_rekening }}">
                                    <label class="ps-4">No Rekening Perusahaan</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">
                                <div class="form-floating">
                                    <div class="dropzone dropzone-floating-label" id="fileRekening"></div>
                                    <label class="ps-4">File
                                        Rekening Perusahaan</label>
                                </div>
                                <div class="col-12 mt-3">
                                    <a href="/tmp/uploads/fileRekening/{{ $md->file_rekening }}" target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                        File</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <div class="h3 text-primary">Signature</div>
            <div class="card mb-5">
                <div class="card-body">
                    <section class="scroll-section" id="breakpointSpecificResponsive">
                        <div class="container">
                            <h2 class="small-title">Tanda Tangan Disini</h2>
                            <div class="d-flex justify-content-center mb-2">
                                <canvas id="signature-pad" style="width: 300px; height: 200px;" class="border signature-pad "></canvas>
                            </div>
                            <input id="signatureData" type="text" value="{{ $md->file_signature_data }}" disabled hidden>
                            <div class="d-flex justify-content-end p-3">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button id="saveTtdPng" class="btn btn-success">Simpan</button>
                                    <button id="clearTtd" class="btn btn-danger">Ulangi</button>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="col-12 p-2">

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="pernyataanCheckbox" name="pernyataanCheckbox">
                                <label class="form-check-label" for="invalidCheck">
                                    Saya menyatakan bahwa data yang saya isi adalah sebenar-benarnya, jika ada
                                    pemalsuan data yang ditemukan maka saya siap diproses sesuai dengan hukum
                                    yang
                                    berlaku.
                                </label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end p-2">
                            <button id="kirimData" type="submit" class="btn btn-primary">Kirim Data</button>
                        </div>
                    </section>
                </div>
            </div>

        </section>
    </form>
    <!-- Content End -->
</div>
@endforeach
<script>
    /**
     *
     * File UploadDropzone and send data
     *
     **/
    $(document).ready(function() {
        //=== PERUSAHAAN ====//
        if ($('#pengajuanJenisMedia').attr('data-jenisMedia') == 'elektronik') {
            // fileIzinIpp
            var dropzoneNpwpPerusahaan = new Dropzone('#fileIzinIpp', {
                url: '/pengajuan/uploads',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                init: function() {
                    var param = 'fileIzinIpp';

                    var nameMock = '{{ $md->file_izin_ipp }}';
                    var mockFiles = {
                        name: nameMock,
                        size: 1
                    };

                    this.emit("addedfile", mockFiles);
                    this.emit("thumbnail", mockFiles,
                        '/assets/img/logo/pdf_logo.png');
                    this.files.push(nameMock);

                    this.on('addedfile', function(file) {
                        this.removeFile(mockFiles);
                    });

                    this.on('success', function(file, response) {
                        Swal.fire({
                            toast: true,
                            position: 'bottom-right',
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.original_name +
                                ' Berhasil diupload!',
                            showConfirmButton: false,
                            timer: 3500
                        });
                        $('#' + param + ' .dz-details').html('<span>' + response.name +
                            '</span>')
                        console.log(response);
                    });
                    this.on('error', function() {
                        Swal.fire({
                            toast: true,
                            position: 'bottom-right',
                            icon: 'error',
                            title: 'Upload Gagal',
                            text: 'Cek Koneksi Internet!',
                            showConfirmButton: false,
                            timer: 3500
                        });
                        this.removeAllFiles();
                    });
                    this.on('resetFiles', function() {
                        this.removeAllFiles();
                    });
                    this.on('sending', function(file, response, formData) {
                        formData.append('data', param);
                    });
                    this.on("maxfilesexceeded", function(file) {
                        this.removeAllFiles();
                        this.addFile(file);
                    });
                },
                acceptedFiles: '.pdf',
                maxFiles: 1,
                uploadMultiple: false,
                thumbnailWidth: 160,
                dictDefaultMessage: 'Uploads Ulang',
                previewTemplate: DropzoneTemplates.previewTemplate,
            });
        }

        // fileNPWP
        var dropzoneNpwpPerusahaan = new Dropzone('#fileNpwpPerusahaan', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileNpwpPerusahaan';
                var nameMock = '{{ $md->file_npwp_perusahaan }}';
                var mockFiles = {
                    name: nameMock,
                    size: 1
                };

                this.emit("addedfile", mockFiles);
                this.emit("thumbnail", mockFiles,
                    '/assets/img/logo/pdf_logo.png');
                this.files.push(nameMock);

                this.on('addedfile', function(file) {
                    this.removeFile(mockFiles);
                });
                this.on('success', function(file, response) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.original_name +
                            ' Berhasil diupload!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $('#' + param + ' .dz-details').html('<span>' + response.name +
                        '</span>')
                });
                this.on('error', function() {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'error',
                        title: 'Upload Gagal',
                        text: 'Cek Koneksi Internet!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.removeAllFiles();
                });
                this.on('resetFiles', function() {
                    this.removeAllFiles();
                });
                this.on('sending', function(file, response, formData) {
                    formData.append('data', param);
                });
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            acceptedFiles: '.pdf',
            maxFiles: 1,
            uploadMultiple: false,
            thumbnailWidth: 160,
            dictDefaultMessage: 'Uploads Ulang',
            previewTemplate: DropzoneTemplates.previewTemplate,
        });

        // fileAkta
        var dropzoneAktaPerusahaan = new Dropzone('#fileAktaPerusahaan', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileAktaPerusahaan';

                var nameMock = '{{ $md->file_akta_perusahaan }}';
                var mockFiles = {
                    name: nameMock,
                    size: 1
                };

                this.emit("addedfile", mockFiles);
                this.emit("thumbnail", mockFiles,
                    '/assets/img/logo/pdf_logo.png');
                this.files.push(nameMock);

                this.on('addedfile', function(file) {
                    this.removeFile(mockFiles);
                });
                this.on('success', function(file, response) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.original_name +
                            ' Berhasil diupload!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $('#' + param + ' .dz-details').html('<span>' + response.name +
                        '</span>')
                });
                this.on('error', function() {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'error',
                        title: 'Upload Gagal',
                        text: 'Cek file atau koneksi!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.removeAllFiles();
                });
                this.on('resetFiles', function() {
                    this.removeAllFiles();
                });
                this.on('sending', function(file, response, formData) {
                    formData.append('data', param);
                });
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            acceptedFiles: '.pdf',
            maxFiles: 1,
            uploadMultiple: false,
            thumbnailWidth: 160,
            dictDefaultMessage: 'Upload Ulang',
            previewTemplate: DropzoneTemplates.previewTemplate,
        });

        // fileKumham
        var dropzoneKumhamPerusahaan = new Dropzone('#fileKumhamPerusahaan', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileKumhamPerusahaan';
                var nameMock = '{{ $md->file_kumham_perusahaan }}';
                var mockFiles = {
                    name: nameMock,
                    size: 1
                };

                this.emit("addedfile", mockFiles);
                this.emit("thumbnail", mockFiles,
                    '/assets/img/logo/pdf_logo.png');
                this.files.push(nameMock);
                this.on('addedfile', function(file) {
                    this.removeFile(mockFiles);
                });
                this.on('addedfile', function(file) {
                    this.removeFile(mockFiles);
                });
                this.on('success', function(file, response) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.original_name +
                            ' Berhasil diupload!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $('#' + param + ' .dz-details').html('<span>' + response.name +
                        '</span>')
                });
                this.on('error', function() {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'error',
                        title: 'Upload Gagal',
                        text: 'Cek file atau koneksi!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.removeAllFiles();
                });
                this.on('resetFiles', function() {
                    this.removeAllFiles();
                });
                this.on('sending', function(file, response, formData) {
                    formData.append('data', param);
                });
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            acceptedFiles: '.pdf',
            maxFiles: 1,
            uploadMultiple: false,
            thumbnailWidth: 160,
            dictDefaultMessage: 'Upload Ulang',
            previewTemplate: DropzoneTemplates.previewTemplate,
        });

        // fileWartawanKompetenPerusahaan
        var dropzoneWartawanKompetenPerusahaan = new Dropzone('#fileWartawanKompetenPerusahaan', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileWartawanKompetenPerusahaan';
                var nameMock = '{{ $md->file_wartawan_kompeten_perusahaan }}';
                var mockFiles = {
                    name: nameMock,
                    size: 1
                };

                this.emit("addedfile", mockFiles);
                this.emit("thumbnail", mockFiles,
                    '/assets/img/logo/pdf_logo.png');
                this.files.push(nameMock);
                this.on('addedfile', function(file) {
                    this.removeFile(mockFiles);
                });
                this.on('success', function(file, response) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.original_name +
                            ' Berhasil diupload!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $('#' + param + ' .dz-details').html('<span>' + response.name +
                        '</span>')
                });
                this.on('error', function() {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'error',
                        title: 'Upload Gagal',
                        text: 'Cek file atau koneksi!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.removeAllFiles();
                });
                this.on('resetFiles', function() {
                    this.removeAllFiles();
                });
                this.on('sending', function(file, response, formData) {
                    formData.append('data', param);
                });
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            acceptedFiles: '.pdf',
            maxFiles: 1,
            uploadMultiple: false,
            thumbnailWidth: 160,
            dictDefaultMessage: 'Uploads Disini',
            previewTemplate: DropzoneTemplates.previewTemplate,
        });

        // fileDewanPers
        var dropzoneDewanPersPerusahaan = new Dropzone('#fileDewanPersPerusahaan', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileDewanPersPerusahaan';
                var nameMock = '{{ $md->file_dewan_pers_perusahaan }}';
                var mockFiles = {
                    name: nameMock,
                    size: 1
                };

                this.emit("addedfile", mockFiles);
                this.emit("thumbnail", mockFiles,
                    '/assets/img/logo/pdf_logo.png');
                this.files.push(nameMock);
                this.on('addedfile', function(file) {
                    this.removeFile(mockFiles);
                });
                this.on('success', function(file, response) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.original_name +
                            ' Berhasil diupload!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $('#' + param + ' .dz-details').html('<span>' + response.name +
                        '</span>')
                });
                this.on('error', function() {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'error',
                        title: 'Upload Gagal',
                        text: 'Cek file atau koneksi!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.removeAllFiles();
                });
                this.on('resetFiles', function() {
                    this.removeAllFiles();
                });
                this.on('sending', function(file, response, formData) {
                    formData.append('data', param);
                });
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            acceptedFiles: '.pdf',
            maxFiles: 1,
            uploadMultiple: false,
            thumbnailWidth: 160,
            dictDefaultMessage: 'Upload Ulang',
            previewTemplate: DropzoneTemplates.previewTemplate,
        });


        // fileAfiliasiPerusahaan
        var dropzoneAfiliasiPerusahaan = new Dropzone('#fileAfiliasiPerusahaan', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileAfiliasiPerusahaan';
                var nameMock = '{{ $md->file_afiliasi_perusahaan }}';
                var mockFiles = {
                    name: nameMock,
                    size: 1
                };

                this.emit("addedfile", mockFiles);
                this.emit("thumbnail", mockFiles,
                    '/assets/img/logo/pdf_logo.png');
                this.files.push(nameMock);
                this.on('addedfile', function(file) {
                    this.removeFile(mockFiles);
                });
                this.on('success', function(file, response) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.original_name +
                            ' Berhasil diupload!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $('#' + param + ' .dz-details').html('<span>' + response.name +
                        '</span>')
                });
                this.on('error', function() {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'error',
                        title: 'Upload Gagal',
                        text: 'Cek file atau koneksi!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.removeAllFiles();
                });
                this.on('resetFiles', function() {
                    this.removeAllFiles();
                });
                this.on('sending', function(file, response, formData) {
                    formData.append('data', param);
                });
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            acceptedFiles: '.pdf',
            maxFiles: 1,
            uploadMultiple: false,
            thumbnailWidth: 160,
            dictDefaultMessage: 'Uploads Disini',
            previewTemplate: DropzoneTemplates.previewTemplate,
        });

        // fileSpt
        var dropzoneSptPerusahaan = new Dropzone('#fileSptPerusahaan', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileSptPerusahaan';
                var nameMock = '{{ $md->file_spt_perusahaan }}';
                var mockFiles = {
                    name: nameMock,
                    size: 1
                };

                this.emit("addedfile", mockFiles);
                this.emit("thumbnail", mockFiles,
                    '/assets/img/logo/pdf_logo.png');
                this.files.push(nameMock);
                this.on('addedfile', function(file) {
                    this.removeFile(mockFiles);
                });
                this.on('success', function(file, response) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.original_name +
                            ' Berhasil diupload!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $('#' + param + ' .dz-details').html('<span>' + response.name +
                        '</span>');
                });
                this.on('error', function() {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'error',
                        title: 'Upload Gagal',
                        text: 'Cek file atau koneksi!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.removeAllFiles();
                });
                this.on('resetFiles', function() {
                    this.removeAllFiles();
                });
                this.on('sending', function(file, response, formData) {
                    formData.append('data', param);
                });
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            acceptedFiles: '.pdf',
            maxFiles: 1,
            uploadMultiple: false,
            thumbnailWidth: 160,
            dictDefaultMessage: 'Upload Ulang',
            previewTemplate: DropzoneTemplates.previewTemplate,
        });

        // fileDomisili
        var dropzoneDomisiliPerusahaan = new Dropzone('#fileDomisiliPerusahaan', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileDomisiliPerusahaan';
                var nameMock = '{{ $md->file_domisili_perusahaan }}';
                var mockFiles = {
                    name: nameMock,
                    size: 1
                };

                this.emit("addedfile", mockFiles);
                this.emit("thumbnail", mockFiles,
                    '/assets/img/logo/pdf_logo.png');
                this.files.push(nameMock);
                this.on('addedfile', function(file) {
                    this.removeFile(mockFiles);
                });
                this.on('success', function(file, response) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.original_name +
                            ' Berhasil diupload!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $('#' + param + ' .dz-details').html('<span>' + response.name +
                        '</span>');
                });
                this.on('error', function() {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'error',
                        title: 'Upload Gagal',
                        text: 'Cek file atau koneksi!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.removeAllFiles();
                });
                this.on('resetFiles', function() {
                    this.removeAllFiles();
                });
                this.on('sending', function(file, response, formData) {
                    formData.append('data', param);
                });
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            acceptedFiles: '.pdf',
            maxFiles: 1,
            uploadMultiple: false,
            thumbnailWidth: 160,
            dictDefaultMessage: 'Upload Ulang',
            previewTemplate: DropzoneTemplates.previewTemplate,
        });

        // fileKuasaPerwakilan
        var dropzoneKuasaPerwakilan = new Dropzone('#fileKuasaPerwakilan', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileKuasaPerwakilan';
                var nameMock = '{{ $md->file_kuasa_perwakilan }}';
                var mockFiles = {
                    name: nameMock,
                    size: 1
                };

                this.emit("addedfile", mockFiles);
                this.emit("thumbnail", mockFiles,
                    '/assets/img/logo/pdf_logo.png');
                this.files.push(nameMock);
                this.on('addedfile', function(file) {
                    this.removeFile(mockFiles);
                });
                this.on('success', function(file, response) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.original_name +
                            ' Berhasil diupload!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $('#' + param + ' .dz-details').html('<span>' + response.name +
                        '</span>');
                });
                this.on('error', function() {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'error',
                        title: 'Upload Gagal',
                        text: 'Cek file atau koneksi!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.removeAllFiles();
                });
                this.on('resetFiles', function() {
                    this.removeAllFiles();
                });
                this.on('sending', function(file, response, formData) {
                    formData.append('data', param);
                });
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            acceptedFiles: '.pdf',
            maxFiles: 1,
            uploadMultiple: false,
            thumbnailWidth: 160,
            dictDefaultMessage: 'Upload Ulang',
            previewTemplate: DropzoneTemplates.previewTemplate,
        });

        // fileKerjasama
        var dropzoneKerjasama = new Dropzone('#fileKerjasama', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileKerjasama';
                var nameMock = '{{ $md->file_kerjasama }}';
                var mockFiles = {
                    name: nameMock,
                    size: 1
                };

                this.emit("addedfile", mockFiles);
                this.emit("thumbnail", mockFiles,
                    '/assets/img/logo/pdf_logo.png');
                this.files.push(nameMock);
                this.on('addedfile', function(file) {
                    this.removeFile(mockFiles);
                });
                this.on('success', function(file, response) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.original_name +
                            ' Berhasil diupload!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $('#' + param + ' .dz-details').html('<span>' + response.name +
                        '</span>');
                });
                this.on('error', function() {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'error',
                        title: 'Upload Gagal',
                        text: 'Cek file atau koneksi!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.removeAllFiles();
                });
                this.on('resetFiles', function() {
                    this.removeAllFiles();
                });
                this.on('sending', function(file, response, formData) {
                    formData.append('data', param);
                });
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            acceptedFiles: '.pdf',
            maxFiles: 1,
            uploadMultiple: false,
            thumbnailWidth: 160,
            dictDefaultMessage: 'Upload Ulang',
            previewTemplate: DropzoneTemplates.previewTemplate,
        });


        //=== PERWAKILAN ===//

        // fileKtpPerwakilan
        var dropzoneKtpPerwakilan = new Dropzone('#fileKtpPerwakilan', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileKtpPerwakilan';
                var nameMock = '{{ $md->file_ktp_perwakilan }}';
                var mockFiles = {
                    name: nameMock,
                    size: 1
                };

                this.emit("addedfile", mockFiles);
                this.emit("thumbnail", mockFiles,
                    '/assets/img/logo/pdf_logo.png');
                this.files.push(nameMock);
                this.on('addedfile', function(file) {
                    this.removeFile(mockFiles);
                });
                this.on('success', function(file, response) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.original_name +
                            ' Berhasil diupload!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $('#' + param + ' .dz-details').html('<span>' + response.name +
                        '</span>');
                });
                this.on('error', function() {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'error',
                        title: 'Upload Gagal',
                        text: 'Cek file atau koneksi!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.removeAllFiles();
                });
                this.on('resetFiles', function() {
                    this.removeAllFiles();
                });
                this.on('sending', function(file, response, formData) {
                    formData.append('data', param);
                });
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            acceptedFiles: '.pdf',
            maxFiles: 1,
            uploadMultiple: false,
            thumbnailWidth: 160,
            dictDefaultMessage: 'Upload Ulang',
            previewTemplate: DropzoneTemplates.previewTemplate,
        });

        // fileKKPerwakilan
        var dropzoneKKPerwakilan = new Dropzone('#fileKKPerwakilan', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileKKPerwakilan';
                var nameMock = '{{ $md->file_kk_perwakilan }}';
                var mockFiles = {
                    name: nameMock,
                    size: 1
                };
                this.emit("addedfile", mockFiles);
                this.emit("thumbnail", mockFiles,
                    '/assets/img/logo/pdf_logo.png');
                this.files.push(nameMock);
                this.on('addedfile', function(file) {
                    this.removeFile(mockFiles);
                });
                this.on('success', function(file, response) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.original_name +
                            ' Berhasil diupload!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $('#' + param + ' .dz-details').html('<span>' + response.name +
                        '</span>');
                });
                this.on('error', function() {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'error',
                        title: 'Upload Gagal',
                        text: 'Cek file atau koneksi!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.removeAllFiles();
                });
                this.on('resetFiles', function() {
                    this.removeAllFiles();
                });
                this.on('sending', function(file, response, formData) {
                    formData.append('data', param);
                });
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            acceptedFiles: '.pdf',
            maxFiles: 1,
            uploadMultiple: false,
            thumbnailWidth: 160,
            dictDefaultMessage: 'Upload Ulang',
            previewTemplate: DropzoneTemplates.previewTemplate,
        });

        // fileNPWPperwakilan
        var dropzoneNpwpPerwakilan = new Dropzone('#fileNpwpPerwakilan', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileNpwpPerwakilan';
                var nameMock = '{{ $md->file_npwp_perwakilan }}';
                var mockFiles = {
                    name: nameMock,
                    size: 1
                };

                this.emit("addedfile", mockFiles);
                this.emit("thumbnail", mockFiles,
                    '/assets/img/logo/pdf_logo.png');
                this.files.push(nameMock);
                this.on('addedfile', function(file) {
                    this.removeFile(mockFiles);
                });
                this.on('success', function(file, response) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.original_name +
                            ' Berhasil diupload!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $('#' + param + ' .dz-details').html('<span>' + response.name +
                        '</span>');
                });
                this.on('error', function() {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'error',
                        title: 'Upload Gagal',
                        text: 'Cek file atau koneksi!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.removeAllFiles();
                });
                this.on('resetFiles', function() {
                    this.removeAllFiles();
                });
                this.on('sending', function(file, response, formData) {
                    formData.append('data', param);
                });
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            acceptedFiles: '.pdf',
            maxFiles: 1,
            uploadMultiple: false,
            thumbnailWidth: 160,
            dictDefaultMessage: 'Upload Ulang',
            previewTemplate: DropzoneTemplates.previewTemplate,
        });

        // fileKopetensiPerwakilan
        var dropzoneKopetensiPerwakilan = new Dropzone('#fileKopetensiPerwakilan', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileKopetensiPerwakilan';
                var nameMock = '{{ $md->file_kopetensi_perwakilan }}';
                var mockFiles = {
                    name: nameMock,
                    size: 1
                };

                this.emit("addedfile", mockFiles);
                this.emit("thumbnail", mockFiles,
                    '/assets/img/logo/pdf_logo.png');
                this.files.push(nameMock);
                this.on('addedfile', function(file) {
                    this.removeFile(mockFiles);
                });
                this.on('success', function(file, response) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.original_name +
                            ' Berhasil diupload!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $('#' + param + ' .dz-details').html('<span>' + response.name +
                        '</span>');
                });
                this.on('error', function() {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'error',
                        title: 'Upload Gagal',
                        text: 'Cek file atau koneksi!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.removeAllFiles();
                });
                this.on('resetFiles', function() {
                    this.removeAllFiles();
                });
                this.on('sending', function(file, response, formData) {
                    formData.append('data', param);
                });
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            acceptedFiles: '.pdf',
            maxFiles: 1,
            uploadMultiple: false,
            thumbnailWidth: 160,
            dictDefaultMessage: 'Upload Ulang',
            previewTemplate: DropzoneTemplates.previewTemplate,
        });

        // fileAfiliasiPerwakilan
        var dropzoneAfiliasiPerwakilan = new Dropzone('#fileAfiliasiPerwakilan', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileAfiliasiPerwakilan';
                var nameMock = '{{ $md->file_afiliasi_perwakilan }}';
                var mockFiles = {
                    name: nameMock,
                    size: 1
                };

                this.emit("addedfile", mockFiles);
                this.emit("thumbnail", mockFiles,
                    '/assets/img/logo/pdf_logo.png');
                this.files.push(nameMock);
                this.on('addedfile', function(file) {
                    this.removeFile(mockFiles);
                });
                this.on('success', function(file, response) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.original_name +
                            ' Berhasil diupload!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $('#' + param + ' .dz-details').html('<span>' + response.name +
                        '</span>');
                });
                this.on('error', function() {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'error',
                        title: 'Upload Gagal',
                        text: 'Cek file atau koneksi!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.removeAllFiles();
                });
                this.on('resetFiles', function() {
                    this.removeAllFiles();
                });
                this.on('sending', function(file, response, formData) {
                    formData.append('data', param);
                });
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            acceptedFiles: '.pdf',
            maxFiles: 1,
            uploadMultiple: false,
            thumbnailWidth: 160,
            dictDefaultMessage: 'Upload Ulang',
            previewTemplate: DropzoneTemplates.previewTemplate,
        });

        // fileDomisiliPerwakilan
        var dropzoneDomisiliPerwakilan = new Dropzone('#fileDomisiliPerwakilan', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileDomisiliPerwakilan';
                var nameMock = '{{ $md->file_domisili_perwakilan }}';
                var mockFiles = {
                    name: nameMock,
                    size: 1
                };

                this.emit("addedfile", mockFiles);
                this.emit("thumbnail", mockFiles,
                    '/assets/img/logo/pdf_logo.png');
                this.files.push(nameMock);
                this.on('addedfile', function(file) {
                    this.removeFile(mockFiles);
                });
                this.on('success', function(file, response) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.original_name +
                            ' Berhasil diupload!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $('#' + param + ' .dz-details').html('<span>' + response.name +
                        '</span>');
                });
                this.on('error', function() {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'error',
                        title: 'Upload Gagal',
                        text: 'Cek file atau koneksi!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.removeAllFiles();
                });
                this.on('resetFiles', function() {
                    this.removeAllFiles();
                });
                this.on('sending', function(file, response, formData) {
                    formData.append('data', param);
                });
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            acceptedFiles: '.pdf',
            maxFiles: 1,
            uploadMultiple: false,
            thumbnailWidth: 160,
            dictDefaultMessage: 'Upload Ulang',
            previewTemplate: DropzoneTemplates.previewTemplate,
        });

        // fileKodeEtikPerwakilan
        var dropzoneKodeEtikPerwakilan = new Dropzone('#fileKodeEtikPerwakilan', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileKodeEtikPerwakilan';
                var nameMock = '{{ $md->file_kode_etik_perwakilan }}';
                var mockFiles = {
                    name: nameMock,
                    size: 1
                };

                this.emit("addedfile", mockFiles);
                this.emit("thumbnail", mockFiles,
                    '/assets/img/logo/pdf_logo.png');
                this.files.push(nameMock);
                this.on('addedfile', function(file) {
                    this.removeFile(mockFiles);
                });
                this.on('success', function(file, response) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.original_name +
                            ' Berhasil diupload!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $('#' + param + ' .dz-details').html('<span>' + response.name +
                        '</span>');
                });
                this.on('error', function() {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'error',
                        title: 'Upload Gagal',
                        text: 'Cek file atau koneksi!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.removeAllFiles();
                });
                this.on('resetFiles', function() {
                    this.removeAllFiles();
                });
                this.on('sending', function(file, response, formData) {
                    formData.append('data', param);
                });
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            acceptedFiles: '.pdf',
            maxFiles: 1,
            uploadMultiple: false,
            thumbnailWidth: 160,
            dictDefaultMessage: 'Upload Ulang',
            previewTemplate: DropzoneTemplates.previewTemplate,
        });

        // filePernyataanMedia
        var dropzonePernyataanMediaPerwakilan = new Dropzone('#filePernyataanMediaPerwakilan', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'filePernyataanMediaPerwakilan';
                var nameMock = '{{ $md->file_pernyataan_media_perwakilan }}';
                var mockFiles = {
                    name: nameMock,
                    size: 1
                };

                this.emit("addedfile", mockFiles);
                this.emit("thumbnail", mockFiles,
                    '/assets/img/logo/pdf_logo.png');
                this.files.push(nameMock);
                this.on('addedfile', function(file) {
                    this.removeFile(mockFiles);
                });
                this.on('success', function(file, response) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.original_name +
                            ' Berhasil diupload!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $('#' + param + ' .dz-details').html('<span>' + response.name +
                        '</span>');
                });
                this.on('error', function() {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'error',
                        title: 'Upload Gagal',
                        text: 'Cek file atau koneksi!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.removeAllFiles();
                });
                this.on('resetFiles', function() {
                    this.removeAllFiles();
                });
                this.on('sending', function(file, response, formData) {
                    formData.append('data', param);
                });
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            acceptedFiles: '.pdf',
            maxFiles: 1,
            uploadMultiple: false,
            thumbnailWidth: 160,
            dictDefaultMessage: 'Upload Ulang',
            previewTemplate: DropzoneTemplates.previewTemplate,
        });

        // fileRekening
        var dropzoneRekening = new Dropzone('#fileRekening', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileRekening';
                var nameMock = '{{ $md->file_rekening }}';
                var mockFiles = {
                    name: nameMock,
                    size: 1
                };

                this.emit("addedfile", mockFiles);
                this.emit("thumbnail", mockFiles,
                    '/assets/img/logo/pdf_logo.png');
                this.files.push(nameMock);
                this.on('addedfile', function(file) {
                    this.removeFile(mockFiles);
                });
                this.on('success', function(file, response) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.original_name +
                            ' Berhasil diupload!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $('#' + param + ' .dz-details').html('<span>' + response.name +
                        '</span>');
                });
                this.on('error', function() {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-right',
                        icon: 'error',
                        title: 'Upload Gagal',
                        text: 'Cek file atau koneksi!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.removeAllFiles();
                });
                this.on('resetFiles', function() {
                    this.removeAllFiles();
                });
                this.on('sending', function(file, response, formData) {
                    formData.append('data', param);
                });
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            acceptedFiles: '.pdf',
            maxFiles: 1,
            uploadMultiple: false,
            thumbnailWidth: 160,
            dictDefaultMessage: 'Upload Ulang',
            previewTemplate: DropzoneTemplates.previewTemplate,
        });
    });

    /**
     * button
     **/
    $(document).ready(function() {
        /**
         * setting ttd
         **/
        //  add ttd
        const canvas = document.querySelector("canvas");
        const signaturePad = new SignaturePad(canvas, {
            penColor: "rgb(66, 133, 244)"
        });

        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
            signaturePad.clear(); // otherwise isEmpty() might return incorrect value
        }

        window.addEventListener("resize", resizeCanvas);
        resizeCanvas();

        signaturePad.fromDataURL("/tmp/uploads/uploadsignature/{{ $md->file_signature_data }}");
        $('#saveTtdPng').prop('disabled', true);
        signaturePad.off();

        $('#clearTtd').click(function(e) {
            e.preventDefault();
            signaturePad.clear();
            signaturePad.on();
            $('#saveTtdPng').prop('disabled', false);
        });

        $('#saveTtdPng').click(function(e) {
            // validasi ttd
            if (signaturePad.isEmpty()) {
                Swal.fire({
                    toast: true,
                    position: 'bottom-right',
                    icon: 'error',
                    title: 'Tanda Tanggan',
                    text: 'Tanda Tangan Harap Disi',
                    showConfirmButton: false,
                });
            } else {
                var param = 'uploadsignature';
                const images = signaturePad.toDataURL();
                signaturePad.off();
                $(this).prop('disabled', true);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '/pengajuan/uploads',
                    data: {
                        data: param,
                        images: images
                    },
                    success: function(response) {
                        Swal.fire({
                            toast: true,
                            position: 'bottom-right',
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.original_name +
                                ' Berhasil diupload!',
                            showConfirmButton: false,
                            timer: 3500
                        });
                        $('#signatureData').val(response.name)
                    }
                });
            }
        });

        /**
         * kirim data
         **/
        // submit data
        $('#kirimData').click(function(e) {
            e.preventDefault();
            // validasi
            const validasi = $('.validasi').valid();

            /**
             * data
             **/
            var pengajuanNo = $('#pengajuanNo').attr('data-nopengajuan');
            var jenisMedia = $('#pengajuanJenisMedia').attr('data-jenisMedia');
            // file
            // perusahaan
            var fileNpwpPerusahaan = $('#fileNpwpPerusahaan .dz-details span').text();
            var fileAktaPerusahaan = $('#fileAktaPerusahaan .dz-details span').text();
            var fileKumhamPerusahaan = $('#fileKumhamPerusahaan .dz-details span').text();
            var fileWartawanKompetenPerusahaan = $('#fileWartawanKompetenPerusahaan .dz-details span')
                .text();
            var fileDewanPersPerusahaan = $('#fileDewanPersPerusahaan .dz-details span').text();
            var fileAfiliasiPerusahaan = $('#fileAfiliasiPerusahaan .dz-details span').text();
            var fileSptPerusahaan = $('#fileSptPerusahaan .dz-details span').text();
            var fileDomisiliPerusahaan = $('#fileDomisiliPerusahaan .dz-details span').text();
            var fileKuasaPerwakilan = $('#fileKuasaPerwakilan .dz-details span').text();
            var fileKerjasama = $('#fileKerjasama .dz-details span').text();
            var fileIzinIpp = $('#fileIzinIpp .dz-details span').text();
            //   perwakilan
            var fileKtpPerwakilan = $('#fileKtpPerwakilan .dz-details span').text();
            var fileKkPerwakilan = $('#fileKKPerwakilan .dz-details span').text();
            var fileNpwpPerwakilan = $('#fileNpwpPerwakilan .dz-details span').text();
            var fileKopetensiPerwakilan = $('#fileKopetensiPerwakilan .dz-details span').text();
            var fileAfiliasiPerwakilan = $('#fileAfiliasiPerwakilan .dz-details span').text();
            var fileDomisiliPerwakilan = $('#fileDomisiliPerwakilan .dz-details span').text();
            var fileKodeEtikPerwakilan = $('#fileKodeEtikPerwakilan .dz-details span').text();
            var filePernyataanMediaPerwakilan = $('#filePernyataanMediaPerwakilan .dz-details span')
                .text();
            var fileRekening = $('#fileRekening .dz-details span').text();
            var fileSignatureData = $('#signatureData').val();

            // data
            // perusahaan
            var namaPerusahaan = $('#namaPerusahaan').val();
            var namaPimred = $('#namaPimred').val();
            var alamatPerusahaan = $('#alamatPerusahaan').val();
            var tlpnPerusahaan = $('#tlpnPerusahaan').val();
            var emailPerusahaan = $('#emailPerusahaan').val();
            var npwpPerusahaan = $('#npwpPerusahaan').val();
            var aktaPerusahaan = $('#aktaPerusahaan').val();
            var kumhamPerusahaan = $('#kumhamPerusahaan').val();
            var wartawanKompetenPerusahaan = $('#wartawanKompetenPerusahaan').val();
            var namaPercetakan = $('#namaPercetakan').val();
            var alamatPercetakan = $('#alamatPercetakan').val();
            // perwakilan
            var namaMedia = $('#namaMedia').val();
            var namaBiroPerwakilan = $('#namaBiroPerwakilan').val();
            var alamatPerwakilan = $('#alamatPerwakilan').val();
            var tlpnPerwakilan = $('#tlpnPerwakilan').val();
            var emailPerwakilan = $('#emailPerwakilan').val();
            var ktpPerwakilan = $('#ktpPerwakilan').val();
            var kkPerwakilan = $('#kkPerwakilan').val();
            var npwpPerwakilan = $('#npwpPerwakilan').val();
            var kompetensiPerwakilan = $('#kompetensiPerwakilan').val();
            var jenisRekening = $('#jenisRekening').val();
            var namaBank = $('#namaBank').val();
            var pemilikRekening = $('#pemilikRekening').val();
            var noRekening = $('#noRekening').val();
            var pernyataanCheckbox = $('#pernyataanCheckbox').val();
            /**
             *file
             **/
            if (!validasi) {
                Swal.fire({
                    toast: false,
                    position: 'center',
                    icon: 'error',
                    title: 'Cek Data',
                    text: 'Peratikan Dengan Seksama Sebelum Kirim Data',
                    showConfirmButton: true,
                });
            } else {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "put",
                    url: "/pengajuan/update",
                    data: {
                        pengajuan_no: pengajuanNo,
                        jenis_media: jenisMedia,
                        // perusahaan
                        nama_perusahaan: namaPerusahaan,
                        nama_pimred: namaPimred,
                        alamat_perusahaan: alamatPerusahaan,
                        tlpn_perusahaan: tlpnPerusahaan,
                        email_perusahaan: emailPerusahaan,
                        npwp_perusahaan: npwpPerusahaan,
                        akta_perusahaan: aktaPerusahaan,
                        kumham_perusahaan: kumhamPerusahaan,
                        wartawan_kompeten_perusahaan: wartawanKompetenPerusahaan,
                        nama_percetakan: namaPercetakan,
                        alamat_percetakan: alamatPercetakan,
                        // file
                        file_npwp_perusahaan: fileNpwpPerusahaan,
                        file_akta_perusahaan: fileAktaPerusahaan,
                        file_kumham_perusahaan: fileKumhamPerusahaan,
                        file_wartawan_kompeten_perusahaan: fileWartawanKompetenPerusahaan,
                        file_dewan_pers_perusahaan: fileDewanPersPerusahaan,
                        file_afiliasi_perusahaan: fileAfiliasiPerusahaan,
                        file_spt_perusahaan: fileSptPerusahaan,
                        file_domisili_perusahaan: fileDomisiliPerusahaan,
                        file_kuasa_perwakilan: fileKuasaPerwakilan,
                        file_kerjasama: fileKerjasama,
                        file_izin_ipp: fileIzinIpp,
                        // perwakilan
                        nama_media: namaMedia,
                        nama_biro_perwakilan: namaBiroPerwakilan,
                        alamat_perwakilan: alamatPerwakilan,
                        tlpn_perwakilan: tlpnPerwakilan,
                        email_perwakilan: emailPerwakilan,
                        ktp_perwakilan: ktpPerwakilan,
                        kk_perwakilan: kkPerwakilan,
                        npwp_perwakilan: npwpPerwakilan,
                        kompetensi_perwakilan: kompetensiPerwakilan,
                        jenis_rekening: jenisRekening,
                        nama_bank: namaBank,
                        pemilik_rekening: pemilikRekening,
                        no_rekening: noRekening,
                        // file
                        file_ktp_perwakilan: fileKtpPerwakilan,
                        file_kk_perwakilan: fileKkPerwakilan,
                        file_npwp_perwakilan: fileNpwpPerwakilan,
                        file_kopetensi_perwakilan: fileKopetensiPerwakilan,
                        file_afiliasi_perwakilan: fileAfiliasiPerwakilan,
                        file_domisili_perwakilan: fileDomisiliPerwakilan,
                        file_kode_etik_perwakilan: fileKodeEtikPerwakilan,
                        file_pernyataan_media_perwakilan: filePernyataanMediaPerwakilan,
                        file_rekening: fileRekening,
                        file_signature_data: fileSignatureData,
                    },
                    success: function(response) {
                        Swal.fire({
                            toast: false,
                            position: 'center',
                            icon: response.icon,
                            title: response.title,
                            text: response.massage,
                            showConfirmButton: true,
                        });
                        if (response.icon == 'success') {
                            setTimeout(function() {
                                //your code to be executed after 1 second
                                window.location.href = "/daftar";
                            }, 3000);
                        }
                    }
                });
            }
        });
    });

    /**
     * Selector
     **/
    $(document).ready(function() {
        jQuery('#jenisRekening').select2({
            placeholder: 'Pilih Jenis Rekening'
        });
    });

    /**
     * validator
     **/
    $(document).ready(function() {
        // method validasi
        if ($('#jenisPengajuan').val() == 'siber') {
            var dataNamaMedia = "/pengajuan";
        } else {
            var dataNamaMedia = true;
        }
        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, "Tidak boleh menggunakan angka maupun karakter");
        jQuery.validator.addMethod("nospace", function(value, element) {
            return value.indexOf(" ") < 0 && value != "";
        }, "Spasi tidak diperbolehkan");

        // default massage
        jQuery.extend(jQuery.validator.messages, {
            required: "Harus Diisi.",
            remote: "Please fix this field.",
            email: "Please enter a valid email address.",
            url: "Please enter a valid URL.",
            date: "Please enter a valid date.",
            dateISO: "Please enter a valid date (ISO).",
            number: "Please enter a valid number.",
            digits: "Please enter only digits.",
            creditcard: "Please enter a valid credit card number.",
            equalTo: "Please enter the same value again.",
            accept: "Please enter a value with a valid extension.",
            maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
            minlength: jQuery.validator.format("Please enter at least {0} characters."),
            rangelength: jQuery.validator.format(
                "Please enter a value between {0} and {1} characters long."),
            range: jQuery.validator.format("Please enter a value between {0} and {1}."),
            max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
            min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
        });

        // validasi

        jQuery.validator.setDefaults({
            debug: false,
        });

        jQuery(".validasi").validate({
            rules: {
                namaPerusahaan: {
                    required: true,
                    lettersonly: true
                },
                namaPimred: {
                    required: true,
                    lettersonly: true
                },
                alamatPerusahaan: {
                    required: true,
                },
                tlpnPerusahaan: {
                    required: true,
                    number: true
                },
                emailPerusahaan: {
                    required: true,
                    email: true,
                },
                npwpPerusahaan: {
                    required: true,
                },
                aktaPerusahaan: {
                    required: true,
                    number: true
                },
                kumhamPerusahaan: {
                    required: true,
                },
                // opsional harian
                namaPercetakan: {
                    required: true,
                },
                alamatPercetakan: {
                    required: true,
                },
                // perwakilan
                namaMedia: {
                    required: true,
                    remote: dataNamaMedia,
                },
                namaBiroPerwakilan: {
                    required: true,
                    lettersonly: true
                },
                alamatPerwakilan: {
                    required: true,
                },
                tlpnPerwakilan: {
                    required: true,
                    number: true
                },
                emailPerwakilan: {
                    required: true,
                    email: true
                },
                ktpPerwakilan: {
                    required: true,
                    number: true,
                    nospace: true
                },
                kkPerwakilan: {
                    required: true,
                    number: true,
                    nospace: true
                },
                npwpPerwakilan: {
                    required: true,
                },
                kompetensiPerwakilan: {
                    required: true,
                },
                jenisRekening: {
                    required: true,
                },
                namaBank: {
                    required: true,
                    minlength: 3
                },
                pemilikRekening: {
                    required: true,
                    lettersonly: true,
                },
                noRekening: {
                    required: true,
                    number: true
                },
                pernyataanCheckbox: {
                    required: true,
                },
            },
            messages: {
                namaMedia: {
                    remote: "Domain Media Tidak Teregister, Tidak Ada SSL, atau Tambahkan WWWW",
                },
            },
            onkeyup: false,
        })
    });
</script>