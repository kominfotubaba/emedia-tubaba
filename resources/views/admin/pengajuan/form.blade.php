<section class="scroll-section">
    <div class="h3 text-primary text-capitalize">Data Perusahaan Media {{ $media_jenis }}</div>
    <div class="card wizard mb-3" id="wizardBasic">
        <div class="card-header border-0 pb-0">
            <ul class="nav nav-tabs justify-content-center" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-center" href="#validationFirst" role="tab">
                        <div class="mb-1 title d-none d-sm-block">DATA BADAN HUKUM</div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-center" href="#validationSecond" role="tab">
                        <div class="mb-1 title d-none d-sm-block">DATA MEDIA</div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-center" href="#validationThird" role="tab">
                        <div class="mb-1 title d-none d-sm-block">KUALIFIKASI MEDIA</div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-center" href="#validationFour" role="tab">
                        <div class="mb-1 title d-none d-sm-block">PERWAKILAN MEDIA</div>
                    </a>
                </li>
                <li class="nav-item d-none" role="presentation">
                    <a class="nav-link text-center" href="#validationLast" role="tab"></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade" id="validationFirst" role="tabpanel">
                    <h5 class="card-title">DATA BADAN HUKUM</h5>
                    <p class="card-text text-alternate mb-4"></p>
                    <form class="tooltip-end-bottom validasi">
                        <div class="row mb-3">
                            <h2 class="small-title">Perusahaan/Badan Hukum</h2>
                            <div class="col-lg-12 col-md-6 col-12 mb-md-0">
                                <div class="form-floating mb-3">
                                    <input id="namaPerusahaan" name="namaPerusahaan" type="text"
                                        class="form-control form-control-sm" placeholder="form-control">
                                    <label class="ps-4">Nama Perusahaan Sesuai AHU</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input id="namaPenanggungJawab" name="namaPenanggungJawab" type="text"
                                        class="form-control form-control-sm" placeholder="form-control">
                                    <label class="ps-4">Nama Penanggung Jawab</label>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-12 mb-lg-0 ">
                                        <div class="form-floating mb-3">
                                            <input id="namaPimred" name="namaPimred" type="text"
                                                class="form-control form-control-sm" placeholder="form-control">
                                            <label class="ps-4">Nama Pimpinan Redaksi Perusahaan</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12 mb-lg-0">
                                        <div class="form-floating mb-3">
                                            <div class="dropzone dropzone-floating-label" id="fileSuratPernyataanPimred"
                                                name="suratPernyataanPimred"></div>
                                            <label class="ps-4">File PDF
                                                Surat Pernyataan Sebagai Pimred dari Badan Hukum</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-3">
                            <h2 class="small-title">Pengesahan Kemenkumham Perusahaan</h2>
                            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="kumhamPerusahaan" name="kumhamPerusahaan" type="text"
                                        class="form-control form-control-sm" placeholder="form-control">
                                    <label class="ps-4">No Pengesahan Kemenkumham Perusahaan</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <div class="dropzone dropzone-floating-label" id="fileKumhamPerusahaan"></div>
                                    <label class="ps-4">File PDF Pengesahan Kemenkumham Perusahaan</label>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-3">
                            <h2 class="small-title mb-md-0 mb-2">Kontak Perusahaan</h2>
                            <div class="col-lg-12 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="form-floating w-100">
                                            <select class="select-floating" id="alamatProvPerusahaan"
                                                name="alamatProvPerusahaan">
                                                <option label="&nbsp;"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="form-floating w-100">
                                            <select class="select-floating" id="alamatKabPerusahaan"
                                                name="alamatKabPerusahaan" hidden>
                                                <option label="&nbsp;"></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input id="alamatPerusahaan" name="alamatPerusahaan" type="text"
                                        class="form-control form-control-sm" placeholder="form-control">
                                    <label class="ps-4">Alamat Perusahaan Detail</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="tlpnPerusahaan" name="tlpnPerusahaan" type="text"
                                        class="form-control form-control-sm" placeholder="form-control">
                                    <label class="ps-4">No Telpon Perusahaan</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="emailPerusahaan" name="emailPerusahaan" type="text"
                                        class="form-control form-control-sm" placeholder="form-control">
                                    <label class="ps-4">Email Perusahaan</label>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-3">
                            <h2 class="small-title mb-md-0 mb-2">Status KSWP</h2>
                            <div class="col-lg-12 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating w-100">
                                    <select class="select-floating" id="statusKswp" name="statusKswp">
                                        <option label="&nbsp;"></option>
                                        <option value="valid">KSPW Valid</option>
                                        <option value="tidak valid">KSPW Tidak Valid</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-3">
                            <h2 class="small-title">NPWP Perusahaan/Badan Hukum</h2>
                            <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="npwpPerusahaan" name="npwpPerusahaan" type="text"
                                        class="form-control form-control-sm" placeholder="form-control">
                                    <label class="ps-4">No NPWP Perusahaan/Badan Hukum</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-floating">
                                    <div class="dropzone dropzone-floating-label" id="fileNpwpPerusahaan"
                                        name="fileNpwpPerusahaan"></div>
                                    <label class="ps-4">File PDF
                                        NPWP Perusahaan</label>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-3">
                            <h2 class="small-title">Nomor Induk Berusaha Perusahaan/Badan Hukum</h2>
                            <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="nibPerusahaan" name="nibPerusahaan" type="text"
                                        class="form-control form-control-sm" placeholder="form-control">
                                    <label class="ps-4">Nomor Induk Berusaha Perusahaan/Badan Hukum</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-floating">
                                    <div class="dropzone dropzone-floating-label" id="fileNibPerusahaan"
                                        name="fileNibPerusahaan"></div>
                                    <label class="ps-4">File PDF
                                        Nomor Induk Berusaha Perusahaan/Badan Hukum</label>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-3">
                            <h2 class="small-title mb-md-0 mb-2">Nomor KLBI</h2>
                            <div class="col-lg-12 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating w-100">
                                    <select class="select-floating" id="noKlbi" name="noKlbi">
                                        <option label="&nbsp;"></option>
                                        <option value="63911">KLBI 63911</option>
                                        <option value="63912">KLBI 63912</option>
                                        <option value="60201">KLBI 60201</option>
                                        <option value="60202">KLBI 60202</option>
                                        <option value="60101">KLBI 60101</option>
                                        <option value="60102">KLBI 60102</option>
                                        <option value="58130">KLBI 58130</option>
                                        <option value="63122">KLBI 63122</option>
                                        <option value="63990">KLBI 63990</option>
                                        <option value="74130">KLBI 74130</option>
                                        <option value="18111">KLBI 18111</option>
                                        <option value="73100">KLBI 73100</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-3">
                            <h2 class="small-title mb-md-0 mb-2">Nomor KBKI</h2>
                            <div class="col-lg-12 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="noKbki" name="noKbki" type="text"
                                        class="form-control form-control-sm" placeholder="form-control">
                                    <label class="ps-4">Nomor KBKI Perusahaan</label>
                                </div>
                            </div>
                        </div>


                        @if ($media_jenis == 'elektronik')
                            <hr class="mb-4">

                            <div class="row mb-4">
                                <h2 class="small-title mb-md-0 mb-2">Dokumen izin Penyelenggaraan Penyiaran</h2>
                                <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                    <div class="form-floating">
                                        <input id="izinIpp" name="izinIpp" type="text"
                                            class="form-control form-control-sm" placeholder="form-control">
                                        <label class="ps-4">Izin Penyelenggaraan Penyiaran</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                    <div class="form-floating">
                                        <div class="dropzone dropzone-floating-label" id="fileIzinIpp"></div>
                                        <label class="ps-4">File PDF Izin Penyelenggaraan Penyiaran</label>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($media_jenis == 'harian')
                            <hr class="mb-4">

                            <div class="row mb-4">
                                <h2 class="small-title">Percetakan</h2>
                                <div class="col-lg-6 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">
                                    <div class="form-floating">
                                        <input id="namaPercetakan" name="namaPercetakan" type="text"
                                            class="form-control form-control-sm" placeholder="form-control">
                                        <label class="ps-4">Nama Percetakan</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-12 mb-md-0 mb-2">
                                    <div class="form-floating">
                                        <input id="alamatPercetakan" name="alamatPercetakan" type="text"
                                            class="form-control form-control-sm" placeholder="form-control">
                                        <label class="ps-4">Alamat Percetakan</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>

                <div class="tab-pane fade" id="validationSecond" role="tabpanel">
                    <h5 class="card-title">DATA MEDIA</h5>
                    <p class="card-text text-alternate mb-4"></p>
                    <form class="tooltip-end-bottom validasi">
                        <div class="row mb-3">
                            <h2 class="small-title">Nama Media</h2>
                            <div class="col-lg-12 col-md-12 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="namaMedia" name="namaMedia" type="text"
                                        class="form-control form-control-sm" placeholder="form-control">
                                    <label class="ps-4">Nama Media</label>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-3">
                            <h2 class="small-title mb-md-0 mb-2">Status Verifikasi</h2>
                            <div class="col-lg-12 col-md-12 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating w-100">
                                    <select class="select-floating" id="verifikasiDewanPers"
                                        name="verifikasiDewanPers">
                                        <option label="&nbsp;"></option>
                                        <option value="faktual dan administratif">Terverifikasi Faktual dan
                                            Administratif</option>
                                        <option value="administratif">Terverifikasi Administratif</option>
                                        <option value="belum">Belum Terverifikasi</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-3">
                            <h2 class="small-title mb-md-0 mb-2">Sertifikat UKW Pimred</h2>
                            <div class="col-lg-4 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <div class="w-100">
                                        <select class="select-floating" id="jenisSerfikatUkwPimred"
                                            name="jenisSerfikatUkwPimred">
                                            <option label="&nbsp;"></option>
                                            <option value="utama">Utama</option>
                                            <option value="madya">Madya</option>
                                            <option value="muda">Muda</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <input id="serfikatUkwPimred" name="serfikatUkwPimred" type="text"
                                        class="form-control form-control-sm" placeholder="form-control">
                                    <label class="ps-4">Nomor Sertifikat Pimred Perusahaan</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <div class="dropzone dropzone-floating-label" id="fileSerfikatUkwPimred"></div>
                                    <label class="ps-4">File PDF Sertifikat Pimpinan Redaksi</label>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-3">
                            <h2 class="small-title mb-md-0 mb-2">Afiliasi Organisasi Perusahaan/Media Pers</h2>
                            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating w-100">
                                    <select class="select-floating" id="afiliasiPerusahaan"
                                        name="afiliasiPerusahaan">
                                        <option label="&nbsp;"></option>
                                        <option value="tidak terafiliasi">Tidak Terafiliasi dengan Organisasi Pers
                                        </option>
                                        <option value="diakui">Organisasi Pers yang diakui Dewan Pers
                                        </option>
                                        <option value="belum diakui">Organisasi Pers yang belum diakui Dewan Pers
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating fileAfiliasiPerusahaan" hidden>
                                    <div class="dropzone dropzone-floating-label" id="fileAfiliasiPerusahaan"></div>
                                    <label class="ps-4">File PDF Bukti Afiliasi Organisasi Pers Media</label>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-3">
                            <h2 class="small-title mb-md-0 mb-2">Domisili Redaksi Media</h2>
                            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating w-100">
                                    <select class="select-floating" id="domisiliRedaksiMedia"
                                        name="domisiliRedaksiMedia">
                                        <option label="&nbsp;"></option>
                                        <option value="tulang bawang barat">di Tulang Bawang Barat</option>
                                        <option value="luar tulang bawang barat">di luar Tulang Bawang Barat, di Prov.
                                            Lampung</option>
                                        <option value="luar lampung">di luar Provinsi Lampung</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating">
                                    <div class="dropzone dropzone-floating-label" id="fileDomisiliRedaksiMedia"></div>
                                    <label class="ps-4">File PDF, Surat Keterangan Domisili dari Instansi
                                        Berwenang</label>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-3">
                            <h2 class="small-title mb-md-0 mb-2">Kanal/program Tentang Tulang Bawang Barat</h2>
                            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating w-100">
                                    <select class="select-floating" id="kanalKhusus" name="kanalKhusus">
                                        <option label="&nbsp;"></option>
                                        <option value="Khusus">Khusus</option>
                                        <option value="ada">Ada</option>
                                        <option value="tidak ada">Tidak Ada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating fileKanalKhusus" hidden>
                                    <div class="dropzone dropzone-floating-label" id="fileKanalKhusus"></div>
                                    <label class="ps-4">File PDF, Bukti Adanya Kanal/program khusus Tulang Bawang
                                        Barat</label>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title">Rekening Bank</h2>
                            <div class="col-lg-6 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">
                                <div class="top-label mb-2 w-100">
                                    <select name="jenisRekening" id="jenisRekening">
                                        <option label="&nbsp;"></option>
                                        <option value="perusahaan">perusahaan</option>
                                        <option value="perwakilan">Perwakilan</option>
                                    </select>
                                    <span>Jenis Rekening</span>
                                </div>
                                <div class="form-floating mb-2">
                                    <input id="namaBank" name="namaBank" type="text"
                                        class="form-control form-control-sm" placeholder="form-control">
                                    <label class="ps-4">Nama Bank</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <input id="pemilikRekening" name="pemilikRekening" type="text"
                                        class="form-control form-control-sm" placeholder="form-control">
                                    <label class="ps-4">Nama Pemilik Rekening</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <input id="noRekening" name="noRekening" type="text"
                                        class="form-control form-control-sm" placeholder="form-control">
                                    <label class="ps-4">No Rekening Perusahaan</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">
                                <div class="form-floating">
                                    <div class="dropzone dropzone-floating-label" id="fileRekening"></div>
                                    <label class="ps-4">File PDF
                                        Rekening Perusahaan</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="validationThird" role="tabpanel">
                    <h5 class="card-title">KUALIFIKASI MEDIA</h5>
                    <p class="card-text text-alternate mb-4"></p>
                    <form class="tooltip-end-bottom validasi">
                        <div class="row mb-3">
                            <h2 class="small-title mb-md-0 mb-2">Tahun Berdiri Media</h2>
                            <div class="col-lg-12 col-md-12 col-12 mb-lg-0 mb-md-0 mb-2">
                                <div class="form-floating w-100">
                                    <select class="select-floating" id="tahunBerdiriMedia" name="tahunBerdiriMedia">
                                        <option label="&nbsp;"></option>
                                        <option value="sebelum 2010">Sebelum 2010</option>
                                        <option value="2010 sampai 2020">2010 Sampai 2020</option>
                                        <option value="sesudah 2020">Sesudah 2020</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        @if ($media_jenis == 'elektronik')
                            <div class="row mb-3">
                                <h2 class="small-title mb-md-0 mb-2">Jangkauan Siar Media Elektronik</h2>
                                <div class="col-lg-12 col-md-12 col-12 mb-lg-0 mb-md-0 mb-2">
                                    <div class="form-floating w-100">
                                        <select class="select-floating" id="jenisJangkauanSiarMediaElektronik"
                                            name="jenisJangkauanSiarMediaElektronik">
                                            <option label="&nbsp;"></option>
                                            <option value="tv">Televisi</option>
                                            <option value="radio">Radio</option>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-12 col-md-12 col-12 mb-lg-0 mb-md-0 mb-2">
                                    <div class="form-floating w-100">
                                        <select class="select-floating" id="jangkauanSiarMediaElektronik"
                                            name="jangkauanSiarMediaElektronik">

                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($media_jenis == 'harian')
                            <div class="row mb-3">
                                <h2 class="small-title mb-md-0 mb-2">Jumlah Oplah Media Cetak Per Minggu</h2>
                                <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                    <div class="form-floating w-100">
                                        <select class="select-floating" id="jumlahOplahMediaCetakPerMinggu"
                                            name="jumlahOplahMediaCetakPerMinggu">
                                            <option label="&nbsp;"></option>
                                            <option value="lebih dari 8000">Lebih Dari 8.000</option>
                                            <option value="4000 sampai 8000">4.000 Sampai 8.000</option>
                                            <option value="kurang dari 4000">Kurang Dari 4.000</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                    <div class="form-floating">
                                        <div class="dropzone dropzone-floating-label"
                                            id="fileJumlahOplahMediaCetakPerMinggu">
                                        </div>
                                        <label class="ps-4">File PDF, Scan halaman depan 10 Terbitan Media dengan
                                            tanggal terbit berurutan</label>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($media_jenis == 'siber')
                            <div class="row mb-3">
                                <h2 class="small-title mb-md-0 mb-2">Jumlah Konten Berita Aktif dan Positif Per Tahun
                                </h2>
                                <div class="col-lg-12 col-md-12 col-12 mb-lg-0 mb-md-0 mb-2">
                                    <div class="form-floating w-100">
                                        <select class="select-floating" id="jumlahKontenBeritaAktif"
                                            name="jumlahKontenBeritaAktif">
                                            <option label="&nbsp;"></option>
                                            <option value="lebih dari 900">Lebih Dari 900</option>
                                            <option value="lebih dari 600">Lebih Dari 600 </option>
                                            <option value="lebih dari 300">Lebih Dari 300</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </form>
                </div>

                <div class="tab-pane fade" id="validationFour" role="tabpanel">
                    <h5 class="card-title">PERWAKILAN MEDIA</h5>
                    <p class="card-text text-alternate mb-4"></p>
                    <form class="tooltip-end-bottom validasi">
                        <div class="row mb-3">
                            <h2 class="small-title">Data Perwakilan Media</h2>
                            <div class="col-lg-12 col-md-6 col-12">
                                <div class="form-floating mb-lg-2 mb-md-2 mb-2">
                                    <input id="namaPerwakilan" name="namaPerwakilan" type="text"
                                        class="form-control form-control-sm" placeholder="form-control">
                                    <label class="ps-4">Nama Perwakilan Media</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6 col-12">
                                <div class="form-floating mb-lg-2 mb-md-2 mb-2">
                                    <input id="nomorKKPerwakilan" name="nomorKKPerwakilan" type="text"
                                        class="form-control form-control-sm" placeholder="form-control">
                                    <label class="ps-4">Nomor Kartu Keluarga</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6 col-12">
                                <div class="form-floating mb-lg-2 mb-md-2 mb-2">
                                    <input id="nomorKtpPerwakilan" name="nomorKtpPerwakilan" type="text"
                                        class="form-control form-control-sm" placeholder="form-control">
                                    <label class="ps-4">Nomor Induk Kependudukan</label>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                    <div class="form-floating">
                                        <input id="npwpPerwakilan" name="npwpPerwakilan" type="text"
                                            class="form-control form-control-sm" placeholder="form-control">
                                        <label class="ps-4">No NPWP Pribadi Perwakilan Media</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-floating">
                                        <div class="dropzone dropzone-floating-label" id="fileNpwpPerwakilan"
                                            name="fileNpwpPerwakilan"></div>
                                        <label class="ps-4">File PDF NPWP Pribadi Perwakilan Media</label>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="row mb-4">
                                <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                    <div class="form-floating w-100">
                                        <select class="select-floating" id="lunasPBB" name="lunasPBB">
                                            <option label="&nbsp;"></option>
                                            <option value="sudah">Sudah Lunas</option>
                                            <option value="belum">Belum Lunas</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 fileLunasPBB" hidden>
                                    <div class="form-floating w-100">
                                        <div class="dropzone dropzone-floating-label" id="fileLunasPBB"
                                            name="fileLunasPBB"></div>
                                        <label class="ps-4">File PDF Bukti Lunas PBB Tahun Berjalan</label>
                                    </div>
                                </div>
                            </div> --}}

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <h2 class="small-title mb-md-0 mb-2">Sertifikat Kompetensi Dewan Pers Perwakilan Media
                                </h2>
                                <div class="col-lg-12 col-md-12 col-12 mb-lg-0 mb-md-0 mb-2">
                                    <div class="form-floating w-100 mb-3">
                                        <select class="select-floating" id="jenisSerfikatUkwPerwakilan"
                                            name="jenisSerfikatUkwPerwakilan">
                                            <option label="&nbsp;"></option>
                                            <option value="belum">Belum Ada Sertifikat</option>
                                            <option value="utama">Utama</option>
                                            <option value="madya">Madya</option>
                                            <option value="muda">Muda</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="serfikatUkwPerwakilan" hidden>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                            <div class="form-floating">
                                                <input id="serfikatUkwPerwakilan" name="serfikatUkwPerwakilan"
                                                    type="text" class="form-control form-control-sm"
                                                    placeholder="form-control">
                                                <label class="ps-4">Nomor Sertifikat Kompetensi Perwakilan
                                                    Media</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                            <div class="form-floating">
                                                <div class="dropzone dropzone-floating-label"
                                                    id="fileSerfikatUkwPerwakilan">
                                                </div>
                                                <label class="ps-4">File PDF Sertifikat Kompetensi Dewan Pers
                                                    Perwakilan Media</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row mb-4">
                                <h2 class="small-title mb-md-0 mb-2">Afiliasi Organisasi Perwakilan Media</h2>
                                <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                    <div class="form-floating">
                                        <input id="afiliasiPersPerwakilan" name="afiliasiPersPerwakilan"
                                            type="text" class="form-control form-control-sm"
                                            placeholder="form-control">
                                        <label class="ps-4">Nama Organisasi Pers yang Terafiliasi</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                    <div class="form-floating">
                                        <div class="dropzone dropzone-floating-label" id="fileAfiliasiPersPerwakilan"
                                            name="fileafiliasiPersPerwakilan"></div>
                                        <label class="ps-4">File PDF Bukti Keanggotaan Organisasi Pers
                                            Perwakilan Media</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row mb-4">
                            <h2 class="small-title">Alamat dan Kontak Perwakilan Media</h2>
                            <div class="col-lg-12 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-md-12 col-12 mb-2">
                                        <div class="w-100">
                                            <select id="alamatProvPerwakilan" name="alamatProvPerwakilan">
                                                <option label="&nbsp;"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12 mb-2">
                                        <div class="w-100">
                                            <select id="alamatKabPerwakilan" name="alamatKabPerwakilan" hidden>
                                                <option label="&nbsp;"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12 mb-2">
                                        <div class="w-100">
                                            <select id="alamatKecPerwakilan" name="alamatKecPerwakilan" hidden>
                                                <option label="&nbsp;"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12 mb-2">
                                        <div class="w-100">
                                            <select id="alamatKelPerwakilan" name="alamatKelPerwakilan" hidden>
                                                <option label="&nbsp;"></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-12 mb-lg-2 mb-md-2 mb-2">
                                        <div class="form-floating">
                                            <input id="alamatPerwakilan" name="alamatPerwakilan" type="text"
                                                class="form-control form-control-sm" placeholder="form-control">
                                            <label class="ps-4">Alamat Perwakilan Media Detail</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                        <div class="form-floating">
                                            <input id="tlpnPerwakilan" name="tlpnPerwakilan" type="text"
                                                class="form-control form-control-sm" placeholder="form-control">
                                            <label class="ps-4">No Telpon Perwakilan Media</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                        <div class="form-floating">
                                            <input id="emailPerwakilan" name="emailPerwakilan" type="text"
                                                class="form-control form-control-sm" placeholder="form-control">
                                            <label class="ps-4">Email Perwakilan Media</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="validationLast" role="tabpanel">
                    <div class="text-center mt-5">
                        <h5 class="card-title">Harap Dibaca !!!</h5>
                        <div class="col-12 p-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="pernyataanCheckbox" name="pernyataanCheckbox">
                                <label class="form-check-label" for="invalidCheck">
                                    Dengan ini menyatakan bahwa data yang disampaikan sesuai dengan kondisi yang
                                    sebenarnya,
                                    jika ditemukan pemalsuan/ketidaksesuaian data maka dapat diproses sesuai dengan
                                    ketentuan hukum yang berlaku.

                                </label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end p-2">
                            <button id="kirimData" type="submit" class="btn btn-primary">Kirim Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer text-center border-0 pt-1">
            <button class="btn btn-icon btn-icon-start btn-outline-primary btn-prev" type="button">
                <i data-acorn-icon="chevron-left"></i>
                <span>Back</span>
            </button>
            <button class="btn btn-icon btn-icon-end btn-outline-primary btn-next" type="button">
                <span>Next</span>
                <i data-acorn-icon="chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<script>
    /**
     * wizard
     **/
    $(document).ready(function() {
        function checkValidation(form) {
            if ($('#jenisPengajuan').val() == 'siber') {
                var dataNamaMedia = "/pengajuan/checkurl?jenispengajuan=" + $('#jenisPengajuan').val();
            } else {
                var dataNamaMedia = true;
            }

            jQuery.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Tidak boleh menggunakan angka maupun karakter");
            jQuery.validator.addMethod("nospace", function(value, element) {
                return value.indexOf(" ") < 0 && value != "";
            }, "Spasi tidak diperbolehkan");

            jQuery.validator.addMethod("synchronousRemote", function(value, element) {
                if ($('#jenisPengajuan').val() == 'siber') {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    function cekLink() {
                        var params = false;
                        $.ajax({
                            type: "GET",
                            async: false,
                            url: "/pengajuan/checkurl?jenispengajuan=" + $('#jenisPengajuan')
                                .val(),
                            data: {
                                namaMedia: value
                            },
                            success: function(response) {
                                params = response === "true" ? true : false
                            }
                        });
                        return params
                    }
                    return cekLink();
                } else {
                    return true;
                }
            }, "Domain media tidak ada, tidak ada SSL, cek kembali nama domain anda");

            // default massage
            jQuery.extend(jQuery.validator.messages, {
                required: "Harus diisi.",
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

            jQuery(form).validate({
                rules: {
                    /**
                     * DATA BADAN HUKUM
                     **/
                    namaPerusahaan: {
                        required: true,
                    },
                    namaPenanggungJawab: {
                        required: true,
                    },
                    namaPimred: {
                        required: true,
                        lettersonly: true,
                        minlength: 3,
                    },
                    kumhamPerusahaan: {
                        required: true,
                    },
                    alamatProvPerusahaan: {
                        required: true,
                    },
                    alamatKabPerusahaan: {
                        required: true,
                    },
                    alamatPerusahaan: {
                        required: true,
                        minlength: 8,
                    },
                    tlpnPerusahaan: {
                        required: true,
                        number: true,
                        minlength: 11,
                    },
                    emailPerusahaan: {
                        required: true,
                        email: true,
                    },
                    statusKswp: {
                        required: true,
                    },
                    npwpPerusahaan: {
                        required: true,
                        minlength: 15,
                        nospace: true,
                    },
                    nibPerusahaan: {
                        required: true,
                        number: true,
                        minlength: 13,
                        nospace: true,
                    },
                    noKlbi: {
                        required: true,
                        number: true,
                    },
                    noKbki: {
                        required: true,
                        nospace: true,
                    },
                    izinIpp: {
                        required: true,
                    },
                    namaPercetakan: {
                        required: true,
                    },
                    alamatPercetakan: {
                        required: true,
                    },

                    /**
                     * DATA MEDIA
                     **/
                    namaMedia: {
                        required: true,
                        synchronousRemote: true,
                    },
                    verifikasiDewanPers: {
                        required: true,
                    },
                    jenisSerfikatUkwPimred: {
                        required: true,
                    },
                    serfikatUkwPimred: {
                        required: true,
                        nospace: true,
                    },
                    afiliasiPerusahaan: {
                        required: true,
                    },
                    domisiliRedaksiMedia: {
                        required: true,
                    },
                    kanalKhusus: {
                        required: true,
                    },
                    jenisRekening: {
                        required: true,
                    },
                    namaBank: {
                        required: true,
                    },
                    pemilikRekening: {
                        required: true,
                    },
                    noRekening: {
                        required: true,
                        number: true,
                    },

                    /**
                     * KUALIFIKASI MEDIA
                     **/
                    tahunBerdiriMedia: {
                        required: true,
                    },
                    jenisJangkauanSiarMediaElektronik: {
                        required: true,
                    },
                    jangkauanSiarMediaElektronik: {
                        required: true,
                    },
                    jumlahOplahMediaCetakPerMinggu: {
                        required: true,
                    },
                    jumlahKontenBeritaAktif: {
                        required: true,
                    },

                    /**
                     * PERWAKILAN MEDIA
                     **/
                    namaPerwakilan: {
                        required: true,
                    },
                    nomorKKPerwakilan: {
                        required: true,
                        nospace: true,
                    },
                    nomorKtpPerwakilan: {
                        required: true,
                        nospace: true,
                    },
                    npwpPerwakilan: {
                        required: true,
                        nospace: true,
                    },
                    // lunasPBB: {
                    //     required: true,
                    // },
                    jenisSerfikatUkwPerwakilan: {
                        required: true,
                    },
                    serfikatUkwPerwakilan: {
                        required: true,
                    },
                    afiliasiPersPerwakilan: {
                        required: true,
                    },
                    alamatProvPerwakilan: {
                        required: true,
                    },
                    alamatKabPerwakilan: {
                        required: true,
                    },
                    alamatKecPerwakilan: {
                        required: true,
                    },
                    alamatKelPerwakilan: {
                        required: true,
                    },
                    alamatPerwakilan: {
                        required: true,
                    },
                    tlpnPerwakilan: {
                        required: true,
                        number: true,
                    },
                    emailPerwakilan: {
                        required: true,
                        email: true,
                    },

                },
                onkeyup: false,
            })

            if (jQuery().validate) {
                if (jQuery(form).valid()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        var wizard = new Wizard(document.getElementById('wizardBasic'), {
            // topNav: false,
            handleButtonClicks: false,
            lastEnd: false,
            onNextClick: function(params) {
                const content = wizard.getCurrentContent();
                const form = content.querySelector(".validasi");

                if (checkValidation(form)) {
                    wizard.gotoNext();
                }
            },
            onPrevClick: function(params) {
                wizard.gotoPrev();
            },
        });
    });

    /**
     * Selector
     **/
    $(document).ready(function() {
        var urlProvinsi = "https://ibnux.github.io/data-indonesia/provinsi.json";
        var urlKabupaten = "https://ibnux.github.io/data-indonesia/kabupaten";
        var urlKecamatan = "https://ibnux.github.io/data-indonesia/kecamatan";
        var urlKelurahan = "https://ibnux.github.io/data-indonesia/kelurahan";

        function select2Data(url, alamatId, placeHolder) {
            $.getJSON(url, function(res) {
                res = $.map(res, function(obj) {
                    obj.text = obj.nama
                    return obj;
                });
                data = [{
                    id: "",
                    nama: "- Pilih Provinsi -",
                    text: "- Pilih Provinsi -"
                }].concat(res);

                //implemen data ke select provinsi
                $(alamatId).select2({
                    dropdownAutoWidth: true,
                    width: '100%',
                    data: data,
                    minimumInputLength: 2,
                    placeholder: placeHolder,
                })
            });
        }

        /**
         *  Data Badan Hukum
         **/
        select2Data(urlProvinsi, '#alamatProvPerusahaan', 'Pilih Provinsi')
        $("#alamatProvPerusahaan").change(function() {
            $('#alamatKabPerusahaan').show()
            var alamatProvPerusahaan = $(this).val()
            // console.log($('#alamatProvPerusahaan option:selected').text());
            $('#alamatKabPerusahaan').val(null).trigger('change');
            select2Data(urlKabupaten + '/' + alamatProvPerusahaan + '.json',
                '#alamatKabPerusahaan', 'Pilih Kabupaten')
        });
        $('#statusKswp').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Status KSWP Perusahaan'
        });
        $('#noKlbi').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Pilih Nomor KLBI Perusahaan'
        });

        /**
         *  Data Media
         **/
        $('#verifikasiDewanPers').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Pilih Status Verifikasi Media'
        });
        $('#jenisSerfikatUkwPimred').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Pilih Jenis Sertifikat UKW Pimred'
        });
        $('#afiliasiPerusahaan').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Pilih Jenis Afiliasi Organisasi Pers Media'
        });
        $("#afiliasiPerusahaan").change(function() {
            var value = $(this).val();
            if (value == 'tidak terafiliasi') {
                $('.fileAfiliasiPerusahaan').attr("hidden", true);
            } else {
                $('.fileAfiliasiPerusahaan').attr("hidden", false);
            }
        });
        $('#domisiliRedaksiMedia').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Pilih Domisili Redaksi Media'
        });
        $('#kanalKhusus').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Pilih Ketersediaan Kanal/Program Khusus'
        });
        $("#kanalKhusus").change(function() {
            var value = $(this).val();
            if (value == 'tidak ada') {
                $('.fileKanalKhusus').attr("hidden", true);
            } else {
                $('.fileKanalKhusus').attr("hidden", false);
            }
        });
        $('#jenisRekening').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Pilih Jenis rekening'
        });

        /**
         *  Kualifikasi Media
         **/
        $('#tahunBerdiriMedia').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Pilih Tahun Berdiri Media'
        });
        $('#jenisJangkauanSiarMediaElektronik').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Pilih Jenis Media Elektronik'
        });
        $("#jenisJangkauanSiarMediaElektronik").change(function() {
            var value = $(this).val();
            console.log(value);
            if (value == 'tv') {
                $('#jangkauanSiarMediaElektronik option').remove();
                $('#jangkauanSiarMediaElektronik').append(`
                 <option label="&nbsp;"></option>
                                            <option value="nasional">Nasional</option>
                                            <option value="lampung">Seluruh Lampung</option>
                                            <option value="minimal 5 kabupaten">Minimal 5 Kabupaten/Kota se-Lampung
                                            </option>
                `);
            } else {
                $('#jangkauanSiarMediaElektronik option').remove();
                $('#jangkauanSiarMediaElektronik').append(`
                 <option label="&nbsp;"></option>
                                            <option value="nasional">Nasional</option>
                                            <option value="lampung">Seluruh Lampung</option>
                                            <option value="minimal 3 kabupaten">Minimal 3 Kabupaten/Kota se-Lampung
                                            </option>
                `);
            }
        });
        $('#jangkauanSiarMediaElektronik').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Pilih Jangkauan Siar Media Elektronik'
        });
        $('#jumlahOplahMediaCetakPerMinggu').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Pilih Jumlah Oplah Media Cetak Per Minggu'
        });
        $('#jumlahKontenBeritaAktif').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Pilih Jumlah Konten Berita Aktif dan Positif Per Tahun'
        });

        /**
         *  Perwakilan Media
         **/
        $('#lunasPBB').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Pilih Status Lunas PBB Tahun Berjalan'
        });
        // $("#lunasPBB").change(function() {
        //     var value = $(this).val();
        //     if (value == 'belum') {
        //         $('.fileLunasPBB').prop("hidden", true);
        //     } else {
        //         $('.fileLunasPBB').prop("hidden", false);
        //     }
        // });
        $('#jenisSerfikatUkwPerwakilan').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Pilih Sertifikat Kompetensi Dewan Pers Perwakilan'
        });
        $("#jenisSerfikatUkwPerwakilan").change(function() {
            var value = $(this).val();
            if (value == 'belum') {
                $('.serfikatUkwPerwakilan').prop("hidden", true);
                $('#serfikatUkwPerwakilan').prop("required", false);
            } else {
                $('.serfikatUkwPerwakilan').prop("hidden", false);
                $('#serfikatUkwPerwakilan').prop("required", true);
            }
        });
        select2Data(urlProvinsi, '#alamatProvPerwakilan', 'Pilih Provinsi')
        $("#alamatProvPerwakilan").change(function() {
            $('#alamatKabPerwakilan').show()
            var alamatProvPerwakilan = $(this).val()
            // console.log($('#alamatProvPerusahaan option:selected').text());
            $('#alamatKelPerwakilan').val(null).trigger('change');
            $('#alamatKecPerwakilan').val(null).trigger('change');
            $('#alamatKabPerwakilan').val(null).trigger('change');
            select2Data(urlKabupaten + '/' + alamatProvPerwakilan + '.json',
                '#alamatKabPerwakilan', 'Pilih Kabupaten')
        });
        $("#alamatKabPerwakilan").change(function() {
            $('#alamatKecPerwakilan').show()
            var alamatKabPerwakilan = $(this).val()
            // console.log($('#alamatProvPerusahaan option:selected').text());
            $('#alamatKelPerwakilan').val(null).trigger('change');
            $('#alamatKecPerwakilan').val(null).trigger('change');
            select2Data(urlKecamatan + '/' + alamatKabPerwakilan + '.json',
                '#alamatKecPerwakilan', 'Pilih Kecamatan')
        });
        $("#alamatKecPerwakilan").change(function() {
            $('#alamatKelPerwakilan').show()
            var alamatKecPerwakilan = $(this).val()
            // console.log($('#alamatProvPerusahaan option:selected').text());
            $('#alamatKelPerwakilan').val(null).trigger('change');
            select2Data(urlKelurahan + '/' + alamatKecPerwakilan + '.json',
                '#alamatKelPerwakilan', 'Pilih Kelurahan')
        });
    });

    /**
     * File UploadDropzone and send data
     **/
    $(document).ready(function() {
        function upload_file(name, tagId) {
            var name = new Dropzone(tagId, {
                url: '/pengajuan/uploads',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                init: function() {
                    var param = tagId;
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
                        $(param + ' .dz-details').html('<span>' + response.name +
                            '</span>')
                    });

                    this.on('error', function() {
                        var maxFile = $('.dz-error-message').text();
                        if (maxFile != 'You can not upload any more files.') {
                            Swal.fire({
                                toast: true,
                                position: 'bottom-right',
                                icon: 'error',
                                title: 'Upload Gagal',
                                text: 'Cek Koneksi Internet Atau File Yang di Upload!',
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }
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
        }

        /**
         *  Data Badan Hukum
         **/
        if ($('#jenisPengajuan').val() == 'elektronik') {
            upload_file('dropzoneIzinIpp', '#fileIzinIpp')
        }
        upload_file('dropzoneKumhamPerusahaan', '#fileKumhamPerusahaan')
        upload_file('dropzoneSuratPernyataanPimred', '#fileSuratPernyataanPimred')
        upload_file('dropzoneNpwpPerusahaan', '#fileNpwpPerusahaan')
        upload_file('dropzoneNibPerusahaan', '#fileNibPerusahaan')

        /**
         *  Data Media
         **/
        upload_file('dropzoneSerfikatUkwPimred', '#fileSerfikatUkwPimred')
        upload_file('dropzoneAfiliasiPerusahaan', '#fileAfiliasiPerusahaan')
        upload_file('dropzoneDomisiliRedaksiMedia', '#fileDomisiliRedaksiMedia')
        upload_file('dropzoneKanalKhusus', '#fileKanalKhusus')
        upload_file('dropzoneRekening', '#fileRekening')

        /**
         *  Kualifikasi Media
         **/
        if ($('#jenisPengajuan').val() == 'harian') {
            upload_file('dropzoneJumlahOplahMediaCetakPerMinggu', '#fileJumlahOplahMediaCetakPerMinggu')
        }

        /**
         *  Perwakilan Media
         **/
        upload_file('dropzoneNpwpPerwakilan', '#fileNpwpPerwakilan')
        upload_file('dropzoneLunasPBB', '#fileLunasPBB')
        upload_file('dropzoneSerfikatUkwPerwakilan', '#fileSerfikatUkwPerwakilan')
        upload_file('dropzoneAfiliasiPersPerwakilan', '#fileAfiliasiPersPerwakilan')
    });

    /**
     * button
     **/
    $(document).ready(function() {
        /**
         * setting ttd
         **/
        //  add ttd
        // const canvas = document.querySelector("canvas");
        // const signaturePad = new SignaturePad(canvas, {
        //     penColor: "rgb(66, 133, 244)"
        // });

        // function resizeCanvas() {
        //     const ratio = Math.max(window.devicePixelRatio || 1, 1);
        //     canvas.width = canvas.offsetWidth * ratio;
        //     canvas.height = canvas.offsetHeight * ratio;
        //     canvas.getContext("2d").scale(ratio, ratio);
        //     signaturePad.clear(); // otherwise isEmpty() might return incorrect value
        // }

        // window.addEventListener("resize", resizeCanvas);
        // resizeCanvas();

        // $('#clearTtd').click(function(e) {
        //     e.preventDefault();
        //     signaturePad.clear();
        //     signaturePad.on();
        //     $('#saveTtdPng').prop('disabled', false);
        // });

        // $('#saveTtdPng').click(function(e) {
        //     // validasi ttd
        //     if (signaturePad.isEmpty()) {
        //         Swal.fire({
        //             toast: true,
        //             position: 'bottom-right',
        //             icon: 'error',
        //             title: 'Tanda Tangan',
        //             text: 'Tanda Tangan Harap diisi',
        //             showConfirmButton: false,
        //         });
        //     } else {
        //         var param = 'uploadsignature';
        //         const images = signaturePad.toDataURL();
        //         signaturePad.off();
        //         $(this).prop('disabled', true);

        //         $.ajaxSetup({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             }
        //         });
        //         $.ajax({
        //             type: "POST",
        //             url: '/pengajuan/uploads',
        //             data: {
        //                 data: param,
        //                 images: images
        //             },
        //             success: function(response) {
        //                 Swal.fire({
        //                     toast: true,
        //                     position: 'bottom-right',
        //                     icon: 'success',
        //                     title: 'Berhasil',
        //                     text: response.original_name +
        //                         ' Berhasil diupload!',
        //                     showConfirmButton: false,
        //                     timer: 3500
        //                 });
        //                 $('#signatureData').val(response.name)
        //             }
        //         });
        //     }
        // });

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
            var jenisMedia = $('#jenisPengajuan').val();
            var namaPerusahaan = $('#namaPerusahaan').val();
            var namaPimred = $('#namaPimred').val();
            var alamatPerusahaan = $('#alamatPerusahaan').val();
            var alamatProvPerusahaan = $('#alamatProvPerusahaan option:selected').text();
            var alamatKabPerusahaan = $('#alamatKabPerusahaan option:selected').text();
            var alamatKecPerusahaan = $('#alamatKecPerusahaan option:selected').text();
            var alamatKelPerusahaan = $('#alamatKelPerusahaan option:selected').text();
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
            var alamatProvPerwakilan = $('#alamatProvPerwakilan option:selected').text();
            var alamatKabPerwakilan = $('#alamatKabPerwakilan option:selected').text();
            var alamatKecPerwakilan = $('#alamatKecPerwakilan option:selected').text();
            var alamatKelPerwakilan = $('#alamatKelPerwakilan option:selected').text();
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
                    text: 'Perhatikan Dengan Seksama Sebelum Kirim Data',
                    showConfirmButton: true,
                });
            } else {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/pengajuan/store",
                    data: {
                        // perusahaan
                        jenis_media: jenisMedia,
                        nama_perusahaan: namaPerusahaan,
                        nama_pimred: namaPimred,
                        alamat_perusahaan: alamatPerusahaan,
                        alamat_prov_perusahaan: alamatProvPerusahaan,
                        alamat_kab_perusahaan: alamatKabPerusahaan,
                        alamat_kec_perusahaan: alamatKecPerusahaan,
                        alamat_kel_perusahaan: alamatKelPerusahaan,
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
                        alamat_prov_perwakilan: alamatProvPerwakilan,
                        alamat_kab_perwakilan: alamatKabPerwakilan,
                        alamat_kec_perwakilan: alamatKecPerwakilan,
                        alamat_kel_perwakilan: alamatKelPerwakilan,
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
     * validator
     **/
    $(document).ready(function() {
        // method validasi
        // if ($('#jenisPengajuan').val() == 'siber') {
        //     var dataNamaMedia = "/pengajuan/checkurl?jenispengajuan=" + $('#jenisPengajuan').val();
        // } else {
        //     var dataNamaMedia = true;
        // }
        // jQuery.validator.addMethod("lettersonly", function(value, element) {
        //     return this.optional(element) || /^[a-z\s]+$/i.test(value);
        // }, "Tidak boleh menggunakan angka maupun karakter");
        // jQuery.validator.addMethod("nospace", function(value, element) {
        //     return value.indexOf(" ") < 0 && value != "";
        // }, "Spasi tidak diperbolehkan");

        // default massage
        // jQuery.extend(jQuery.validator.messages, {
        //     required: "Harus diisi.",
        //     remote: "Please fix this field.",
        //     email: "Please enter a valid email address.",
        //     url: "Please enter a valid URL.",
        //     date: "Please enter a valid date.",
        //     dateISO: "Please enter a valid date (ISO).",
        //     number: "Please enter a valid number.",
        //     digits: "Please enter only digits.",
        //     creditcard: "Please enter a valid credit card number.",
        //     equalTo: "Please enter the same value again.",
        //     accept: "Please enter a value with a valid extension.",
        //     maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
        //     minlength: jQuery.validator.format("Please enter at least {0} characters."),
        //     rangelength: jQuery.validator.format(
        //         "Please enter a value between {0} and {1} characters long."),
        //     range: jQuery.validator.format("Please enter a value between {0} and {1}."),
        //     max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
        //     min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
        // });

        // validasi
        // jQuery.validator.setDefaults({
        //     debug: true,
        // });

        // jQuery(".validasi").validate({
        //     rules: {
        //         namaPerusahaan: {
        //             required: true,
        //             lettersonly: true,
        //         },
        //         namaPimred: {
        //             required: true,
        //             lettersonly: true,
        //             minlength: 3,
        //         },
        //         alamatPerusahaan: {
        //             required: true,
        //             minlength: 5,
        //         },
        //         alamatProvPerusahaan: {
        //             required: true,
        //         },
        //         alamatKabPerusahaan: {
        //             required: true,
        //         },
        //         alamatKecPerusahaan: {
        //             required: true,
        //         },
        //         alamatKelPerusahaan: {
        //             required: true,
        //         },
        //         tlpnPerusahaan: {
        //             required: true,
        //             number: true,
        //             minlength: 11,
        //         },
        //         emailPerusahaan: {
        //             required: true,
        //             email: true,
        //         },
        //         npwpPerusahaan: {
        //             required: true,
        //             minlength: 15,
        //         },
        //         aktaPerusahaan: {
        //             required: true,
        //             number: true,
        //         },
        //         kumhamPerusahaan: {
        //             required: true,
        //         },
        //         wartawanKompetenPerusahaan: {
        //             required: true,
        //             number: true
        //         },
        //         // opsional harian
        //         namaPercetakan: {
        //             required: true,
        //             minlength: 5,
        //         },
        //         alamatPercetakan: {
        //             required: true,
        //             minlength: 5,
        //         },
        //         alamatProvPerwakilan: {
        //             required: true,
        //         },
        //         alamatKabPerwakilan: {
        //             required: true,
        //         },
        //         alamatKecPerwakilan: {
        //             required: true,
        //         },
        //         alamatKelPerwakilan: {
        //             required: true,
        //         },
        //         // perwakilan
        //         namaMedia: {
        //             required: true,
        //             remote: dataNamaMedia,
        //         },
        //         namaBiroPerwakilan: {
        //             required: true,
        //             lettersonly: true,
        //             minlength: 3,
        //         },
        //         alamatPerwakilan: {
        //             required: true,
        //             minlength: 3,
        //         },
        //         tlpnPerwakilan: {
        //             required: true,
        //             number: true,
        //             minlength: 11,
        //         },
        //         emailPerwakilan: {
        //             required: true,
        //             email: true,
        //         },
        //         ktpPerwakilan: {
        //             required: true,
        //             number: true,
        //             nospace: true,
        //             // minlength: 16
        //         },
        //         kkPerwakilan: {
        //             required: true,
        //             number: true,
        //             nospace: true,
        //             // minlength: 16
        //         },
        //         npwpPerwakilan: {
        //             required: true,
        //             minlength: 15,
        //         },
        //         kompetensiPerwakilan: {
        //             required: true,
        //         },
        //         jenisRekening: {
        //             required: true,
        //         },
        //         namaBank: {
        //             required: true,
        //             minlength: 3,
        //         },
        //         pemilikRekening: {
        //             required: true,
        //             lettersonly: true,
        //         },
        //         noRekening: {
        //             required: true,
        //             number: true,
        //         },
        //         pernyataanCheckbox: {
        //             required: true,
        //         },
        //     },
        //     messages: {
        //         namaMedia: {
        //             remote: "Domain media tidak terregister, tidak ada SSL, cek kembali nama domain anda",
        //         },
        //     },
        //     onkeyup: false,
        // })

        // jQuery("form").validate({
        //     rules: {
        //         namaPerusahaan: {
        //             required: true,
        //         },
        //         namaMedia: {
        //             required: true,
        //             remote: dataNamaMedia,
        //         },
        //     },
        //     messages: {
        //         namaMedia: {
        //             remote: "Domain media tidak ada, tidak ada SSL, cek kembali nama domain anda",
        //         },
        //     },
        //     onkeyup: false,
        // })
    });
</script>
