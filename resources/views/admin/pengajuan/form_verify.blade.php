@extends('panel.master')
@section('content')
    <main>
        @foreach ($media_data as $md)
            <section class="scroll-section">
                <div class="h3 text-primary text-capitalize">Verifikasi Data Perusahaan Media {{ $md->jenis_media }}</div>
                <div class="card cardMain mb-3">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-4">
                                    {{-- <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div> --}}
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td scope="row">POIN DALAM NILAI</th>
                                                <td>:</td>
                                                <td id="poinDalamNilai" colspan="2"></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">POIN DALAM GRADE</th>
                                                <td>:</td>
                                                <td id="poinDalamGrade" colspan="2"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-8"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-10">
                                    @if ($tahun_verifikasi == 1)
                                        <div class="d-grid gap-2 d-md-block">
                                            <button id="terima" type="submit" class="btn btn-primary">Terima</button>
                                            <button id="tolakOpenModal" type="submit" class="btn btn-danger">Tolak</button>
                                            {{-- <button id="tolak" type="submit" class="btn btn-danger">Tolak</button> --}}
                                            <button id="undefinedValue" type="submit" class="btn btn-dark">Tidak Dapat Dinilai</button>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-2">
                                    <button id="cekNilai" type="submit" class="btn btn-info">Sync Nilai</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card cardMain wizard mb-3 " id="wizardBasic1">
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
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade" id="validationFirst" role="tabpanel">
                                <h5 class="card-title">DATA BADAN HUKUM</h5>
                                <p class="card-text text-alternate mb-4"></p>
                                <form class="tooltip-end-bottom validasi">
                                    <div class="row mb-3">
                                        <div class="row">
                                            <div class="col-12 col-md-10">
                                                <h2 class="small-title">Perusahaan/Badan Hukum</h2>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Perusahaan/Badan Hukum" id="verifikasiBadanHukum" checked>
                                                    <label class="form-check-label" for="verifikasiBadanHukum">
                                                        VERIFIKASI
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-6 col-12 mb-md-0">
                                            <div class="form-floating mb-3">
                                                <input id="namaPerusahaan" name="namaPerusahaan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->namaPerusahaan }}">
                                                <label class="ps-4">Nama Perusahaan Sesuai AHU</label>
                                                <div id="pengajuanNo" data-noPengajuan="{{ $md->pengajuan_no }}" hidden>
                                                    {{ $md->pengajuan_no }}</div>
                                                <input type="text" id="pengajuanJenisMedia" value="{{ $md->jenis_media }}" hidden disabled>
                                                {{-- <div id="pengajuanJenisMedia" data-jenisMedia="{{ $md->jenis_media }}" hidden>
                                                    {{ $md->jenis_media }}</div> --}}
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input id="namaPenanggungJawab" name="namaPenanggungJawab" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->namaPenanggungJawab }}">
                                                <label class="ps-4">Nama Penanggung Jawab</label>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6 col-md-12 col-12 mb-lg-0 ">
                                                    <div class="form-floating mb-3">
                                                        <input id="namaPimred" name="namaPimred" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->namaPimred }}">
                                                        <label class="ps-4">Nama Pimpinan Redaksi Perusahaan</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12 mb-lg-0">
                                                    <div class="form-floating mb-3">
                                                        <div class="dropzone dropzone-floating-label" id="fileSuratPernyataanPimred">
                                                            <input type="text" value="{{ $md->fileSuratPernyataanPimred }}" hidden>
                                                        </div>
                                                        <label class="ps-4">File PDF
                                                            Surat Pernyataan Sebagai Pimred dari Badan Hukum</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mb-4">

                                    <div class="row mb-3">
                                        <div class="row">
                                            <div class="col-12 col-md-10">
                                                <h2 class="small-title">Pengesahan Kemenkumham Perusahaan</h2>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Pengesahan Kemenkumham Perusahaan" id="verifikasiPengesahanKemkumham" checked>
                                                    <label class="form-check-label" for="verifikasiPengesahanKemkumham">
                                                        VERIFIKASI
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                            <div class="form-floating">
                                                <input id="kumhamPerusahaan" name="kumhamPerusahaan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->kumhamPerusahaan }}">
                                                <label class="ps-4">No Pengesahan Kemenkumham Perusahaan</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                            <div class="form-floating">
                                                <div class="dropzone dropzone-floating-label" id="fileKumhamPerusahaan">
                                                    <input type="text" value="{{ $md->fileKumhamPerusahaan }}" hidden>
                                                </div>
                                                <label class="ps-4">File PDF Pengesahan Kemenkumham Perusahaan</label>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mb-4">

                                    <div class="row mb-3">
                                        <div class="row">
                                            <div class="col-12 col-md-10">
                                                <h2 class="small-title mb-md-0 mb-2">Kontak Perusahaan</h2>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Kontak Perusahaan" id="verifikasiKontakPerusahaan" checked>
                                                    <label class="form-check-label" for="verifikasiKontakPerusahaan">
                                                        VERIFIKASI
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">
                                            <div class="row mb-3">
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <div class="form-floating w-100">
                                                        <select class="select-floating" id="alamatProvPerusahaan" name="alamatProvPerusahaan">
                                                            <option label="&nbsp;"></option>
                                                            <input type="text" id="dataAlamatProvPerusahaan" value="{{ $md->alamatProvPerusahaan }}" hidden>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <div class="form-floating w-100">
                                                        <select class="select-floating" id="alamatKabPerusahaan" name="alamatKabPerusahaan">
                                                            <option label="&nbsp;"></option>
                                                            <input type="text" id="dataAlamatKabPerusahaan" value="{{ $md->alamatKabPerusahaan }}" hidden>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input id="alamatPerusahaan" name="alamatPerusahaan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->alamatPerusahaan }}">
                                                <label class="ps-4">Alamat Perusahaan Detail</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                            <div class="form-floating">
                                                <input id="tlpnPerusahaan" name="tlpnPerusahaan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->tlpnPerusahaan }}">
                                                <label class="ps-4">No Telpon Perusahaan</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                            <div class="form-floating">
                                                <input id="emailPerusahaan" name="emailPerusahaan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->emailPerusahaan }}">
                                                <label class="ps-4">Email Perusahaan</label>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mb-4">

                                    <div class="row mb-3">
                                        <div class="row">
                                            <div class="col-12 col-md-10">
                                                <h2 class="small-title mb-md-0 mb-2">Status KSWP</h2>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Status KSWP" id="verifikasiStatusKswp" checked>
                                                    <label class="form-check-label" for="verifikasiStatusKswp">
                                                        VERIFIKASI
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                            <div class="form-floating w-100">
                                                <select class="select-floating" id="statusKswp" name="statusKswp">
                                                    @if ($md->statusKswp)
                                                        <option value="{{ $md->statusKswp }}">{{ $md->statusKswp }}
                                                        </option>
                                                    @else
                                                        <option label="&nbsp;"></option>
                                                    @endif
                                                    <option value="valid">KSPW Valid</option>
                                                    <option value="tidak valid">KSPW Tidak Valid</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mb-4">

                                    <div class="row mb-3">
                                        <div class="row">
                                            <div class="col-12 col-md-10">
                                                <h2 class="small-title">NPWP Perusahaan/Badan Hukum</h2>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="NPWP Perusahaan/Badan Hukum" id="verifikasiNpwpPerusahaan" checked>
                                                    <label class="form-check-label" for="verifikasiNpwpPerusahaan">
                                                        VERIFIKASI
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                            <div class="form-floating">
                                                <input id="npwpPerusahaan" name="npwpPerusahaan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->npwpPerusahaan }}">
                                                <label class="ps-4">No NPWP Perusahaan/Badan Hukum</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-floating">
                                                <div class="dropzone dropzone-floating-label" id="fileNpwpPerusahaan" name="fileNpwpPerusahaan">
                                                    <input type="text" value="{{ $md->fileNpwpPerusahaan }}" hidden>
                                                </div>
                                                <label class="ps-4">File PDF
                                                    NPWP Perusahaan</label>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mb-4">

                                    <div class="row mb-3">
                                        <div class="row">
                                            <div class="col-12 col-md-10">
                                                <h2 class="small-title">Nomor Induk Berusaha Perusahaan/Badan Hukum</h2>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Nomor Induk Berusaha Perusahaan/Badan Hukum" id="verifikasiNib" checked>
                                                    <label class="form-check-label" for="verifikasiNib">
                                                        VERIFIKASI
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                            <div class="form-floating">
                                                <input id="nibPerusahaan" name="nibPerusahaan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->nibPerusahaan }}">
                                                <label class="ps-4">Nomor Induk Berusaha Perusahaan/Badan Hukum</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-floating">
                                                <div class="dropzone dropzone-floating-label" id="fileNibPerusahaan" name="fileNibPerusahaan">
                                                    <input type="text" value="{{ $md->fileNibPerusahaan }}" hidden>
                                                </div>
                                                <label class="ps-4">File PDF
                                                    Nomor Induk Berusaha Perusahaan/Badan Hukum</label>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mb-4">

                                    <div class="row mb-3">
                                        <div class="row">
                                            <div class="col-12 col-md-10">
                                                <h2 class="small-title mb-md-0 mb-2">Nomor KLBI</h2>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Nomor KLBI" id="verifikasiNoKlbi" checked>
                                                    <label class="form-check-label" for="verifikasiNoKlbi">
                                                        VERIFIKASI
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                            <div class="form-floating w-100">
                                                <select class="select-floating" id="noKlbi" name="noKlbi">
                                                    @if ($md->noKlbi)
                                                        <option value="{{ trim($md->noKlbi, 'klbi ') }}">
                                                            {{ $md->noKlbi }}</option>
                                                    @else
                                                        <option label="&nbsp;"></option>
                                                    @endif
                                                    <option value="63911">KBLI 63911</option>
                                                    <option value="63912">KBLI 63912</option>
                                                    <option value="60201">KBLI 60201</option>
                                                    <option value="60202">KBLI 60202</option>
                                                    <option value="60101">KBLI 60101</option>
                                                    <option value="60102">KBLI 60102</option>
                                                    <option value="58130">KBLI 58130</option>
                                                    <option value="63122">KBLI 63122</option>
                                                    <option value="63121">KBLI 63121</option>
                                                    <option value="63990">KBLI 63990</option>
                                                    <option value="74130">KBLI 74130</option>
                                                    <option value="18111">KBLI 18111</option>
                                                    <option value="73100">KBLI 73100</option>
                                                    <option value="18111">KBLI 18111</option>
                                                    <option value="73100">KBLI 73100</option>
                                                    <option value="59132">KBLI 59132</option>
                                                    <option value="59131">KBLI 59131</option>
                                                    <option value="59121">KBLI 59121</option>
                                                    <option value="59122">KBLI 59122</option>
                                                    <option value="59111">KBLI 59111</option>
                                                    <option value="59112">KBLI 59112</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mb-4">

                                    <div class="row mb-3">
                                        <div class="row">
                                            <div class="col-12 col-md-10">
                                                <h2 class="small-title mb-md-0 mb-2">Nomor KBKI</h2>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Nomor KBKI" id="verifikasiNoKbki" checked>
                                                    <label class="form-check-label" for="verifikasiNoKbki">
                                                        VERIFIKASI
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                            <div class="form-floating">
                                                <input id="noKbki" name="noKbki" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->noKbki }}">
                                                <label class="ps-4">Nomor KBKI Perusahaan</label>
                                            </div>
                                        </div>
                                    </div>


                                    @if ($md->jenis_media == 'elektronik')
                                        <hr class="mb-4">

                                        <div class="row mb-4">
                                            <div class="row">
                                                <div class="col-12 col-md-10">
                                                    <h2 class="small-title mb-md-0 mb-2">Dokumen izin Penyelenggaraan Penyiaran</h2>
                                                </div>
                                                <div class="col-12 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="Dokumen izin Penyelenggaraan Penyiaran" id="verifikasiIpp" checked>
                                                        <label class="form-check-label" for="verifikasiIpp">
                                                            VERIFIKASI
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                                <div class="form-floating">
                                                    <input id="izinIpp" name="izinIpp" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->izinIpp }}">
                                                    <label class="ps-4">Izin Penyelenggaraan Penyiaran</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                                <div class="form-floating">
                                                    <div class="dropzone dropzone-floating-label" id="fileIzinIpp">
                                                        <input type="text" value="{{ $md->fileIzinIpp }}" hidden>
                                                    </div>
                                                    <label class="ps-4">File PDF Izin Penyelenggaraan Penyiaran</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($md->jenis_media == 'cetak')
                                        <hr class="mb-4">

                                        <div class="row mb-4">
                                            <div class="row">
                                                <div class="col-12 col-md-10">
                                                    <h2 class="small-title">Percetakan</h2>
                                                </div>
                                                <div class="col-12 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="Percetakan" id="verifikasiPercetakan" checked>
                                                        <label class="form-check-label" for="verifikasiPercetakan">
                                                            VERIFIKASI
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">
                                                <div class="form-floating">
                                                    <input id="namaPercetakan" name="namaPercetakan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->namaPercetakan }}">
                                                    <label class="ps-4">Nama Percetakan</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12 mb-md-0 mb-2">
                                                <div class="form-floating">
                                                    <input id="alamatPercetakan" name="alamatPercetakan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->alamatPercetakan }}">
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
                                        <div class="row">
                                            <div class="col-12 col-md-10">
                                                <h2 class="small-title">Nama Media</h2>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Nama Media" id="verifikasiNamaMedia" checked>
                                                    <label class="form-check-label" for="verifikasiNamaMedia">
                                                        VERIFIKASI
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12 mb-lg-0 mb-md-0 mb-2">
                                            <div class="form-floating">
                                                <input id="namaMedia" name="namaMedia" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->namaMedia }}">
                                                <label class="ps-4">Nama Media</label>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mb-4">

                                    <div class="row mb-3">
                                        <div class="row">
                                            <div class="col-12 col-md-10">
                                                <h2 class="small-title mb-md-0 mb-2">Status Verifikasi Media</h2>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Status Verifikasi Media" id="verifikasiStatusMedia" checked>
                                                    <label class="form-check-label" for="verifikasiStatusMedia">
                                                        VERIFIKASI
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12 mb-lg-0 mb-md-0 mb-2">
                                            <div class="form-floating w-100">
                                                <select class="select-floating" id="verifikasiDewanPers" name="verifikasiDewanPers">
                                                    @if ($md->verifikasiDewanPers)
                                                        <option value="{{ $md->verifikasiDewanPers }}">
                                                            {{ str_replace('  ', '', $md->verifikasiDewanPers) }}</option>
                                                    @else
                                                        <option label="&nbsp;"></option>
                                                    @endif
                                                    <option value="faktual dan administratif">Terverifikasi Faktual dan Administratif</option>
                                                    <option value="administratif">Terverifikasi Administratif</option>
                                                    <option value="belum">Belum Terverifikasi</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mb-4">

                                    <div class="row mb-3">
                                        <div class="row">
                                            <div class="col-12 col-md-10">
                                                <h2 class="small-title mb-md-0 mb-2">Sertifikat UKW Pimred</h2>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Sertifikat UKW Pimred" id="verifikasiSertifikatUkwPimred" checked>
                                                    <label class="form-check-label" for="verifikasiSertifikatUkwPimred">
                                                        VERIFIKASI
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                            <div class="form-floating">
                                                <div class="w-100">
                                                    <select class="select-floating" id="jenisSerfikatUkwPimred" name="jenisSerfikatUkwPimred">
                                                        @if ($md->jenisSerfikatUkwPimred)
                                                            <option value="{{ $md->jenisSerfikatUkwPimred }}">
                                                                {{ $md->jenisSerfikatUkwPimred }}</option>
                                                        @else
                                                            <option label="&nbsp;"></option>
                                                        @endif
                                                        <option value="utama">Utama</option>
                                                        <option value="madya">Madya</option>
                                                        <option value="muda">Muda</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                            <div class="form-floating">
                                                <input id="serfikatUkwPimred" name="serfikatUkwPimred" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->serfikatUkwPimred }}">
                                                <label class="ps-4">Nomor Sertifikat Pimred Media</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2 mt-3">
                                            <div class="form-floating">
                                                <div class="dropzone dropzone-floating-label" id="fileSerfikatUkwPimred">
                                                    <input type="text" value="{{ $md->fileSerfikatUkwPimred }}" hidden>
                                                </div>
                                                <label class="ps-4">File PDF Sertifikat Pimpinan Redaksi</label>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mb-4">

                                    <div class="row mb-3">
                                        <div class="row">
                                            <div class="col-12 col-md-10">
                                                <h2 class="small-title mb-md-0 mb-2">Afiliasi Organisasi Perusahaan/Media Pers</h2>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Afiliasi Organisasi Perusahaan/Media Pers" id="verifikasiAfiliasiOrganisasiMedia" checked>
                                                    <label class="form-check-label" for="verifikasiAfiliasiOrganisasiMedia">
                                                        VERIFIKASI
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                            <div class="form-floating w-100">
                                                <select class="select-floating" id="afiliasiPerusahaan" name="afiliasiPerusahaan">
                                                    @if ($md->afiliasiPerusahaan)
                                                        <option value="{{ $md->afiliasiPerusahaan }}">
                                                            {{ str_replace('  ', '', $md->afiliasiPerusahaan) }}</option>
                                                    @else
                                                        <option label="&nbsp;"></option>
                                                    @endif
                                                    <option value="tidak terafiliasi">Tidak Terafiliasi</option>
                                                    <option value="diakui">Organisasi Pers yang diakui Dewan Pers</option>
                                                    <option value="belum diakui">Organisasi Pers yang belum diakui Dewan Pers</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                            <div class="form-floating fileAfiliasiPerusahaan" hidden>
                                                <div class="dropzone dropzone-floating-label" id="fileAfiliasiPerusahaan">
                                                    <input type="text" value="{{ $md->fileAfiliasiPerusahaan }}" hidden>
                                                </div>
                                                <label class="ps-4">File PDF Bukti Afiliasi Organisasi Pers Media</label>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mb-4">

                                    <div class="row mb-3">
                                        <div class="row">
                                            <div class="col-12 col-md-10">
                                                <h2 class="small-title mb-md-0 mb-2">Domisili Redaksi Media</h2>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Domisili Redaksi Media" id="verifikasiDomisiliRedaksiMedia" checked>
                                                    <label class="form-check-label" for="verifikasiDomisiliRedaksiMedia">
                                                        VERIFIKASI
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                            <div class="form-floating w-100">
                                                <select class="select-floating" id="domisiliRedaksiMedia" name="domisiliRedaksiMedia">
                                                    @if ($md->domisiliRedaksiMedia)
                                                        <option value="{{ $md->domisiliRedaksiMedia }}">{{ str_replace('  ', '', $md->domisiliRedaksiMedia) }}</option>
                                                    @else
                                                        <option label="&nbsp;"></option>
                                                    @endif
                                                    <option value="tulang bawang barat">di Tulang Bawang Barat</option>
                                                    <option value="luar tulang bawang barat">di luar Tulang Bawang Barat, di Prov.Lampung</option>
                                                    <option value="luar lampung">di luar Provinsi Lampung</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                            <div class="form-floating fileDomisiliRedaksiMedia" hidden>
                                                <div class="dropzone dropzone-floating-label" id="fileDomisiliRedaksiMedia">
                                                    <input type="text" value="{{ $md->fileDomisiliRedaksiMedia }}" hidden>
                                                </div>
                                                <label class="ps-4">File PDF, Surat Keterangan Domisili dari Instansi
                                                    Berwenang</label>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mb-4">

                                    <div class="row mb-3">
                                        <div class="row">
                                            <div class="col-12 col-md-10">
                                                <h2 class="small-title mb-md-0 mb-2">Kanal/program Tentang Tulang Bawang Barat</h2>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Kanal/program Tentang Tulang Bawang Barat" id="verifikasiKanalMedia" checked>
                                                    <label class="form-check-label" for="verifikasiKanalMedia">
                                                        VERIFIKASI
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                            <div class="form-floating w-100">
                                                <select class="select-floating" id="kanalKhusus" name="kanalKhusus">
                                                    @if ($md->kanalKhusus)
                                                        <option value="{{ $md->kanalKhusus }}">{{ $md->kanalKhusus }}
                                                        </option>
                                                    @else
                                                        <option label="&nbsp;"></option>
                                                    @endif
                                                    <option value="khusus">Khusus</option>
                                                    <option value="ada">Ada</option>
                                                    <option value="tidak ada">Tidak Ada</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                            <div class="form-floating fileKanalKhusus" hidden>
                                                <div class="dropzone dropzone-floating-label" id="fileKanalKhusus">
                                                    <input type="text" value="{{ $md->fileKanalKhusus }}" hidden>
                                                </div>
                                                <label class="ps-4">File PDF, Bukti Adanya Kanal/program khusus Tulang
                                                    Bawang
                                                    Barat</label>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mb-4">

                                    <div class="row mb-4">
                                        <div class="row">
                                            <div class="col-12 col-md-10">
                                                <h2 class="small-title">Rekening Bank</h2>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Rekening Bank" id="verifikasiRekeningBank" checked>
                                                    <label class="form-check-label" for="verifikasiRekeningBank">
                                                        VERIFIKASI
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">
                                            <div class="top-label mb-2 w-100">
                                                <select name="jenisRekening" id="jenisRekening">
                                                    @if ($md->jenisRekening)
                                                        <option value="{{ $md->jenisRekening }}">{{ $md->jenisRekening }}
                                                        </option>
                                                    @else
                                                        <option label="&nbsp;"></option>
                                                    @endif
                                                    <option value="perusahaan">perusahaan</option>
                                                    <option value="perwakilan">Perwakilan</option>
                                                </select>
                                                <span>Jenis Rekening</span>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input id="namaBank" name="namaBank" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->namaBank }}">
                                                <label class="ps-4">Nama Bank</label>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input id="pemilikRekening" name="pemilikRekening" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->pemilikRekening }}">
                                                <label class="ps-4">Nama Pemilik Rekening</label>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input id="noRekening" name="noRekening" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->noRekening }}">
                                                <label class="ps-4">No Rekening Perusahaan</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">
                                            <div class="form-floating">
                                                <div class="dropzone dropzone-floating-label" id="fileRekening">
                                                    <input type="text" value="{{ $md->fileRekening }}" hidden>
                                                </div>
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
                                        <div class="row">
                                            <div class="col-12 col-md-10">
                                                <h2 class="small-title mb-md-0 mb-2">Tahun Berdiri Media</h2>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Tahun Berdiri Media" id="verifikasiTahunBerdiriMedia" checked>
                                                    <label class="form-check-label" for="verifikasiTahunBerdiriMedia">
                                                        VERIFIKASI
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12 mb-lg-0 mb-md-0 mb-2">
                                            <div class="form-floating w-100">
                                                <select class="select-floating" id="tahunBerdiriMedia" name="tahunBerdiriMedia">
                                                    @if ($md->tahunBerdiriMedia)
                                                        <option value="{{ $md->tahunBerdiriMedia }}">
                                                            {{ $md->tahunBerdiriMedia }}</option>
                                                    @else
                                                        <option label="&nbsp;"></option>
                                                    @endif
                                                    @php
                                                        for ($i = date('Y'); $i >= date('Y') - 100; $i -= 1) {
                                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                                        }
                                                    @endphp
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mb-4">

                                    @if ($md->jenis_media == 'elektronik')
                                        <div class="row mb-3">
                                            <div class="row">
                                                <div class="col-12 col-md-10">
                                                    <h2 class="small-title mb-md-0 mb-2">Jangkauan Siar Media Elektronik</h2>
                                                </div>
                                                <div class="col-12 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="Jangkauan Siar Media Elektronik" id="verifikasiJangkauanSiarMediaEletronik" checked>
                                                        <label class="form-check-label" for="verifikasiJangkauanSiarMediaEletronik">
                                                            VERIFIKASI
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-12 mb-lg-0 mb-md-0 mb-2">
                                                <div class="form-floating w-100">
                                                    <select class="select-floating" id="jenisJangkauanSiarMediaElektronik" name="jenisJangkauanSiarMediaElektronik">
                                                        @if ($md->jenisJangkauanSiarMediaElektronik)
                                                            <option value="{{ $md->jenisJangkauanSiarMediaElektronik }}">
                                                                {{ $md->jenisJangkauanSiarMediaElektronik }}</option>
                                                        @else
                                                            <option label="&nbsp;"></option>
                                                        @endif
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
                                                    <select class="select-floating" id="jangkauanSiarMediaElektronik" name="jangkauanSiarMediaElektronik">
                                                        @if ($md->jangkauanSiarMediaElektronik)
                                                            <option value="{{ $md->jangkauanSiarMediaElektronik }}">
                                                                {{ $md->jangkauanSiarMediaElektronik }}</option>
                                                        @else
                                                            <option label="&nbsp;"></option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($md->jenis_media == 'cetak')
                                        <div class="row mb-3">
                                            <div class="row">
                                                <div class="col-12 col-md-10">
                                                    <h2 class="small-title mb-md-0 mb-2">Jumlah Oplah Media Cetak Per Minggu</h2>
                                                </div>
                                                <div class="col-12 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="Jumlah Oplah Media Cetak Per Minggu" id="verifikasiJumlahOplahMedia" checked>
                                                        <label class="form-check-label" for="verifikasiJumlahOplahMedia">
                                                            VERIFIKASI
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                                <div class="form-floating w-100">
                                                    <select class="select-floating" id="jumlahOplahMediaCetakPerMinggu" name="jumlahOplahMediaCetakPerMinggu">
                                                        @if ($md->jumlahOplahMediaCetakPerMinggu)
                                                            <option value="{{ $md->jumlahOplahMediaCetakPerMinggu }}">
                                                                {{ $md->jumlahOplahMediaCetakPerMinggu }}</option>
                                                        @else
                                                            <option label="&nbsp;"></option>
                                                        @endif
                                                        <option value="lebih dari 8000">Lebih Dari 8.000</option>
                                                        <option value="4000 sampai 8000">4.000 Sampai 8.000</option>
                                                        <option value="kurang dari 4000">Kurang Dari 4.000</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                                <div class="form-floating jumlahOplahMediaCetakPerMinggu">
                                                    <div class="dropzone dropzone-floating-label" id="fileJumlahOplahMediaCetakPerMinggu">
                                                        <input type="text" value="{{ $md->fileJumlahOplahMediaCetakPerMinggu }}" hidden>
                                                    </div>
                                                    <label class="ps-4">File PDF, Scan halaman depan 10 Terbitan Media
                                                        dengan
                                                        tanggal terbit berurutan</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($md->jenis_media == 'siber')
                                        <div class="row mb-3">
                                            <div class="row">
                                                <div class="col-12 col-md-10">
                                                    <h2 class="small-title mb-md-0 mb-2">Jumlah Konten Berita Aktif dan Positif Per Tahun</h2>
                                                </div>
                                                <div class="col-12 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="Jumlah Konten Berita Aktif dan Positif Per Tahun" id="verifikasiJumlahKontenAktif" checked>
                                                        <label class="form-check-label" for="verifikasiJumlahKontenAktif">
                                                            VERIFIKASI
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-12 mb-lg-0 mb-md-0 mb-2">
                                                <div class="form-floating w-100">
                                                    <select class="select-floating" id="jumlahKontenBeritaAktif" name="jumlahKontenBeritaAktif">
                                                        @if ($md->jumlahKontenBeritaAktif)
                                                            <option value="{{ $md->jumlahKontenBeritaAktif }}">
                                                                {{ $md->jumlahKontenBeritaAktif }}</option>
                                                        @else
                                                            <option label="&nbsp;"></option>
                                                        @endif
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
                                        <div class="row">
                                            <div class="col-12 col-md-10">
                                                <h2 class="small-title">Data Perwakilan Media</h2>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Data Perwakilan Media" id="verifikasiDataPerwakilan" checked>
                                                    <label class="form-check-label" for="verifikasiDataPerwakilan">
                                                        VERIFIKASI
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-6 col-12">
                                            <div class="form-floating mb-lg-2 mb-md-2 mb-2">
                                                <input id="namaPerwakilan" name="namaPerwakilan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->namaPerwakilan }}">
                                                <label class="ps-4">Nama Perwakilan Media</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-6 col-12">
                                            <div class="form-floating mb-lg-2 mb-md-2 mb-2">
                                                <input id="nomorKKPerwakilan" name="nomorKKPerwakilan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->nomorKKPerwakilan }}">
                                                <label class="ps-4">Nomor Kartu Keluarga</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-6 col-12">
                                            <div class="form-floating mb-lg-2 mb-md-2 mb-2">
                                                <input id="nomorKtpPerwakilan" name="nomorKtpPerwakilan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->nomorKtpPerwakilan }}">
                                                <label class="ps-4">Nomor Induk Kependudukan</label>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                                <div class="form-floating">
                                                    <input id="npwpPerwakilan" name="npwpPerwakilan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->npwpPerwakilan }}">
                                                    <label class="ps-4">No NPWP Pribadi Perwakilan Media</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-floating">
                                                    <div class="dropzone dropzone-floating-label" id="fileNpwpPerwakilan" name="fileNpwpPerwakilan">
                                                        <input type="text" value="{{ $md->fileNpwpPerwakilan }}" hidden>
                                                    </div>
                                                    <label class="ps-4">File PDF NPWP Pribadi Perwakilan Media</label>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="mb-4">

                                        <div class="row mb-4">
                                            <div class="row">
                                                <div class="col-12 col-md-10">
                                                    <h2 class="small-title mb-md-0 mb-2">Sertifikat Kompetensi Dewan Pers Perwakilan Media</h2>
                                                </div>
                                                <div class="col-12 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="Sertifikat Kompetensi Dewan Pers Perwakilan Media" id="verifikasiSertifikatUkwPerwakilan" checked>
                                                        <label class="form-check-label" for="verifikasiSertifikatUkwPerwakilan">
                                                            VERIFIKASI
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-12 mb-lg-0 mb-md-0 mb-2">
                                                <div class="form-floating w-100 mb-3">
                                                    <select class="select-floating" id="jenisSerfikatUkwPerwakilan" name="jenisSerfikatUkwPerwakilan">
                                                        @if ($md->jenisSerfikatUkwPerwakilan)
                                                            <option value="{{ $md->jenisSerfikatUkwPerwakilan }}">
                                                                {{ $md->jenisSerfikatUkwPerwakilan }}</option>
                                                        @else
                                                            <option label="&nbsp;"></option>
                                                        @endif
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
                                                            <input id="serfikatUkwPerwakilan" name="serfikatUkwPerwakilan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->serfikatUkwPerwakilan }}">
                                                            <label class="ps-4">Nomor Sertifikat Kompetensi Perwakilan
                                                                Media</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                                        <div class="form-floating">
                                                            <div class="dropzone dropzone-floating-label" id="fileSerfikatUkwPerwakilan">
                                                                <input type="text" value="{{ $md->fileSerfikatUkwPerwakilan }}" hidden>
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
                                            <div class="row">
                                                <div class="col-12 col-md-10">
                                                    <h2 class="small-title mb-md-0 mb-2">Afiliasi Organisasi Perwakilan Media</h2>
                                                </div>
                                                <div class="col-12 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="Afiliasi Organisasi Perwakilan Media" id="verifikasiAfiliasiOrganisasiPerwakilan" checked>
                                                        <label class="form-check-label" for="verifikasiAfiliasiOrganisasiPerwakilan">
                                                            VERIFIKASI
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                                <div class="form-floating">
                                                    <input id="afiliasiPersPerwakilan" name="afiliasiPersPerwakilan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->afiliasiPersPerwakilan }}">
                                                    <label class="ps-4">Nama Organisasi Pers yang Terafiliasi</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                                                <div class="form-floating">
                                                    <div class="dropzone dropzone-floating-label" id="fileAfiliasiPersPerwakilan" name="fileAfiliasiPersPerwakilan">
                                                        <input type="text" value="{{ $md->fileafiliasiPersPerwakilan }}" hidden>
                                                    </div>
                                                    <label class="ps-4">File PDF Bukti Keanggotaan Organisasi Pers
                                                        Perwakilan Media</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mb-4">

                                    <div class="row mb-4">
                                        <div class="row">
                                            <div class="col-12 col-md-10">
                                                <h2 class="small-title">Alamat dan Kontak Perwakilan Media</h2>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Alamat dan Kontak Perwakilan Media" id="verifikasiAlamatPerwakilan" checked>
                                                    <label class="form-check-label" for="verifikasiAlamatPerwakilan">
                                                        VERIFIKASI
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">
                                            <div class="row mb-3">
                                                <div class="col-lg-6 col-md-12 col-12 mb-2">
                                                    <div class="w-100">
                                                        <select id="alamatProvPerwakilan" name="alamatProvPerwakilan">
                                                            <option label="&nbsp;"></option>
                                                            <input type="text" id="dataAlamatProvPerwakilan" value="{{ $md->alamatProvPerwakilan }}" hidden>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12 mb-2">
                                                    <div class="w-100">
                                                        <select id="alamatKabPerwakilan" name="alamatKabPerwakilan">
                                                            <option label="&nbsp;"></option>
                                                            <input type="text" id="dataAlamatKabPerwakilan" value="{{ $md->alamatKabPerwakilan }}" hidden>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-12 mb-lg-2 mb-md-2 mb-2">
                                                    <div class="form-floating">
                                                        <input id="alamatPerwakilan" name="alamatPerwakilan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->alamatPerwakilan }}">
                                                        <label class="ps-4">Alamat Perwakilan Media Detail</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                                    <div class="form-floating">
                                                        <input id="tlpnPerwakilan" name="tlpnPerwakilan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->tlpnPerwakilan }}">
                                                        <label class="ps-4">No Telpon Perwakilan Media</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                                                    <div class="form-floating">
                                                        <input id="emailPerwakilan" name="emailPerwakilan" type="text" class="form-control form-control-sm" placeholder="form-control" value="{{ $md->emailPerwakilan }}">
                                                        <label class="ps-4">Email Perwakilan Media</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            {{-- <div class="tab-pane fade" id="validationLast" role="tabpanel">
                                <div class="text-center mt-5">
                                    <h5 class="card-title">Total Poin Grade</h5>
                                    <div class="col-12 p-2">
                                         <div class="form-check">
                                            <button id="terima" type="submit" class="btn btn-primary">Terima</button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
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
        @endforeach
    </main>

    <div id="tolakModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="data-verifikasi mb-2"></div>
                    <div class="text-box">
                        <textarea id="noteTolak" class="form-control" aria-label="With textarea" placeholder="Optional Notes"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="tolak" type="submit" class="btn btn-danger">Kirim</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {

            /**
             * wizard
             **/
            // $(document).ready(function() {
            function checkValidation(form) {
                if ($('#pengajuanJenisMedia').val() == 'siber') {
                    var dataNamaMedia = "/pengajuan/checkurl?jenispengajuan=" + $('#pengajuanJenisMedia').val();
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
                    if ($('#pengajuanJenisMedia').val() == 'siber') {
                        // $.ajaxSetup({
                        //     headers: {
                        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        //     }
                        // });

                        function cekLink() {
                            var params = false;
                            $.ajax({
                                type: "GET",
                                async: false,
                                url: "/pengajuan/checkurl?jenispengajuan=" + $('#pengajuanJenisMedia')
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
                            // required: true,
                        },
                        domisiliRedaksiMedia: {
                            // required: true,
                        },
                        kanalKhusus: {
                            // required: true,
                        },
                        jenisRekening: {
                            // required: true,
                        },
                        namaBank: {
                            // required: true,
                        },
                        pemilikRekening: {
                            // required: true,
                        },
                        noRekening: {
                            // required: true,
                            number: true,
                        },

                        /**
                         * KUALIFIKASI MEDIA
                         **/
                        tahunBerdiriMedia: {
                            // required: true,
                        },
                        jenisJangkauanSiarMediaElektronik: {
                            // required: true,
                        },
                        jangkauanSiarMediaElektronik: {
                            // required: true,
                        },
                        jumlahOplahMediaCetakPerMinggu: {
                            // required: true,
                        },
                        jumlahKontenBeritaAktif: {
                            // required: true,
                        },

                        /**
                         * PERWAKILAN MEDIA
                         **/
                        namaPerwakilan: {
                            // required: true,
                        },
                        nomorKKPerwakilan: {
                            // required: true,
                            nospace: true,
                        },
                        nomorKtpPerwakilan: {
                            // required: true,
                            nospace: true,
                        },
                        npwpPerwakilan: {
                            // required: true,
                            nospace: true,
                        },
                        // lunasPBB: {
                        //     required: true,
                        // },
                        jenisSerfikatUkwPerwakilan: {
                            // required: true,
                        },
                        // serfikatUkwPerwakilan: {
                        //     required: true,
                        // },
                        afiliasiPersPerwakilan: {
                            // required: true,
                        },
                        alamatProvPerwakilan: {
                            // required: true,
                        },
                        alamatKabPerwakilan: {
                            // required: true,
                        },
                        alamatKecPerwakilan: {
                            // required: true,
                        },
                        alamatKelPerwakilan: {
                            // required: true,
                        },
                        alamatPerwakilan: {
                            // required: true,
                        },
                        tlpnPerwakilan: {
                            // required: true,
                            number: true,
                        },
                        emailPerwakilan: {
                            // required: true,
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

            var wizard = new Wizard(document.getElementById('wizardBasic1'), {
                topNav: true,
                handleButtonClicks: false,
                lastEnd: false,
            });

            $('.btn-next').click(function(e) {
                e.preventDefault();
                const content = wizard.getCurrentContent();
                const form = content.querySelector(".validasi");

                if (checkValidation(form)) {
                    wizard.gotoNext();
                }
            });
            $('.btn-prev').click(function(e) {
                e.preventDefault();
                wizard.gotoPrev();
            });
            // });

            /**
             * Selector
             **/
            // $(document).ready(function() {
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

            function eachAlamat(url, alamat, options) {
                $.get(url, function(data) {
                    $.each(data, function(i, item) {
                        var prov = alamat;
                        if (item.nama == prov.toUpperCase()) {
                            // console.log(item.id);
                            $(options).html(
                                '<option value="' + item.id + '" selected="selected">' +
                                item.nama +
                                '</option>'
                            )
                        }
                    });
                });
            }

            /**
             *  Data Badan Hukum
             **/
            eachAlamat(urlProvinsi, $('#dataAlamatProvPerusahaan').val(), '#alamatProvPerusahaan')
            select2Data(urlProvinsi, '#alamatProvPerusahaan', 'Pilih Provinsi')
            eachAlamat(urlProvinsi, $('#dataAlamatProvPerwakilan').val(), '#alamatProvPerwakilan')
            select2Data(urlProvinsi, '#alamatProvPerwakilan', 'Pilih Provinsi')
            window.onload = (event) => {
                setTimeout(
                    function() {
                        //do something special
                        var urlProvPerusahaan = urlKabupaten + '/' + $(
                                '#alamatProvPerusahaan option:selected').val() +
                            '.json';
                        var urlProvPerwakilan = urlKabupaten + '/' + $(
                                '#alamatProvPerusahaan option:selected').val() +
                            '.json';
                        eachAlamat(urlProvPerusahaan, $('#dataAlamatKabPerusahaan').val(),
                            '#alamatKabPerusahaan');
                        select2Data(urlProvPerusahaan,
                            '#alamatKabPerusahaan', 'Pilih Kabupaten');

                        eachAlamat(urlProvPerwakilan, $('#dataAlamatKabPerwakilan').val(),
                            '#alamatKabPerwakilan');
                        select2Data(urlProvPerwakilan,
                            '#alamatKabPerwakilan', 'Pilih Kabupaten');
                    }, 800);

                var kanalKhusus = $('#kanalKhusus').val();
                var domisiliRedaksiMedia = $('#domisiliRedaksiMedia').val();
                var afiliasiPerusahaan = $('#afiliasiPerusahaan').val();
                var jenisSerfikatUkwPerwakilan = $('#jenisSerfikatUkwPerwakilan').val();

                if ((domisiliRedaksiMedia == 'tulang bawang barat') || (domisiliRedaksiMedia == 'di tulang bawang barat')) {
                    $('.fileDomisiliRedaksiMedia').prop('hidden', false)
                } else {
                    $('.fileDomisiliRedaksiMedia').prop('hidden', true)
                }
                if (afiliasiPerusahaan == 'tidak terafiliasi') {
                    $('.fileAfiliasiPerusahaan').prop('hidden', true)
                } else {
                    $('.fileAfiliasiPerusahaan').prop('hidden', false)
                }
                if (kanalKhusus == 'tidak ada') {
                    $('.fileKanalKhusus').prop('hidden', true)
                } else {
                    $('.fileKanalKhusus').prop('hidden', false)
                }
                if (jenisSerfikatUkwPerwakilan == 'belum ada sertifikat') {
                    $('.serfikatUkwPerwakilan').prop('hidden', true)
                    $('#serfikatUkwPerwakilan').prop('required', false)
                } else {
                    $('.serfikatUkwPerwakilan').prop('hidden', false)
                    $('#serfikatUkwPerwakilan').prop('required', true)
                }
            };

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
            $(document).on('change', '#jenisSerfikatUkwPimred', function() {
                // $("#jenisSerfikatUkwPimred").change(function() {
                var value = $(this).val();
                if (value == 'belum') {
                    $('#serfikatUkwPerwakilan').prop("required", true);
                } else {
                    $('#serfikatUkwPerwakilan').prop("required", false);
                }
            });
            $('#afiliasiPerusahaan').select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Pilih Jenis Afiliasi Organisasi Pers Media'
            });

            $(document).on('change', '#afiliasiPerusahaan', function() {
                // $("#afiliasiPerusahaan").change(function() {
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

            $(document).on('change', '#domisiliRedaksiMedia', function() {
                var value = $(this).val();
                console.log(value);
                if ((value == 'tulang bawang barat') || (value == 'di tulang bawang barat')) {
                    $('.fileDomisiliRedaksiMedia').attr("hidden", false);
                } else {
                    $('.fileDomisiliRedaksiMedia').attr("hidden", true);
                }
            });
            $('#kanalKhusus').select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Pilih Ketersediaan Kanal/Program Khusus'
            });

            $(document).on('change', '#kanalKhusus', function() {
            // $("#kanalKhusus").change(function() {
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

            $(document).on('change', '#jenisJangkauanSiarMediaElektronik', function() {
                // $("#jenisJangkauanSiarMediaElektronik").change(function() {
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
            $('#jenisSerfikatUkwPerwakilan').select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Pilih Sertifikat Kompetensi Dewan Pers Perwakilan'
            });
            $(document).on('change', '#jenisSerfikatUkwPerwakilan', function() {
            // $("#jenisSerfikatUkwPerwakilan").change(function() {
                var value = $(this).val();
                if (value == 'belum' || value == 'belum ada sertifikat') {
                    $('.serfikatUkwPerwakilan').prop("hidden", true);
                    $('#serfikatUkwPerwakilan').prop("required", false);
                } else {
                    $('.serfikatUkwPerwakilan').prop("hidden", false);
                    $('#serfikatUkwPerwakilan').prop("required", true);
                }
            });
            select2Data(urlProvinsi, '#alamatProvPerwakilan', 'Pilih Provinsi')
            $(document).on('change', '#alamatProvPerwakilan', function() {
            // $("#alamatProvPerwakilan").change(function() {
                $('#alamatKabPerwakilan').show()
                var alamatProvPerwakilan = $(this).val()
                // console.log($('#alamatProvPerusahaan option:selected').text());
                $('#alamatKelPerwakilan').val(null).trigger('change');
                $('#alamatKecPerwakilan').val(null).trigger('change');
                $('#alamatKabPerwakilan').val(null).trigger('change');
                select2Data(urlKabupaten + '/' + alamatProvPerwakilan + '.json',
                    '#alamatKabPerwakilan', 'Pilih Kabupaten')
            });
            // });

            /**
             * File UploadDropzone and send data
             **/
            // $(document).ready(function() {
            function upload_file(name, tagId) {
                var name = new Dropzone(tagId, {
                    url: '/pengajuan/uploads',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    init: function() {
                        var param = tagId;

                        var nameMock = $(param + ' input').val();
                        var mockFiles = {
                            name: nameMock,
                            size: '100000000'
                        };
                        // console.log($(param + ' .namaDetail span').text());
                        // console.log(param);
                        if ($(param + ' input').val()) {
                            this.emit("addedfile", mockFiles);
                            this.emit("thumbnail", mockFiles,
                                '/assets/img/logo/pdf_logo.png');
                            this.files.push(nameMock);

                            this.on('addedfile', function(file) {
                                this.removeFile(mockFiles);
                            });
                        }



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
            if ($('#pengajuanJenisMedia').val() == 'elektronik') {
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
            if ($('#pengajuanJenisMedia').val() == 'cetak') {
                upload_file('dropzoneJumlahOplahMediaCetakPerMinggu', '#fileJumlahOplahMediaCetakPerMinggu')
            }

            /**
             *  Perwakilan Media
             **/
            upload_file('dropzoneNpwpPerwakilan', '#fileNpwpPerwakilan')
            // upload_file('dropzoneLunasPBB', '#fileLunasPBB')
            upload_file('dropzoneSerfikatUkwPerwakilan', '#fileSerfikatUkwPerwakilan')
            upload_file('dropzoneAfiliasiPersPerwakilan', '#fileAfiliasiPersPerwakilan')
            // });

            function getDataCalculate() {
                var jenis = $('#pengajuanJenisMedia').val();
                if (jenis == 'cetak') {
                    // BADAN HUKUM
                    if ($('#verifikasiPercetakan').is(':checked')) {
                        var verifikasiPercetakan = 10;
                    } else {
                        var verifikasiPercetakan = 0;
                    }
                    // KUALIFIKASI MEDIA
                    if ($('#verifikasiJumlahOplahMedia').is(':checked')) {
                        var jumlahOplahMediaCetakPerMinggu = $('#jumlahOplahMediaCetakPerMinggu option:selected').text().replace(/[\r\n]+/gm, ' ').trim();

                        if (jumlahOplahMediaCetakPerMinggu.toLowerCase() === 'lebih dari 8.000') {
                            var verifikasiJumlahOplahMedia = 5;
                        } else if (jumlahOplahMediaCetakPerMinggu.toLowerCase() === '4.000 sampai 8.000') {
                            var verifikasiJumlahOplahMedia = 3;
                        } else if (jumlahOplahMediaCetakPerMinggu.toLowerCase() === 'kurang dari 4.000') {
                            var verifikasiJumlahOplahMedia = 2;
                        } else {
                            var verifikasiJumlahOplahMedia = 0;
                        }
                    } else {
                        var verifikasiJumlahOplahMedia = 0;
                        var verifikasiJumlahKontenAktif = 0;
                    }

                    var verifikasiNamaMedia = 0;
                    var verifikasiIpp = 0;
                    var verifikasiJangkauanSiarMediaEletronik = 0;
                    var verifikasiJumlahKontenAktif = 0;
                } else if (jenis == 'elektronik') {
                    // BADAN HUKUM
                    if ($('#verifikasiIpp').is(':checked')) {
                        var verifikasiIpp = 10;
                    } else {
                        var verifikasiIpp = 0;
                    }
                    // KUALIFIKASI MEDIA
                    if ($('#verifikasiJangkauanSiarMediaEletronik').is(':checked')) {
                        var jenisJangkauanSiarMediaElektronik = $('#jenisJangkauanSiarMediaElektronik option:selected').text().replace(/[\r\n]+/gm, ' ').trim();
                        var jangkauanSiarMediaElektronik = $('#jangkauanSiarMediaElektronik option:selected').text().replace(/[\r\n]+/gm, ' ').trim();
                        if (jenisJangkauanSiarMediaElektronik.toLowerCase() === 'televisi') {
                            if (jangkauanSiarMediaElektronik.toLowerCase() === 'nasional') {
                                var verifikasiJangkauanSiarMediaEletronik = 5;
                            } else if (jangkauanSiarMediaElektronik.toLowerCase() === 'seluruh lampung') {
                                var verifikasiJangkauanSiarMediaEletronik = 3;
                            } else if (jangkauanSiarMediaElektronik.toLowerCase() === 'minimal 5 kabupaten/kota se-lampung') {
                                var verifikasiJangkauanSiarMediaEletronik = 2;
                            } else {
                                var verifikasiJangkauanSiarMediaEletronik = 0;
                            }
                        } else {
                            if (jangkauanSiarMediaElektronik.toLowerCase() === 'nasional') {
                                var verifikasiJangkauanSiarMediaEletronik = 5;
                            } else if (jangkauanSiarMediaElektronik.toLowerCase() === 'seluruh lampung') {
                                var verifikasiJangkauanSiarMediaEletronik = 3;
                            } else if (jangkauanSiarMediaElektronik.toLowerCase() === 'minimal 3 kabupaten/kota se-lampung') {
                                var verifikasiJangkauanSiarMediaEletronik = 2;
                            } else {
                                var verifikasiJangkauanSiarMediaEletronik = 0;
                            }
                        }
                    } else {
                        var verifikasiJangkauanSiarMediaEletronik = 0;
                    }
                    var verifikasiNamaMedia = 0;
                    var verifikasiPercetakan = 0;
                    var verifikasiJumlahOplahMedia = 0;
                    var verifikasiJumlahKontenAktif = 0;
                } else if (jenis == 'siber') {
                    // DATA MEDIA
                    if ($('#verifikasiNamaMedia').is(':checked')) {
                        var verifikasiNamaMedia = 10;
                    } else {
                        var verifikasiNamaMedia = 0;
                    }
                    // KUALIFIKASI MEDIA
                    if ($('#verifikasiJumlahKontenAktif').is(':checked')) {
                        var jumlahKontenBeritaAktif = $('#jumlahKontenBeritaAktif option:selected').text().replace(/[\r\n]+/gm, ' ').trim();

                        if (jumlahKontenBeritaAktif.toLowerCase() === 'lebih dari 900') {
                            var verifikasiJumlahKontenAktif = 5;
                        } else if (jumlahKontenBeritaAktif.toLowerCase() === 'lebih dari 600') {
                            var verifikasiJumlahKontenAktif = 3;
                        } else if (jumlahKontenBeritaAktif.toLowerCase() === 'lebih dari 300') {
                            var verifikasiJumlahKontenAktif = 2;
                        } else {
                            var verifikasiJumlahKontenAktif = 0;
                        }
                    } else {
                        var verifikasiJumlahKontenAktif = 0;
                    }
                    var verifikasiPercetakan = 0;
                    var verifikasiIpp = 0;
                    var verifikasiJangkauanSiarMediaEletronik = 0;
                    var verifikasiJumlahOplahMedia = 0;
                }

                // BADAN HUKUM
                if ($('#verifikasiBadanHukum').is(':checked')) {
                    var verifikasiBadanHukum = 10;
                } else {
                    var verifikasiBadanHukum = 0;
                }
                if ($('#verifikasiPengesahanKemkumham').is(':checked')) {
                    var verifikasiPengesahanKemkumham = 10;
                } else {
                    var verifikasiPengesahanKemkumham = 0;
                }
                if ($('#verifikasiKontakPerusahaan').is(':checked')) {
                    var verifikasiKontakPerusahaan = 10;
                } else {
                    var verifikasiKontakPerusahaan = 0;
                }
                if ($('#verifikasiStatusKswp').is(':checked')) {
                    var verifikasiStatusKswp = 10;
                } else {
                    var verifikasiStatusKswp = 0;
                }
                if ($('#verifikasiNpwpPerusahaan').is(':checked')) {
                    var verifikasiNpwpPerusahaan = 10;
                } else {
                    var verifikasiNpwpPerusahaan = 0;
                }
                if ($('#verifikasiNib').is(':checked')) {
                    var verifikasiNib = 10;
                } else {
                    var verifikasiNib = 0;
                }
                if ($('#verifikasiNoKlbi').is(':checked')) {
                    var verifikasiNoKlbi = 10;
                } else {
                    var verifikasiNoKlbi = 0;
                }
                if ($('#verifikasiNoKbki').is(':checked')) {
                    var verifikasiNoKbki = 10;
                } else {
                    var verifikasiNoKbki = 0;
                }

                // DATA MEDIA
                // console.log($('#verifikasiDewanPers option:selected').text().trim());
                if ($('#verifikasiStatusMedia').is(':checked')) {
                    var verifikasiDewanPers = $('#verifikasiDewanPers option:selected').text().replace(/[\r\n]+/gm, ' ').trim();

                    if (verifikasiDewanPers.toLowerCase() === 'terverifikasi faktual dan administratif') {
                        var verifikasiStatusMedia = 6;
                    } else if (verifikasiDewanPers.toLowerCase() === 'terverifikasi administratif') {
                        var verifikasiStatusMedia = 4;
                    } else {
                        var verifikasiStatusMedia = 0;
                    }
                } else {
                    var verifikasiStatusMedia = 0;
                }
                if ($('#verifikasiSertifikatUkwPimred').is(':checked')) {
                    var jenisSerfikatUkwPimred = $('#jenisSerfikatUkwPimred option:selected').text().replace(/[\r\n]+/gm, ' ')
                        .trim();
                    // if (jenisSerfikatUkwPimred.toLowerCase() === 'utama') {
                    //     var verifikasiSertifikatUkwPimred = 15;
                    // } else if (jenisSerfikatUkwPimred.toLowerCase() === 'madya') {
                    //     var verifikasiSertifikatUkwPimred = 13;
                    // } else {
                    //     var verifikasiSertifikatUkwPimred = 12;
                    // }
                    if (jenisSerfikatUkwPimred.toLowerCase() === 'utama') {
                        var verifikasiSertifikatUkwPimred = 5;
                    } else if (jenisSerfikatUkwPimred.toLowerCase() === 'madya') {
                        var verifikasiSertifikatUkwPimred = 3;
                    } else {
                        var verifikasiSertifikatUkwPimred = 2;
                    }
                } else {
                    var verifikasiSertifikatUkwPimred = 0;
                }
                if ($('#verifikasiAfiliasiOrganisasiMedia').is(':checked')) {
                    var afiliasiPerusahaan = $('#afiliasiPerusahaan option:selected').text().replace(/[\r\n]+/gm, ' ')
                        .trim();
                    if (afiliasiPerusahaan.toLowerCase() === 'organisasi pers yang diakui dewan pers') {
                        var verifikasiAfiliasiOrganisasiMedia = 7;
                    } else if (afiliasiPerusahaan.toLowerCase() === 'organisasi pers yang belum diakui dewan pers') {
                        var verifikasiAfiliasiOrganisasiMedia = 3;
                    } else {
                        var verifikasiAfiliasiOrganisasiMedia = 0;
                    }
                } else {
                    var verifikasiAfiliasiOrganisasiMedia = 0;
                }
                if ($('#verifikasiDomisiliRedaksiMedia').is(':checked')) {
                    var domisiliRedaksiMedia = $('#domisiliRedaksiMedia option:selected').text().replaceAll(/[\r\n]+/gm, ' ').trim();

                    if (domisiliRedaksiMedia.toLowerCase() === 'di tulang bawang barat') {
                        var verifikasiDomisiliRedaksiMedia = 5;
                    } else if (domisiliRedaksiMedia.toLowerCase() === 'di luar tulang bawang barat, di prov.lampung') {
                        var verifikasiDomisiliRedaksiMedia = 3;
                    } else {
                        var verifikasiDomisiliRedaksiMedia = 2;
                    }
                } else {
                    var verifikasiDomisiliRedaksiMedia = 0;
                }
                if ($('#verifikasiKanalMedia').is(':checked')) {
                    var kanalKhusus = $('#kanalKhusus option:selected').text().replaceAll(/[\r\n]+/gm, ' ').trim();

                    if (kanalKhusus.toLowerCase() === 'khusus') {
                        var verifikasiKanalMedia = 6;
                    } else if (kanalKhusus.toLowerCase() === 'ada') {
                        var verifikasiKanalMedia = 4;
                    } else {
                        var verifikasiKanalMedia = 0;
                    }
                } else {
                    var verifikasiKanalMedia = 0;
                }
                if ($('#verifikasiRekeningBank').is(':checked')) {
                    var verifikasiRekeningBank = 0;
                } else {
                    var verifikasiRekeningBank = 0;
                }

                // KUALIFIKASI MEDIA
                if ($('#verifikasiTahunBerdiriMedia').is(':checked')) {
                    var tahunBerdiriMedia = $('#tahunBerdiriMedia option:selected').text().replaceAll(/[\r\n]+/gm, ' ').trim();

                    if (tahunBerdiriMedia.toLowerCase() <= '2010') {
                        var verifikasiTahunBerdiriMedia = 5;
                    } else if (tahunBerdiriMedia.toLowerCase() >= '2011' && tahunBerdiriMedia.toLowerCase() <= '2020') {
                        var verifikasiTahunBerdiriMedia = 3;
                    } else {
                        var verifikasiTahunBerdiriMedia = 2;
                    }
                } else {
                    var verifikasiTahunBerdiriMedia = 0;
                }

                // PERWAKILAN MEDIA
                // if ($('#verifikasiDataPerwakilan').is(':checked')) {
                //     var verifikasiDataPerwakilan = 15;
                // } else {
                //     var verifikasiDataPerwakilan = 0;
                // }
                // if ($('#verifikasiSertifikatUkwPerwakilan').is(':checked')) {
                //     var jenisSerfikatUkwPerwakilan = $('#jenisSerfikatUkwPerwakilan option:selected').text().replaceAll(/[\r\n]+/gm, ' ').trim();

                //     if (jenisSerfikatUkwPerwakilan.toLowerCase() == 'utama') {
                //         var verifikasiSertifikatUkwPerwakilan = 12;
                //     } else if (jenisSerfikatUkwPerwakilan.toLowerCase() == 'madya') {
                //         var verifikasiSertifikatUkwPerwakilan = 11;
                //     } else if (jenisSerfikatUkwPerwakilan.toLowerCase() == 'muda') {
                //         var verifikasiSertifikatUkwPerwakilan = 10;
                //     } else {
                //         var verifikasiSertifikatUkwPerwakilan = 0;
                //     }
                // } else {
                //     var verifikasiSertifikatUkwPerwakilan = 0;
                // }
                // if ($('#verifikasiAfiliasiOrganisasiPerwakilan').is(':checked')) {
                //     var verifikasiAfiliasiOrganisasiPerwakilan = 5;
                // } else {
                //     var verifikasiAfiliasiOrganisasiPerwakilan = 0;
                // }
                // if ($('#verifikasiAlamatPerwakilan').is(':checked')) {
                //     var verifikasiAlamatPerwakilan = 0;
                // } else {
                //     var verifikasiAlamatPerwakilan = 0;
                // }

                let hasil = verifikasiBadanHukum +
                    verifikasiPengesahanKemkumham +
                    verifikasiKontakPerusahaan +
                    verifikasiStatusKswp +
                    verifikasiNpwpPerusahaan +
                    verifikasiNib +
                    verifikasiNoKlbi +
                    verifikasiNoKbki +
                    verifikasiPercetakan +
                    verifikasiIpp +
                    verifikasiNamaMedia +
                    verifikasiStatusMedia +
                    verifikasiSertifikatUkwPimred +
                    verifikasiAfiliasiOrganisasiMedia +
                    verifikasiDomisiliRedaksiMedia +
                    verifikasiKanalMedia +
                    verifikasiRekeningBank +
                    verifikasiTahunBerdiriMedia +
                    verifikasiJumlahKontenAktif +
                    verifikasiJangkauanSiarMediaEletronik +
                    verifikasiJumlahOplahMedia
                // PERWAKILAN MEDIA
                // +verifikasiDataPerwakilan +
                // verifikasiSertifikatUkwPerwakilan +
                // verifikasiAfiliasiOrganisasiPerwakilan;

                $('#poinDalamNilai').text(hasil);
                if (hasil <= '107') {
                    var grade = $('#poinDalamGrade').text('C');
                } else if ((hasil >= '108') && (hasil <= '126')) {
                    var grade = $('#poinDalamGrade').text('B');
                } else if (hasil >= '127') {
                    var grade = $('#poinDalamGrade').text('A');
                }
            }

            getDataCalculate()

            /**
             * button
             **/
            // $(document).ready(function() {
            $('#tolakModal').on('hidden.bs.modal', function() {
                // do something…
                $("#tolakModal .modal-body .data-verifikasi").html('');
            })
            $('#tolakOpenModal').click(function(e) {
                e.preventDefault();
                $('#tolakModal').modal('show')
                getDataCalculate()

                var dataValue = $(":checkbox:not(:checked)").map(function() {
                    return $(this).val();
                }).get();
                let i = 1;
                $.each(dataValue, function(indexInArray, valueOfElement) {
                    $(".modal-body .data-verifikasi").append('<span>' + i + '. ' + valueOfElement + '</span><br>');
                    i++
                });
            });

            $('#cekNilai').click(function(e) {
                e.preventDefault();
                getDataCalculate()
            });

            // diterima
            $('#terima').click(function(e) {
                e.preventDefault();
                var pengajuanNo = $('#pengajuanNo').attr('data-nopengajuan');
                getDataCalculate()

                Swal.fire({
                    title: "Anda Akan Menerima Data ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                }).then((result) => {
                    if (result.isConfirmed) {
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
                                nilai: $('#poinDalamNilai').text(),
                                grade: $('#poinDalamGrade').text(),
                                param: 'terima'
                            },
                            beforeSend: function(response) {
                                $('.cardMain').addClass('overlay-spinner');
                                $('#terima').attr('disabled', true)
                            },
                            error: function(response) {
                                $('.cardMain').removeClass('overlay-spinner');
                                $('#terima').attr('disabled', false)
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
                                        // window.location.href = "/daftar/" + response.tahun + '/detail';
                                        window.history.back();
                                    }, 3000);
                                }
                                $('.cardMain').removeClass('overlay-spinner');
                                $('#terima').attr('disabled', false)
                            }
                        });
                    }
                });
            });

            // ditolak
            $('#tolak').click(function(e) {
                e.preventDefault();
                var dataValue = $(":checkbox:not(:checked)").map(function() {
                    return $(this).val();
                }).get();
                var pengajuanNo = $('#pengajuanNo').attr('data-nopengajuan');
                var noteTolak = $('#noteTolak').val();
                console.log(noteTolak);
                getDataCalculate()

                Swal.fire({
                    title: "Anda Akan Menolak Data ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                }).then((result) => {
                    if (result.isConfirmed) {

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
                                keterangan: dataValue,
                                note: noteTolak,
                                status: 'tolak',
                                nilai: $('#poinDalamNilai').text(),
                                grade: $('#poinDalamGrade').text(),
                                param: 'tolak'
                            },
                            beforeSend: function(response) {
                                $('.cardMain').addClass('overlay-spinner');
                                $('#tolak').attr('disabled', true)
                            },
                            error: function(response) {
                                $('.cardMain').removeClass('overlay-spinner');
                                $('#tolak').attr('disabled', false)
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
                                        // window.location.href = "/daftar/" + response.tahun + '/detail';
                                        window.history.back();
                                    }, 3000);
                                }
                                $('.cardMain').removeClass('overlay-spinner');
                                $('#tolak').attr('disabled', false)
                                $('#tolakModal').modal('hidden')
                            }
                        });
                    }
                });
            });

            // tidak dapat dinilai
            $('#undefinedValue').click(function(e) {
                e.preventDefault();
                var dataValue = $(":checkbox:checked").map(function() {
                    return $(this).val();
                }).get();
                var pengajuanNo = $('#pengajuanNo').attr('data-nopengajuan');
                getDataCalculate()

                Swal.fire({
                    title: "Data Tidak Dapat Dinilai ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                }).then((result) => {
                    if (result.isConfirmed) {


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
                                keterangan: dataValue,
                                status: 'tolak',
                                nilai: '',
                                param: 'undefinedValue'
                            },
                            beforeSend: function(response) {
                                $('.cardMain').addClass('overlay-spinner');
                                $('#undefinedValue').attr('disabled', true)
                            },
                            error: function(response) {
                                $('.cardMain').removeClass('overlay-spinner');
                                $('#undefinedValue').attr('disabled', false)
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
                                        // window.location.href = "/daftar/" + response.tahun + '/detail';
                                        window.history.back();
                                    }, 3000);
                                }
                                $('.cardMain').removeClass('overlay-spinner');
                                $('#undefinedValue').attr('disabled', false)
                            }
                        });
                    }
                });
            });


            $('.dz-preview').click(function(e) {
                e.preventDefault();
                var file = $(this).find('img').attr('alt');
                var folder = $(this).parent().attr('id').toLowerCase();
                window.open('/tmp/uploads/' + folder + '/' + file, '_blank');
            })
            // });
        });
    </script>
@endpush
