@php
    $record = $record ?? null;
    $media_jenis = $media_jenis ?? null;
    $readonly = $readonly ?? false;
    $verify = $verify ?? false;
    $value = function ($key, $default = '') use ($record, $readonly, $media_jenis) {
        $stored = $record?->$key ?? ($key === 'jenis_media' ? ($media_jenis ?? $default) : $default);
        return $readonly ? $stored : old($key, $stored);
    };
    $isElectronic = strtolower((string) $value('jenis_media')) === 'elektronik';
    $disabled = $readonly ? 'disabled' : '';
    $wartawanOptions = ['PWI', 'AJI', 'IJTI', 'PFI'];
    $perusahaanPersOptions = ['JMSI', 'SMSI', 'AMSI', 'PRSSNI', 'ATVLI', 'ATVSI', 'SPS'];
    $wartawanCurrent = $value('organisasiWartawan');
    $perusahaanPersCurrent = $value('organisasiPerusahaanPers');
    $wartawanChoice = in_array(strtoupper($wartawanCurrent), $wartawanOptions, true) ? strtoupper($wartawanCurrent) : ($wartawanCurrent ? 'lainnya' : '');
    $perusahaanPersChoice = in_array(strtoupper($perusahaanPersCurrent), $perusahaanPersOptions, true) ? strtoupper($perusahaanPersCurrent) : ($perusahaanPersCurrent ? 'lainnya' : '');
    $wartawanLainnya = $wartawanChoice === 'lainnya' ? $wartawanCurrent : old('organisasiWartawanLainnya', '');
    $perusahaanPersLainnya = $perusahaanPersChoice === 'lainnya' ? $perusahaanPersCurrent : old('organisasiPerusahaanPersLainnya', '');
    $document = function ($field, $folder) use ($record) {
        $filename = $record?->$field;
        return '<span data-review-document="' . e($field) . '">' . ($filename ? '<a class="btn btn-sm btn-outline-primary" target="_blank" href="' . route('dokumen.show', ['folder' => $folder, 'filename' => $filename]) . '">Lihat dokumen</a>' : '<span class="text-danger small">Dokumen belum tersedia</span>') . '</span>';
    };
@endphp
<section class="scroll-section">
    <div class="card wizard mb-3" id="wizardBasic1">
        <div class="card-header border-0 pb-0">
            <ul class="nav nav-tabs justify-content-center" role="tablist">
                <li class="nav-item"><a id="perusahaanPersTab" class="nav-link active text-center" data-bs-toggle="tab" href="#perusahaanPers"><div class="mb-1 title d-none d-sm-block">PERUSAHAAN PERS</div></a></li>
                <li class="nav-item"><a id="perwakilanMediaTab" class="nav-link text-center" data-bs-toggle="tab" href="#perwakilanMedia"><div class="mb-1 title d-none d-sm-block">PERWAKILAN MEDIA</div></a></li>
            </ul>
        </div>
        <div class="card-body">
            <form id="pengajuanDuaStep" novalidate>
                @if($record)<input type="hidden" name="pengajuan_no" value="{{ $record->pengajuan_no }}">@endif
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="perusahaanPers">
                        <h5 class="card-title">Perusahaan Pers</h5>
                        @if($verify)<label class="form-check mb-3"><input class="form-check-input verification-check" type="checkbox" value="Perusahaan Pers" checked> Verifikasi Perusahaan Pers</label>@endif
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Media</label>
                                <input class="form-control media-name title-case"
                                name="namaMedia" 
                                value="{{ $value('namaMedia') }}" {{ $disabled }} 
                                required>
                            </div>
                            <input type="hidden" name="jenis_media" value="{{ $value('jenis_media') }}">
                            <div class="col-md-6">
                                <label class="form-label">Nama Perusahaan Pers</label>
                                <input class="form-control title-case" name="namaPerusahaan" value="{{ $value('namaPerusahaan') }}" {{ $disabled }} required>
                            </div>
                            @if($isElectronic)
                                <div class="col-md-6 electronic-only">
                                    <label class="form-label">Jenis Siaran Elektronik</label>
                                    <select class="form-select" name="subjenis_elektronik" {{ $disabled }}>
                                        <option value="">Pilih TV/Radio</option>
                                        <option value="televisi" @selected($value('jenisJangkauanSiarMediaElektronik') === 'televisi')>Televisi</option>
                                        <option value="radio" @selected($value('jenisJangkauanSiarMediaElektronik') === 'radio')>Radio</option>
                                    </select>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <label class="form-label">No. NIB</label>
                                <div class="input-group">
                                    <input class="form-control" name="nibPerusahaan" value="{{ $value('nibPerusahaan') }}" {{ $disabled }} required>
                                    @if($readonly)
                                        {!! $document('fileNibPerusahaan', 'filenibperusahaan') !!}
                                    @else
                                        <input class="form-control document-upload" type="file" accept=".png,.jpg,.jpeg,.pdf,image/png,image/jpeg,application/pdf" data-target="fileNibPerusahaan" @if($value('fileNibPerusahaan') === '') required @endif>
                                        <input type="hidden" name="fileNibPerusahaan" value="{{ $value('fileNibPerusahaan') }}">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. AHU</label>
                                <div class="input-group">
                                    <input class="form-control" name="kumhamPerusahaan" value="{{ $value('kumhamPerusahaan') }}" {{ $disabled }} required>
                                    @if($readonly)
                                        {!! $document('fileKumhamPerusahaan', 'filekumhamperusahaan') !!}
                                    @else
                                        <input class="form-control document-upload" type="file" accept=".png,.jpg,.jpeg,.pdf,image/png,image/jpeg,application/pdf" data-target="fileKumhamPerusahaan" @if($value('fileKumhamPerusahaan') === '') required @endif>
                                        <input type="hidden" name="fileKumhamPerusahaan" value="{{ $value('fileKumhamPerusahaan') }}">
                                    @endif
                                </div>
                            </div>
                            @if($isElectronic)
                                <div class="col-md-6 electronic-only">
                                    <label class="form-label">No. IPP</label>
                                    <div class="input-group">
                                        <input class="form-control" name="izinIpp" value="{{ $value('izinIpp') }}" {{ $disabled }}>
                                        @if($readonly)
                                            {!! $document('fileIzinIpp', 'fileizinipp') !!}
                                        @else
                                            <input class="form-control document-upload" type="file" accept=".png,.jpg,.jpeg,.pdf,image/png,image/jpeg,application/pdf" data-target="fileIzinIpp">
                                            <input type="hidden" name="fileIzinIpp" value="{{ $value('fileIzinIpp') }}">
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <label class="form-label">NPWP</label>
                                <div class="input-group">
                                    <input class="form-control" name="npwpPerusahaan" value="{{ $value('npwpPerusahaan') }}" {{ $disabled }} required>
                                    @if($readonly)
                                        {!! $document('fileNpwpPerusahaan', 'filenpwpperusahaan') !!}
                                    @else
                                        <input class="form-control document-upload" type="file" accept=".png,.jpg,.jpeg,.pdf,image/png,image/jpeg,application/pdf" data-target="fileNpwpPerusahaan" @if($value('fileNpwpPerusahaan') === '') required @endif>
                                        <input type="hidden" name="fileNpwpPerusahaan" value="{{ $value('fileNpwpPerusahaan') }}">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status Perusahaan Pers</label>
                                <select class="form-select" name="verifikasiDewanPers" {{ $disabled }} required>
                                    <option value="">Pilih status perusahaan pers</option>
                                    <option value="terdata" @selected($value('verifikasiDewanPers') === 'terdata')>Terdata</option>
                                    <option value="terverifikasi administrasi" @selected($value('verifikasiDewanPers') === 'terverifikasi administrasi')>Terverifikasi Administrasi</option>
                                    <option value="terverifikasi faktual" @selected($value('verifikasiDewanPers') === 'terverifikasi faktual')>Terverifikasi Faktual</option>
                                    <option value="belum terdata" @selected($value('verifikasiDewanPers') === 'belum terdata')>Belum Terdata</option>
                                </select>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-4">
                                <label class="form-label">Nama Pimpinan Redaksi</label>
                                <input class="form-control title-case" name="namaPimred" value="{{ $value('namaPimred') }}" {{ $disabled }} required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">No. Sertifikat Kompetensi Pimred</label>
                                <input class="form-control" name="serfikatUkwPimred" value="{{ $value('serfikatUkwPimred') }}" {{ $disabled }} required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Nama Pimpinan Perusahaan</label>
                                <input class="form-control title-case" name="namaPimprus" value="{{ $value('namaPimprus') }}" @if($readonly && blank($value('namaPimprus'))) placeholder="Data belum tersedia" @endif {{ $disabled }} required>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-4">
                                <label class="form-label">Kompetensi Pimred</label>
                                <select class="form-select" name="jenisSerfikatUkwPimred" {{ $disabled }} required>
                                    <option value="">Pilih kompetensi pimred</option>
                                    <option value="madya" @selected($value('jenisSerfikatUkwPimred') === 'madya')>Madya</option>
                                    <option value="utama" @selected($value('jenisSerfikatUkwPimred') === 'utama')>Utama</option>
                                </select>
                            </div>
                            <div class="col-md-4 document-field madya-only">
                                <label class="form-label">Surat Pernyataan (PNG, JPG, PDF)</label>
                                <div class="form-text mb-2">Sertakan surat pernyataan kesanggupan memenuhi persyaratan.</div>
                                @if($readonly)
                                    {!! $document('fileSuratPernyataanPimred', 'filesuratpernyataanpimred') !!}
                                @else
                                    <input class="form-control document-upload" type="file" accept=".png,.jpg,.jpeg,.pdf,image/png,image/jpeg,application/pdf" data-target="fileSuratPernyataanPimred" data-validation-message="Belum upload file Surat Pernyataan.">
                                    <input type="hidden" name="fileSuratPernyataanPimred" value="{{ $value('fileSuratPernyataanPimred') }}">
                                @endif
                            </div>
                            <div class="col-md-4 document-field"><label class="form-label">Sertifikat Kompetensi Dewan Pers Pimred (PNG, JPG, PDF)</label>@if($readonly){!! $document('fileSerfikatUkwPimred', 'fileserfikatukwpimred') !!}@else<input class="form-control document-upload" type="file" accept=".png,.jpg,.jpeg,.pdf,image/png,image/jpeg,application/pdf" data-target="fileSerfikatUkwPimred" @if($value('fileSerfikatUkwPimred') === '') required @endif><input type="hidden" name="fileSerfikatUkwPimred" value="{{ $value('fileSerfikatUkwPimred') }}">@endif</div>
                            <div class="col-md-6">
                                <label class="form-label" for="noKlbi">KBLI</label>
                                <input id="noKlbi" class="form-control skip-duplicate-check" name="noKlbi" value="{{ $value('noKlbi') }}" placeholder="Pilih KBLI" {{ $disabled }} required>
                                @unless($readonly)
                                    <div class="form-text">Masukkan satu atau lebih kode, lalu tekan Enter atau koma.</div>
                                @endunless
                            </div>
                            @unless($readonly)
                                <div class="col-md-6 d-flex align-items-end">
                                    <div class="alert alert-warning mb-0 w-100 small" role="alert">
                                        Jika No. KBLI belum sesuai, harap segera melakukan pembaruan No. KBLI menyesuaikan dengan Surat Edaran Dewan Pers terbaru Nomor 01/SE/DP/VIII/2026.
                                    </div>
                                </div>
                            @endunless
                            <div class="col-12"><label class="form-label">Alamat Perusahaan Pers</label><input class="form-control title-case skip-duplicate-check" name="alamatPerusahaan" value="{{ $value('alamatPerusahaan') }}" {{ $disabled }} required></div>
                            <div class="col-md-4">
                                <label class="form-label">Kecamatan</label>
                                <input class="form-control title-case skip-duplicate-check"
                                name="alamatKecPerusahaan" value="{{ $value('alamatKecPerusahaan') }}" @if($readonly && blank($value('alamatKecPerusahaan'))) placeholder="Data belum tersedia" @endif {{ $disabled }} required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kabupaten/Kota</label>
                                <input 
                                class="form-control title-case skip-duplicate-check"
                                name="alamatKabPerusahaan" 
                                value="{{ $value('alamatKabPerusahaan') }}" {{ $disabled }} required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Provinsi</label>
                                <input class="form-control title-case skip-duplicate-check"
                                name="alamatProvPerusahaan" 
                                value="{{ $value('alamatProvPerusahaan') }}" {{ $disabled }} required>
                                </div>
                            <div class="col-md-6">
                                <label class="form-label">No. Telepon Redaksi</label>
                                <input class="form-control" name="tlpnPerusahaan" value="{{ $value('tlpnPerusahaan') }}" {{ $disabled }} required></div>
                            <div class="col-md-6">
                                <label class="form-label">Alamat Email Redaksi</label>
                                <input type="email" class="form-control" name="emailPerusahaan" value="{{ $value('emailPerusahaan') }}" {{ $disabled }} required>
                            </div>
                            <div class="col-12 website-field">
                                <label class="form-label">Link Website</label>
                                <input type="url" class="form-control" name="alamatWebsite" value="{{ $value('alamatWebsite') }}" placeholder="https://contoh.com" {{ $disabled }}>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Link YouTube</label>
                                <input type="url" class="form-control" name="linkYoutube" value="{{ $value('linkYoutube') }}" placeholder="https://youtube.com/@namakanal" {{ $disabled }}>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Link Facebook</label>
                                <input type="url" class="form-control" name="linkFacebook" value="{{ $value('linkFacebook') }}" placeholder="https://facebook.com/namahalaman" {{ $disabled }}>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Link Instagram</label>
                                <input type="url" class="form-control" name="linkInstagram" value="{{ $value('linkInstagram') }}" placeholder="https://instagram.com/namaakun" {{ $disabled }}>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Link TikTok</label>
                                <input type="url" class="form-control" name="linkTiktok" value="{{ $value('linkTiktok') }}" placeholder="https://tiktok.com/@namaakun" {{ $disabled }}>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Link Threads</label>
                                <input type="url" class="form-control" name="linkThreads" value="{{ $value('linkThreads') }}" placeholder="https://threads.net/@namaakun" {{ $disabled }}>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Link X</label>
                                <input type="url" class="form-control" name="linkX" value="{{ $value('linkX') }}" placeholder="https://x.com/namaakun" {{ $disabled }}>
                            </div>
                            <div class="col-md-6 print-only">
                                <label class="form-label">Nama Perusahaan Percetakan</label>
                                <input class="form-control title-case" name="namaPercetakan" value="{{ $value('namaPercetakan') }}" {{ $disabled }}>
                            </div>
                            <div class="col-md-6 print-only">
                                <label class="form-label">Alamat Perusahaan Percetakan</label>
                                <input class="form-control title-case skip-duplicate-check" name="alamatPercetakan" value="{{ $value('alamatPercetakan') }}" {{ $disabled }}>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-4 pt-3 border-top">
                            <button type="button" class="btn btn-primary px-4 next-tab" data-next-tab="#perwakilanMediaTab">
                                Next
                            </button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="perwakilanMedia">
                        <h5 class="card-title">Perwakilan Media</h5>
                        @if($verify)<label class="form-check mb-3"><input class="form-check-input verification-check" type="checkbox" value="Perwakilan Media" checked> Verifikasi Perwakilan Media</label>@endif
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Kepala Biro/Wartawan Perwakilan</label>
                                <input class="form-control title-case" name="namaPerwakilan" value="{{ $value('namaPerwakilan') }}" {{ $disabled }} required>
                                <label class="form-label mt-2">Surat Keterangan sebagai Kepala Biro/Wartawan Perwakilan (PNG, JPG, atau PDF)</label>
                                @if($readonly)
                                    {!! $document('fileSuratKeteranganWartawan', 'filesuratketeranganwartawan') !!}
                                @else
                                    <input class="form-control document-upload" type="file" accept=".png,.jpg,.jpeg,.pdf,image/png,image/jpeg,application/pdf" data-target="fileSuratKeteranganWartawan" data-validation-message="Belum upload file Surat Keterangan sebagai Kepala Biro/Wartawan Perwakilan." @if($value('fileSuratKeteranganWartawan') === '') required @endif>
                                    <input type="hidden" name="fileSuratKeteranganWartawan" value="{{ $value('fileSuratKeteranganWartawan') }}">
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. Sertifikat Kompetensi</label>
                                <input class="form-control" name="serfikatUkwPerwakilan" value="{{ $value('serfikatUkwPerwakilan') }}" {{ $disabled }}>
                                <label class="form-label mt-2">Kompetensi Kepala Biro/Wartawan Perwakilan</label>
                                <select class="form-select" name="jenisSerfikatUkwPerwakilan" {{ $disabled }}>
                                    <option value="">Pilih kompetensi</option>
                                    <option value="muda" @selected($value('jenisSerfikatUkwPerwakilan') === 'muda')>Muda</option>
                                    <option value="madya" @selected($value('jenisSerfikatUkwPerwakilan') === 'madya')>Madya</option>
                                    <option value="utama" @selected($value('jenisSerfikatUkwPerwakilan') === 'utama')>Utama</option>
                                    <option value="belum ada sertifikat" @selected($value('jenisSerfikatUkwPerwakilan') === 'belum ada sertifikat')>Belum Ada Sertifikat</option>
                                </select>
                                <label class="form-label mt-2">Sertifikat Kompetensi Kepala Biro/Wartawan Perwakilan (PNG, JPG, atau PDF)</label>
                                @if($readonly)
                                    {!! $document('fileSerfikatUkwPerwakilan', 'fileserfikatukwperwakilan') !!}
                                @else
                                    <input class="form-control document-upload" type="file" accept=".png,.jpg,.jpeg,.pdf,image/png,image/jpeg,application/pdf" data-target="fileSerfikatUkwPerwakilan">
                                    <input type="hidden" name="fileSerfikatUkwPerwakilan" value="{{ $value('fileSerfikatUkwPerwakilan') }}">
                                @endif
                            </div>
                            <div class="col-12">
                                <label class="form-label">Alamat Domisili Kepala Biro/Wartawan Perwakilan</label>
                                <input class="form-control title-case skip-duplicate-check"
                                name="alamatPerwakilan" 
                                value="{{ $value('alamatPerwakilan') }}" 
                                {{ $disabled }}>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kecamatan</label>
                                <input class="form-control title-case skip-duplicate-check" name="alamatKecPerwakilan" value="{{ $value('alamatKecPerwakilan') }}" @if($readonly && blank($value('alamatKecPerwakilan'))) placeholder="Data belum tersedia" @endif {{ $disabled }} required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kabupaten/Kota</label>
                                <input class="form-control title-case skip-duplicate-check" name="alamatKabPerwakilan" value="{{ $value('alamatKabPerwakilan') }}" {{ $disabled }} required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Provinsi</label>
                                <input class="form-control title-case skip-duplicate-check" name="alamatProvPerwakilan" value="{{ $value('alamatProvPerwakilan') }}" {{ $disabled }} required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">NPWP Kepala Biro/Wartawan Perwakilan</label>
                                <div class="input-group">
                                    <input class="form-control" name="npwpPerwakilan" value="{{ $value('npwpPerwakilan') }}" {{ $disabled }} required>
                                    @if($readonly)
                                        {!! $document('fileNpwpPerwakilan', 'filenpwpperwakilan') !!}
                                    @else
                                        <input class="form-control document-upload" type="file" accept=".png,.jpg,.jpeg,.pdf,image/png,image/jpeg,application/pdf" data-target="fileNpwpPerwakilan" data-validation-message="Belum upload file NPWP Kepala Biro/Wartawan Perwakilan." @if($value('fileNpwpPerwakilan') === '') required @endif>
                                        <input type="hidden" name="fileNpwpPerwakilan" value="{{ $value('fileNpwpPerwakilan') }}">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label d-block">Organisasi Wartawan</label>
                                <div class="d-flex flex-wrap gap-3">
                                    @foreach($wartawanOptions as $item)
                                        <label class="form-check">
                                            <input class="form-check-input" type="radio" name="organisasiWartawan" value="{{ $item }}" data-organization="organisasiWartawan" @checked($wartawanChoice === $item) {{ $disabled }}>
                                            <span class="form-check-label">{{ $item }}</span>
                                        </label>
                                    @endforeach
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" name="organisasiWartawan" value="lainnya" data-organization="organisasiWartawan" @checked($wartawanChoice === 'lainnya') {{ $disabled }}>
                                        <span class="form-check-label">Lainnya</span>
                                    </label>
                                </div>
                                <input class="form-control mt-2 organization-other title-case" name="organisasiWartawanLainnya" data-for="organisasiWartawan" value="{{ $wartawanLainnya }}" placeholder="Tulis organisasi wartawan lainnya" {{ $disabled }} @disabled(!$readonly && $wartawanChoice !== 'lainnya')>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label d-block">Organisasi Perusahaan Pers</label>
                                <div class="d-flex flex-wrap gap-3">
                                    @foreach($perusahaanPersOptions as $item)
                                        <label class="form-check">
                                            <input class="form-check-input" type="radio" name="organisasiPerusahaanPers" value="{{ $item }}" data-organization="organisasiPerusahaanPers" @checked($perusahaanPersChoice === $item) {{ $disabled }}>
                                            <span class="form-check-label">{{ $item }}</span>
                                        </label>
                                    @endforeach
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" name="organisasiPerusahaanPers" value="lainnya" data-organization="organisasiPerusahaanPers" @checked($perusahaanPersChoice === 'lainnya') {{ $disabled }}>
                                        <span class="form-check-label">Lainnya</span>
                                    </label>
                                </div>
                                <input class="form-control mt-2 organization-other title-case" name="organisasiPerusahaanPersLainnya" data-for="organisasiPerusahaanPers" value="{{ $perusahaanPersLainnya }}" placeholder="Tulis organisasi perusahaan pers lainnya" {{ $disabled }} @disabled(!$readonly && $perusahaanPersChoice !== 'lainnya')>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6 document-field"><label class="form-label">Bukti Keanggotaan Organisasi Wartawan (PNG, JPG, atau PDF)</label>@if($readonly){!! $document('fileBuktiKeanggotaanOrganisasiWartawan', 'filebuktikeanggotaanorganisasiwartawan') !!}@else<input class="form-control document-upload" type="file" accept=".png,.jpg,.jpeg,.pdf,image/png,image/jpeg,application/pdf" data-target="fileBuktiKeanggotaanOrganisasiWartawan"><input type="hidden" name="fileBuktiKeanggotaanOrganisasiWartawan" value="{{ $value('fileBuktiKeanggotaanOrganisasiWartawan') }}">@endif</div>
                            <div class="col-md-6 document-field"><label class="form-label">Bukti Keanggotaan Organisasi Perusahaan Pers (PNG, JPG, atau PDF)</label>@if($readonly){!! $document('fileBuktiKeanggotaanOrganisasiPerusahaanPers', 'filebuktikeanggotaanorganisasiperusahaanpers') !!}@else<input class="form-control document-upload" type="file" accept=".png,.jpg,.jpeg,.pdf,image/png,image/jpeg,application/pdf" data-target="fileBuktiKeanggotaanOrganisasiPerusahaanPers"><input type="hidden" name="fileBuktiKeanggotaanOrganisasiPerusahaanPers" value="{{ $value('fileBuktiKeanggotaanOrganisasiPerusahaanPers') }}">@endif</div>
                        </div>
                        <div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">
                            <button type="button" class="btn btn-outline-secondary px-4" onclick="document.getElementById('perusahaanPersTab').click()">
                                Previous
                            </button>
                            @unless($readonly)
                                <button type="submit" class="btn btn-primary px-4">
                                    {{ $record ? 'Simpan Perubahan' : 'Kirim Pengajuan' }}
                                </button>
                            @endunless
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
