<style>
    /* .wrapper {
        position: relative;
        width: 400px;
        height: 200px;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
    } */

    /* .signature-pad {
        position: absolute;
        left: 0;
        top: 0;
        width: 400px;
        height: 200px;
        background-color: white;
    } */
</style>
<form class="validasi" novalidate>
    <section class="scroll-section">
        <div class="h3 text-primary text-capitalize">Data Perusahaan Media {{ $media_jenis }}</div>
        <div class="card mb-5">
            <div class="card-body">
                <section class="scroll-section" id="breakpointSpecificResponsive">
                    <div class="row mb-4">
                        <h2 class="small-title">Nama Perusahaan</h2>
                        <div class="form-floating">
                            <input id="namaPerusahaan" name="namaPerusahaan" type="text"
                                class="form-control form-control-sm" placeholder="form-control">
                            <label class="ps-4">Nama Perusahaan Sesuai AHU</label>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row mb-4">
                        <h2 class="small-title">Nama Pimpinan Perusahaan</h2>
                        <div class="form-floating">
                            <input id="namaPimred" name="namaPimred" type="text" class="form-control form-control-sm"
                                placeholder="form-control">
                            <label class="ps-4">Nama Pimpinan Perusahaan</label>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row mb-4">
                        <h2 class="small-title">Kontak</h2>
                        <div class="col-lg-4 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">
                            <div class="form-floating">
                                <input id="alamatPerusahaan" name="alamatPerusahaan" type="text"
                                    class="form-control form-control-sm" placeholder="form-control">
                                <label class="ps-4">Alamat Perusahaan</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                            <div class="form-floating">
                                <input id="tlpnPerusahaan" name="tlpnPerusahaan" type="text"
                                    class="form-control form-control-sm" placeholder="form-control">
                                <label class="ps-4">No Telpon Perusahaan</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                            <div class="form-floating">
                                <input id="emailPerusahaan" name="emailPerusahaan" type="text"
                                    class="form-control form-control-sm" placeholder="form-control">
                                <label class="ps-4">Email Perusahaan</label>
                            </div>
                        </div>
                    </div>

                    {{-- cok disini tambahin 2 kolom lagi  --}}
                    {{-- 1.  nama media cetak harian  --}}
                    <hr class="mb-4">

                    {{-- 2. nama dan alamat percetakan --}}
                    {{-- opsional harian --}}
                    @if ($media_jenis == 'harian')
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

                        <hr class="mb-4">
                    @endif

                    {{-- opsional Elektronik --}}
                    @if ($media_jenis == 'elektronik')
                        <div class="row mb-4">
                            <h2 class="small-title mb-md-0 mb-2">Dokumen izin Penyelenggaraan Penyiaran</h2>
                            <div class="form-floating">
                                <div class="dropzone dropzone-floating-label" id="fileIzinIpp"></div>
                                <label class="ps-4">File PDF izin Penyelenggaraan Penyiaran</label>
                            </div>
                        </div>

                        <hr class="mb-4">
                    @endif


                    <div class="row mb-4">
                        <h2 class="small-title">NPWP Perusahaan</h2>
                        <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                            <div class="form-floating">
                                <input id="npwpPerusahaan" name="npwpPerusahaan" type="text"
                                    class="form-control form-control-sm" placeholder="form-control">
                                <label class="ps-4">No NPWP Perusahaan</label>
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

                    <div class="row mb-4">
                        <h2 class="small-title mb-md-0 mb-2">Akta Pendirian dan Perubahan Perusahaan</h2>
                        <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                            <div class="form-floating">
                                <input id="aktaPerusahaan" name="aktaPerusahaan" type="text"
                                    class="form-control form-control-sm" placeholder="form-control">
                                <label class="ps-4">No Akta Pendirian Perusahaan</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                            <div class="form-floating">
                                <div class="dropzone dropzone-floating-label" id="fileAktaPerusahaan"></div>
                                <label class="ps-4">File PDF Akta Pendirian dan Perubahan Perusahaan</label>
                            </div>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row mb-4">
                        <h2 class="small-title mb-md-0 mb-2">Pengesahan Kemenkumham Perusahaan</h2>
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

                    <div class="row mb-4">
                        <h2 class="small-title mb-md-0 mb-2">Wartawan Kompeten Perusahaan</h2>
                        <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                            <div class="form-floating">
                                <input id="wartawanKompetenPerusahaan" name="wartawanKompetenPerusahaan"
                                    type="text" class="form-control form-control-sm" placeholder="form-control">
                                <label class="ps-4">Jumlah Wartawan Kompeten</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-2">
                            <div class="form-floating">
                                <div class="dropzone dropzone-floating-label" id="fileWartawanKompetenPerusahaan">
                                </div>
                                <label class="ps-4">File PDF Wartawan Kompeten Perusahaan</label>
                            </div>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row mb-4">
                        <h2 class="small-title mb-md-0 mb-2">Laporan SPT Pajak Tahunan Perusahaan</h2>
                        <div class="form-floating">
                            <div class="dropzone dropzone-floating-label" id="fileSptPerusahaan"></div>
                            <label class="ps-4">File PDF Laporan Pajak Perusahaan</label>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row mb-4">
                        <h2 class="small-title mb-md-0 mb-2">Verifikasi Dewan Pers Perusahaan</h2>
                        <div class="form-floating">
                            <div class="dropzone dropzone-floating-label" id="fileDewanPersPerusahaan"></div>
                            <label class="ps-4">File PDF Verifikasi Dewan Pers Perusahaan</label>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row mb-4">
                        <h2 class="small-title mb-md-0 mb-2">Afiliasi Organisasi Perusahaan Pers (Perusahaan)
                        </h2>
                        <div class="form-floating">
                            <div class="dropzone dropzone-floating-label" id="fileAfiliasiPerusahaan"></div>
                            <label class="ps-4">File PDF Afiliasi Organisasi Pers</label>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row mb-4">
                        <h2 class="small-title mb-md-0 mb-2">Surat Pernyataan Nama Media dan Domisili</h2>
                        <div class="form-floating">
                            <div class="dropzone dropzone-floating-label" id="fileDomisiliPerusahaan"></div>
                            <label class="ps-4">File PDF Surat Pernyataan Nama Media dan Domisili </label>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row mb-4">
                        <h2 class="small-title">Surat Kuasa Perwakilan Media</h2>
                        <div class="form-floating">
                            <div class="dropzone dropzone-floating-label" id="fileKuasaPerwakilan"></div>
                            <label class="ps-4">File PDF Surat Kuasa Perwakilan Media</label>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row mb-4">
                        <h2 class="small-title mb-md-0 mb-2">Surat Permohonan Kerjasama dan CV Perusahaan</h2>
                        <div class="form-floating">
                            <div class="dropzone dropzone-floating-label" id="fileKerjasama"></div>
                            <label class="ps-4">File PDF Surat Permohonan Kerjasama</label>
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
                                <input id="namaMedia" name="namaMedia" type="text"
                                    class="form-control form-control-sm" placeholder="form-control">
                                <label class="ps-4">Nama Media</label>
                            </div>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row mb-4">
                        <h2 class="small-title">Nama Biro Perwakilan Media</h2>
                        <div class="form-floating">
                            <input id="namaBiroPerwakilan" name="namaBiroPerwakilan" type="text"
                                class="form-control form-control-sm" placeholder="form-control">
                            <label class="ps-4">Nama Biro Perwakilan Media</label>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row mb-4">
                        <h2 class="small-title">Kontak Perwakilan</h2>
                        <div class="col-lg-4 col-md-12 col-12 mb-lg-0 mb-md-2 mb-2">
                            <div class="form-floating">
                                <input id="alamatPerwakilan" name="alamatPerwakilan" type="text"
                                    class="form-control form-control-sm" placeholder="form-control">
                                <label class="ps-4">Alamat Perwakilan</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 mb-md-0 mb-2">
                            <div class="form-floating">
                                <input id="tlpnPerwakilan" name="tlpnPerwakilan" type="text"
                                    class="form-control form-control-sm" placeholder="form-control">
                                <label class="ps-4">No Telpon Perwakilan</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 mb-md-0 mb-2">
                            <div class="form-floating">
                                <input id="emailPerwakilan" name="emailPerwakilan" type="text"
                                    class="form-control form-control-sm" placeholder="form-control">
                                <label class="ps-4">Email Perwakilan</label>
                            </div>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row mb-4">
                        <h2 class="small-title mb-1">KTP Perwakilan</h2>
                        <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                            <div class="form-floating">
                                <input id="ktpPerwakilan" name="ktpPerwakilan" type="text"
                                    class="form-control form-control-sm" placeholder="form-control">
                                <label class="ps-4">No KTP Perwakilan</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                            <div class="form-floating">
                                <div class="dropzone dropzone-floating-label" id="fileKtpPerwakilan"></div>
                                <label class="ps-4">File PDF KTP Perwakilan</label>
                            </div>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row mb-4">
                        <h2 class="small-title mb-1">KK Perwakilan</h2>
                        <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                            <div class="form-floating">
                                <input id="kkPerwakilan" name="kkPerwakilan" type="text"
                                    class="form-control form-control-sm" placeholder="form-control">
                                <label class="ps-4">No KK Perwakilan</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                            <div class="form-floating">
                                <div class="dropzone dropzone-floating-label" id="fileKKPerwakilan"></div>
                                <label class="ps-4">File PDF KK Perwakilan</label>
                            </div>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row mb-4">
                        <h2 class="small-title mb-1">NPWP Perwakilan</h2>
                        <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                            <div class="form-floating">
                                <input id="npwpPerwakilan" name="npwpPerwakilan" type="text"
                                    class="form-control form-control-sm" placeholder="form-control">
                                <label class="ps-4">No NPWP Perwakilan</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                            <div class="form-floating">
                                <div class="dropzone dropzone-floating-label" id="fileNpwpPerwakilan"></div>
                                <label class="ps-4">File PDF NPWP Perwakilan </label>
                            </div>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row mb-4">
                        <h2 class="small-title mb-1">Dokumen Kompetensi Perwakilan Media</h2>
                        <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                            <div class="form-floating">
                                <input id="kompetensiPerwakilan" name="kompetensiPerwakilan" type="text"
                                    class="form-control form-control-sm" placeholder="form-control">
                                <label class="ps-4">Jenis Kompetensi Perwakilan Media</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mb-md-0 mb-2">
                            <div class="form-floating">
                                <div class="dropzone dropzone-floating-label" id="fileKopetensiPerwakilan"></div>
                                <label class="ps-4">File PDF Dokumen Kompetensi Perwakilan Media</label>
                            </div>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row mb-4">
                        <h2 class="small-title mb-1">Afiliasi Organisasi Pers (Organisasi Wartawan)</h2>
                        <div class="form-floating">
                            <div class="dropzone dropzone-floating-label" id="fileAfiliasiPerwakilan"></div>
                            <label class="ps-4">File PDF Afiliasi Organisasi Pers (Organisasi Wartawan) </label>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row mb-4">
                        <h2 class="small-title mb-1">Keterangan Domisili Perwakilan Media</h2>
                        <div class="form-floating">
                            <div class="dropzone dropzone-floating-label" id="fileDomisiliPerwakilan"></div>
                            <label class="ps-4">File PDF Keterangan Domisili Perwakilan Media</label>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row mb-4">
                        <h2 class="small-title mb-1">Surat Pernyataan Mematuhi Kode Etik Jurnalistik</h2>
                        <div class="form-floating">
                            <div class="dropzone dropzone-floating-label" id="fileKodeEtikPerwakilan"></div>
                            <label class="ps-4">File PDF Surat Pernyataan Mematuhi Kode Etik Jurnalistik</label>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row mb-4">
                        <h2 class="small-title">Surat Pernyataan 1 Perusahaan 1 Media</h2>
                        <div class="form-floating">
                            <div class="dropzone dropzone-floating-label" id="filePernyataanMediaPerwakilan"></div>
                            <label class="ps-4">File PDF Surat Pernyataan 1 Perusahaan 1 Media </label>
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

                </section>
            </div>
        </div>

        <div class="h3 text-primary">Signature/Tanda Tangan</div>
        <div class="card mb-5">
            <div class="card-body">
                <section class="scroll-section" id="breakpointSpecificResponsive">
                    <div class="container">
                        <h2 class="small-title">Tanda Tangan Disni</h2>
                        <div class="d-flex justify-content-center mb-2">
                            <canvas id="signature-pad" style="width: 300px; height: 200px;"
                                class="border signature-pad "></canvas>
                        </div>
                        <input id="signatureData" type="text" value="" hidden>
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
                            <input class="form-check-input" type="checkbox" value="" id="pernyataanCheckbox"
                                name="pernyataanCheckbox">
                            <label class="form-check-label" for="invalidCheck">
                                Dengan ini saya menyetujui seluruh persyaratan yang berlaku dan tanda tangan digital
                                yang saya buat pada form ini dapat digunakan sebagai tanda tangan resmi. Data yang saya
                                isi adalah sebenar-benarnya, jika ada pemalsuan data yang ditemukan maka saya siap
                                bertanggungjawab dan menerima konsekuensi sesuai dengan hukum yang berlaku.
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

<script>
    /**
     *
     * File UploadDropzone and send data
     *
     **/
    $(document).ready(function() {
        //=== PERUSAHAAN ====//

        if ($('#jenisPengajuan').val() == 'elektronik') {
            // fileIzinIpp
            var dropzoneNpwpPerusahaan = new Dropzone('#fileIzinIpp', {
                url: '/pengajuan/uploads',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                init: function() {
                    var param = 'fileIzinIpp';
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
                dictDefaultMessage: 'Uploads Disini',
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
            dictDefaultMessage: 'Uploads Disini',
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

        // fileKumham
        var dropzoneKumhamPerusahaan = new Dropzone('#fileKumhamPerusahaan', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileKumhamPerusahaan';
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

        // fileWartawanKompetenPerusahaan
        var dropzoneWartawanKompetenPerusahaan = new Dropzone('#fileWartawanKompetenPerusahaan', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileWartawanKompetenPerusahaan';
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

        // fileAfiliasiPerusahaan
        var dropzoneAfiliasiPerusahaan = new Dropzone('#fileAfiliasiPerusahaan', {
            url: '/pengajuan/uploads',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            init: function() {
                var param = 'fileAfiliasiPerusahaan';
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
            dictDefaultMessage: 'Uploads Disini',
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
            dictDefaultMessage: 'Uploads Disini',
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
            dictDefaultMessage: 'Uploads Disini',
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
            dictDefaultMessage: 'Uploads Disini',
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
            dictDefaultMessage: 'Uploads Disini',
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
            dictDefaultMessage: 'Uploads Disini',
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
            dictDefaultMessage: 'Uploads Disini',
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
            dictDefaultMessage: 'Uploads Disini',
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
            dictDefaultMessage: 'Uploads Disini',
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
            dictDefaultMessage: 'Uploads Disini',
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
            dictDefaultMessage: 'Uploads Disini',
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
            dictDefaultMessage: 'Uploads Disini',
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
            dictDefaultMessage: 'Uploads Disini',
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
                    title: 'Tanda Tangan',
                    text: 'Tanda Tangan Harap diisi',
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
            minimumResultsForSearch: Infinity,
            placeholder: ''
        });
    });

    /**
     * validator
     **/
    $(document).ready(function() {
        // method validasi
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

        jQuery(".validasi").validate({
            rules: {
                namaPerusahaan: {
                    required: true,
                    lettersonly: true,
                },
                namaPimred: {
                    required: true,
                    lettersonly: true,
                    minlength: 3,
                },
                alamatPerusahaan: {
                    required: true,
                    minlength: 5,
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
                npwpPerusahaan: {
                    required: true,
                    minlength: 15,
                },
                aktaPerusahaan: {
                    required: true,
                    number: true,
                },
                kumhamPerusahaan: {
                    required: true,
                },
                wartawanKompetenPerusahaan: {
                    required: true,
                    number: true
                },
                // opsional harian
                namaPercetakan: {
                    required: true,
                    minlength: 5,
                },
                alamatPercetakan: {
                    required: true,
                    minlength: 5,
                },
                // perwakilan
                namaMedia: {
                    required: true,
                    remote: dataNamaMedia,
                },
                namaBiroPerwakilan: {
                    required: true,
                    lettersonly: true,
                    minlength: 3,
                },
                alamatPerwakilan: {
                    required: true,
                    minlength: 3,
                },
                tlpnPerwakilan: {
                    required: true,
                    number: true,
                    minlength: 11,
                },
                emailPerwakilan: {
                    required: true,
                    email: true,
                },
                ktpPerwakilan: {
                    required: true,
                    number: true,
                    nospace: true,
                    // minlength: 16
                },
                kkPerwakilan: {
                    required: true,
                    number: true,
                    nospace: true,
                    // minlength: 16
                },
                npwpPerwakilan: {
                    required: true,
                    minlength: 15,
                },
                kompetensiPerwakilan: {
                    required: true,
                },
                jenisRekening: {
                    required: true,
                },
                namaBank: {
                    required: true,
                    minlength: 3,
                },
                pemilikRekening: {
                    required: true,
                    lettersonly: true,
                },
                noRekening: {
                    required: true,
                    number: true,
                },
                pernyataanCheckbox: {
                    required: true,
                },
            },
            messages: {
                namaMedia: {
                    remote: "Domain media tidak terregister, tidak ada SSL, cek kembali nama domain anda",
                },
            },
            onkeyup: false,
        })
    });
</script>
