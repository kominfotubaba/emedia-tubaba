@foreach ($media_data as $md)
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <h1 class="mb-0 pb-0 display-4 text-capitalize" id="title">Edit Pengajuan media
                        {{ $md->jenis_media }}</h1>
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
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox" value="Nama Perusahaan" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title">Nama Perusahaan</h2>
                                    </label>
                                </div>
                                <div class="form-floating">
                                    <input id="namaPerusahaan" name="namaPerusahaan" type="text"
                                        class="form-control form-control-sm" placeholder="form-control"
                                        value="{{ $md->nama_perusahaan }}">
                                    <div id="pengajuanNo" data-nopengajuan="{{ $md->pengajuan_no }}"></div>
                                    <div id="pengajuanJenisMedia" data-jenisMedia="{{ $md->jenis_media }}"></div>
                                    <label class="ps-4">Nama Perusahaan Sesuai AHU</label>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox"
                                            value="Nama Pimpinan Perusahaan" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title">Nama Pimpinan Perusahaan</h2>
                                    </label>
                                </div>
                                <div class="form-floating">
                                    <input id="namaPimred" name="namaPimred" type="text"
                                        class="form-control form-control-sm" placeholder="form-control"
                                        value="{{ $md->nama_pimred }}">
                                    <label class="ps-4">Nama Pimpinan Perusahaan</label>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox" value="Kontak" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title">Kontak</h2>
                                    </label>
                                </div>
                                <div class="col-lg-4 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">
                                    <div class="form-floating">
                                        <input id="alamatPerusahaan" name="alamatPerusahaan" type="text"
                                            class="form-control form-control-sm" placeholder="form-control"
                                            value="{{ $md->alamat_perusahaan }}">
                                        <label class="ps-4">Alamat Perusahaan</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                    <div class="form-floating">
                                        <input id="tlpnPerusahaan" name="tlpnPerusahaan" type="text"
                                            class="form-control form-control-sm" placeholder="form-control"
                                            value="{{ $md->tlpn_perusahaan }}">
                                        <label class="ps-4">No Telpon Perusahaan</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                    <div class="form-floating">
                                        <input id="emailPerusahaan" name="emailPerusahaan" type="text"
                                            class="form-control form-control-sm" placeholder="form-control"
                                            value="{{ $md->email_perusahaan }}">
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
                                    <div class="form-check">
                                        @if (Request::segment(2) == 'verifikasi')
                                            <input class="form-check-input" type="checkbox" value="Percetakan" />
                                        @endif
                                        <label class="form-check-label">
                                            <h2 class="small-title">Percetakan</h2>
                                        </label>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">
                                        <div class="form-floating">
                                            <input id="namaPercetakan" name="namaPercetakan" type="text"
                                                class="form-control form-control-sm" placeholder="form-control"
                                                value="{{ $md->nama_percetakan }}">
                                            <label class="ps-4">Nama Percetakan</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12 mb-md-0 mb-2">
                                        <div class="form-floating">
                                            <input id="alamatPercetakan" name="alamatPercetakan" type="text"
                                                class="form-control form-control-sm" placeholder="form-control"
                                                value="{{ $md->alamat_percetakan }}">
                                            <label class="ps-4">Alamat Percetakan</label>
                                        </div>
                                    </div>
                                </div>

                                <hr class="mb-4">
                            @endif

                            {{-- opsional Elektronik --}}
                            @if ($md->jenis_media == 'elektronik')
                                <div class="row mb-4">
                                    <div class="form-check">
                                        @if (Request::segment(2) == 'verifikasi')
                                            <input class="form-check-input" type="checkbox"
                                                value="Dokumen izin Penyelenggaraan Penyiaran" />
                                        @endif
                                        <label class="form-check-label">
                                            <h2 class="small-title mb-md-0 mb-2">Dokumen izin Penyelenggaraan Penyiaran
                                            </h2>
                                        </label>
                                    </div>
                                    <div class="col-12  ">
                                        <a href="/tmp/uploads/fileIzinIpp/{{ $md->file_izin_ipp }}" target="_blank"
                                            type="button" class="btn btn-quaternary mb-1">Cek
                                            Izin IPP</a>
                                    </div>
                                </div>

                                <hr class="mb-4">
                            @endif


                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox" value="NPWP Perusahaan" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title">NPWP Perusahaan</h2>
                                    </label>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                    <div class="form-floating">
                                        <input id="npwpPerusahaan" name="npwpPerusahaan" type="text"
                                            class="form-control form-control-sm" placeholder="form-control"
                                            value="{{ $md->npwp_perusahaan }}">
                                        <label class="ps-4">No NPWP Perusahaan</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                    <a href="/tmp/uploads/fileNpwpPerusahaan/{{ $md->file_npwp_perusahaan }}"
                                        target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                        Npwp</a>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox"
                                            value="Akta Pendirian dan Perubahan Perusahaan" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title mb-md-0 mb-2">Akta Pendirian dan Perubahan Perusahaan
                                        </h2>
                                    </label>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                    <div class="form-floating">
                                        <input id="aktaPerusahaan" name="aktaPerusahaan" type="text"
                                            class="form-control form-control-sm" placeholder="form-control"
                                            value="{{ $md->akta_perusahaan }}">
                                        <label class="ps-4">No Akta Pendirian Perusahaan</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                    <div class="col-12  ">
                                        <a href="/tmp/uploads/fileAktaPerusahaan/{{ $md->file_akta_perusahaan }}"
                                            target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                            File</a>
                                    </div>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox"
                                            value="Pengesahan Kemenkumham Perusahaan" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title mb-md-0 mb-2">Pengesahan Kemenkumham Perusahaan</h2>
                                    </label>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                    <div class="form-floating">
                                        <input id="kumhamPerusahaan" name="kumhamPerusahaan" type="text"
                                            class="form-control form-control-sm" placeholder="form-control"
                                            value="{{ $md->kumham_perusahaan }}">
                                        <label class="ps-4">No Pengesahan Kemenkumham Perusahaan</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                    <a href="/tmp/uploads/fileKumhamPerusahaan/{{ $md->file_kumham_perusahaan }}"
                                        target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                        File</a>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox"
                                            value="Jumlah Wartawan Kompeten Perusahaan" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title mb-1">Wartawan Kompeten Perusahaan</h2>
                                    </label>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                    <div class="form-floating">
                                        <input id="wartawanKompetenPerusahaan" name="wartawanKompetenPerusahaan"
                                            type="text" class="form-control form-control-sm"
                                            placeholder="form-control"
                                            value="{{ $md->wartawan_kompeten_perusahaan }}">
                                        <label class="ps-4">Jumlah Wartawan Kompeten Perusahaan</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                    <div class="col-12  ">
                                        <a href="/tmp/uploads/fileWartawanKompetenPerusahaan/{{ $md->file_wartawan_kompeten_perusahaan }}"
                                            target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                            File</a>
                                    </div>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox"
                                            value="Laporan SPT Pajak Tahunan Perusahaan" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title mb-md-0 mb-2">Laporan SPT Pajak Tahunan Perusahaan</h2>
                                    </label>
                                </div>
                                <div class="col-12  ">
                                    <a href="/tmp/uploads/fileSptPerusahaan/{{ $md->file_spt_perusahaan }}"
                                        target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                        File</a>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox"
                                            value="Verifikasi Dewan Pers Perusahaan" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title mb-md-0 mb-2">Verifikasi Dewan Pers Perusahaan</h2>
                                    </label>
                                </div>
                                <div class="col-12  ">
                                    <a href="/tmp/uploads/fileDewanPersPerusahaan/{{ $md->file_dewan_pers_perusahaan }}"
                                        target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                        File</a>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox"
                                            value="Afiliasi Organisasi Pers (Organisasi Wartawan)" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title mb-1">Afiliasi Organisasi Pers (Perusahaan)
                                        </h2>
                                    </label>
                                </div>
                                <div class="col-12  ">
                                    <a href="/tmp/uploads/fileAfiliasiPerusahaan/{{ $md->file_afiliasi_perusahaan }}"
                                        target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                        File</a>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox"
                                            value="Surat Pernyataan Nama Media dan Domisili" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title mb-md-0 mb-2">Surat Pernyataan Nama Media dan Domisili
                                        </h2>
                                    </label>
                                </div>
                                <div class="col-12  ">
                                    <a href="/tmp/uploads/fileDomisiliPerusahaan/{{ $md->file_domisili_perusahaan }}"
                                        target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                        File</a>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox"
                                            value="Surat Kuasa Perwakilan Media" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title">Surat Kuasa Perwakilan Media</h2>
                                    </label>
                                </div>
                                <div class="col-12  ">
                                    <a href="/tmp/uploads/fileKuasaPerwakilan/{{ $md->file_kuasa_perwakilan }}"
                                        target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                        File</a>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox"
                                            value="Surat Permohonan Kerjasama dan CV Perusahaan" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title mb-md-0 mb-2">Surat Permohonan Kerjasama dan CV
                                            Perusahaan
                                    </label>
                                </div>
                                </h2>
                                <div class="col-12  ">
                                    <a href="/tmp/uploads/fileKerjasama/{{ $md->file_kerjasama }}" target="_blank"
                                        type="button" class="btn btn-quaternary mb-1">Cek
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
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox" value="Nama Media" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title mb-md-0 mb-2">Nama Media</h2>
                                    </label>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12 mb-md-0 mb-2">
                                    <div class="form-floating">
                                        <input id="namaMedia" name="namaMedia" type="text"
                                            class="form-control form-control-sm" placeholder="form-control"
                                            value="{{ $md->nama_media }}">
                                        <label class="ps-4">Nama Media</label>
                                    </div>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox"
                                            value="Nama Biro Perwakilan Media" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title">Nama Biro Perwakilan Media</h2>
                                    </label>
                                </div>
                                <div class="form-floating">
                                    <input id="namaBiroPerwakilan" name="namaBiroPerwakilan" type="text"
                                        class="form-control form-control-sm" placeholder="form-control"
                                        value="{{ $md->nama_biro_perwakilan }}">
                                    <label class="ps-4">Nama Biro Perwakilan Media</label>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox" value="Kontak Perwakilan" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title">Kontak Perwakilan</h2>
                                    </label>
                                </div>
                                <div class="col-lg-4 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">
                                    <div class="form-floating">
                                        <input id="alamatPerwakilan" name="alamatPerwakilan" type="text"
                                            class="form-control form-control-sm" placeholder="form-control"
                                            value="{{ $md->alamat_perwakilan }}">
                                        <label class="ps-4">Alamat Perwakilan</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-md-0 mb-2">
                                    <div class="form-floating">
                                        <input id="tlpnPerwakilan" name="tlpnPerwakilan" type="text"
                                            class="form-control form-control-sm" placeholder="form-control"
                                            value="{{ $md->tlpn_perwakilan }}">
                                        <label class="ps-4">No Telpon Perwakilan</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-md-0 mb-2">
                                    <div class="form-floating">
                                        <input id="emailPerwakilan" name="emailPerwakilan" type="text"
                                            class="form-control form-control-sm" placeholder="form-control"
                                            value="{{ $md->email_perwakilan }}">
                                        <label class="ps-4">Email Perwakilan</label>
                                    </div>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox" value="KTP Perwakilan" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title mb-1">KTP Perwakilan</h2>
                                    </label>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                    <div class="form-floating">
                                        <input id="ktpPerwakilan" name="ktpPerwakilan" type="text"
                                            class="form-control form-control-sm" placeholder="form-control"
                                            value="{{ $md->ktp_perwakilan }}">
                                        <label class="ps-4">No KTP Perwakilan</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                    <div class="col-12  ">
                                        <a href="/tmp/uploads/fileKtpPerwakilan/{{ $md->file_ktp_perwakilan }}"
                                            target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                            File</a>
                                    </div>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox" value="KK Perwakilan" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title mb-1">KK Perwakilan</h2>
                                    </label>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                    <div class="form-floating">
                                        <input id="kkPerwakilan" name="kkPerwakilan" type="text"
                                            class="form-control form-control-sm" placeholder="form-control"
                                            value="{{ $md->kk_perwakilan }}">
                                        <label class="ps-4">No KK Perwakilan</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                    <div class="col-12  ">
                                        <a href="/tmp/uploads/fileKKPerwakilan/{{ $md->file_kk_perwakilan }}"
                                            target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                            File</a>
                                    </div>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox" value="NPWP Perwakilan" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title mb-1">NPWP Perwakilan</h2>
                                    </label>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                    <div class="form-floating">
                                        <input id="npwpPerwakilan" name="npwpPerwakilan" type="text"
                                            class="form-control form-control-sm" placeholder="form-control"
                                            value="{{ $md->npwp_perwakilan }}">
                                        <label class="ps-4">No NPWP Perwakilan</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                    <div class="col-12  ">
                                        <a href="/tmp/uploads/fileNpwpPerwakilan/{{ $md->file_npwp_perwakilan }}"
                                            target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                            File</a>
                                    </div>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox"
                                            value="Dokumen Kompetensi Perwakilan Media" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title mb-1">Dokumen Kompetensi Perwakilan Media</h2>
                                    </label>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                    <div class="form-floating">
                                        <input id="kompetensiPerwakilan" name="kompetensiPerwakilan" type="text"
                                            class="form-control form-control-sm" placeholder="form-control"
                                            value="{{ $md->kompetensi_perwakilan }}">
                                        <label class="ps-4">Jenis Kompetensi Perwakilan Media</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                    <div class="col-12  ">
                                        <a href="/tmp/uploads/fileKopetensiPerwakilan/{{ $md->file_kopetensi_perwakilan }}"
                                            target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                            File</a>
                                    </div>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox"
                                            value="Afiliasi Organisasi Pers (Organisasi Wartawan)" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title mb-1">Afiliasi Organisasi Pers (Organisasi Wartawan)
                                        </h2>
                                    </label>
                                </div>
                                <div class="col-12  ">
                                    <a href="/tmp/uploads/fileAfiliasiPerwakilan/{{ $md->file_afiliasi_perwakilan }}"
                                        target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                        File</a>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox"
                                            value="Keterangan Domisili Perwakilan Media" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title mb-1">Keterangan Domisili Perwakilan Media</h2>
                                    </label>
                                </div>
                                <div class="col-12  ">
                                    <a href="/tmp/uploads/fileDomisiliPerwakilan/{{ $md->file_domisili_perwakilan }}"
                                        target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                        File</a>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox"
                                            value="Surat Pernyataan Mematuhi Kode Etik Jurnalistik" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title mb-1">Surat Pernyataan Mematuhi Kode Etik Jurnalistik
                                        </h2>
                                    </label>
                                </div>
                                <div class="col-12  ">
                                    <a href="/tmp/uploads/fileKodeEtikPerwakilan/{{ $md->file_kode_etik_perwakilan }}"
                                        target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
                                        File</a>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox"
                                            value="Surat Pernyataan 1 Perusahaan 1 Media" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title">Surat Pernyataan 1 Perusahaan 1 Media</h2>
                                    </label>
                                </div>
                                <div class="col-12  ">
                                    <a href="/tmp/uploads/filePernyataanMediaPerwakilan/{{ $md->file_pernyataan_media_perwakilan }}"
                                        target="_blank" type="button" class="btn btn-quaternary mb-1">Cek
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
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input" type="checkbox" value="Rekening Bank" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title">Rekening Bank</h2>
                                    </label>
                                </div>
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
                                        <input id="namaBank" name="namaBank" type="text"
                                            class="form-control form-control-sm" placeholder="form-control"
                                            value="{{ $md->nama_bank }}">
                                        <label class="ps-4">Nama Bank</label>
                                    </div>
                                    <div class="form-floating mb-2">
                                        <input id="pemilikRekening" name="pemilikRekening" type="text"
                                            class="form-control form-control-sm" placeholder="form-control"
                                            value="{{ $md->pemilik_rekening }}">
                                        <label class="ps-4">Nama Pemilik Rekening</label>
                                    </div>
                                    <div class="form-floating mb-2">
                                        <input id="noRekening" name="noRekening" type="text"
                                            class="form-control form-control-sm" placeholder="form-control"
                                            value="{{ $md->no_rekening }}">
                                        <label class="ps-4">No Rekening Perusahaan</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">
                                    <div class="col-12  ">
                                        <a href="/tmp/uploads/fileRekening/{{ $md->file_rekening }}" target="_blank"
                                            type="button" class="btn btn-quaternary mb-1">Cek
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
                                <div class="form-check">
                                    @if (Request::segment(2) == 'verifikasi')
                                        <input class="form-check-input " type="checkbox" value="Tanda Tangan" />
                                    @endif
                                    <label class="form-check-label">
                                        <h2 class="small-title">Tanda Tangan Disini</h2>
                                    </label>
                                </div>
                                {{-- <div class="d-flex justify-content-center mb-2">
                                    <canvas id="signature-pad" style="width: 300px; height: 200px;"
                                        class="border signature-pad "></canvas>
                                </div> --}}
                                <div class="d-flex justify-content-center mb-2">
                                    <img class="img-fluid rounded" alt="Responsive image"
                                        src="/tmp/uploads/uploadsignature/{{ $md->file_signature_data }}"
                                        alt="">
                                </div>
                                <input id="signatureData" type="text" value="{{ $md->file_signature_data }}"
                                    disabled hidden>
                            </div>

                        </section>
                        <div class="d-flex justify-content-end">
                            <div class="btn-group" role="group">
                                @if (Request::segment(2) == 'verifikasi')
                                    <button id="tolak" type="submit" class="btn btn-danger text-capitalize"
                                        disabled>tolak</button>
                                    <button id="terima" type="submit"
                                        class="btn btn-primary text-capitalize">terima</button>
                                @endif
                                <button id="kembali" type="submit"
                                    class="btn btn-dark text-capitalize">kembali</button>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </form>
        <!-- Content End -->
    </div>
@endforeach
<script>
    /**
     * button
     **/
    $(document).ready(function() {

        /**
         * checkbox
         **/
        $('.form-check-input').click(function() {
            var val = [];
            $(':checkbox:checked').each(function(i) {
                val[i] = $(this).val();
                var $this = $(this);
            });
            if (val.length === 0) {
                $('#tolak').prop('disabled', true);
                $('#terima').prop('disabled', false);
            } else {
                $('#tolak').prop('disabled', false);
                $('#terima').prop('disabled', true);
            }
        });

        /**
         * button
         **/
        $('#kembali').click(function(e) {
            e.preventDefault();
            window.location.href = "/daftar";
        });

        $('#terima').click(function(e) {
            e.preventDefault();
            var pengajuanNo = $('#pengajuanNo').attr('data-nopengajuan');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: "{{ Route('verifikasi.post') }}",
                data: {
                    pengajuan_no: pengajuanNo,
                    keterangan: 'verify',
                    status: 'terima',
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
        });

        $('#tolak').click(function(e) {
            e.preventDefault();
            var dataValue = $(":checkbox:checked").map(function() {
                return $(this).val();
            }).get();
            var pengajuanNo = $('#pengajuanNo').attr('data-nopengajuan');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "put",
                url: "{{ Route('verifikasi.put') }}",
                data: {
                    pengajuan_no: pengajuanNo,
                    keterangan: dataValue,
                    status: 'tolak',
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
        });

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
    });

    /**
     * Selector
     **/
    $(document).ready(function() {
        $('#jenisRekening').select2({
            minimumResultsForSearch: Infinity,
            placeholder: ''
        });
    });
</script>
