@php
    $record = $record ?? null;
    $readonly = $readonly ?? false;
    $verify = $verify ?? false;
    $value = fn ($key, $default = '') => old($key, $record?->$key ?? ($key === 'jenis_media' ? ($media_jenis ?? $default) : $default));
    $disabled = $readonly ? 'disabled' : '';
    $wartawanOptions = ['PWI', 'AJI', 'IJTI', 'PFI'];
    $perusahaanPersOptions = ['JMSI', 'SMSI', 'AMSI', 'PRSSNI', 'ATVLI', 'ATVSI', 'SPS'];
    $wartawanCurrent = $value('organisasiWartawan');
    $perusahaanPersCurrent = $value('organisasiPerusahaanPers');
    $wartawanChoice = in_array(strtoupper($wartawanCurrent), $wartawanOptions, true) ? strtoupper($wartawanCurrent) : ($wartawanCurrent ? 'lainnya' : '');
    $perusahaanPersChoice = in_array(strtoupper($perusahaanPersCurrent), $perusahaanPersOptions, true) ? strtoupper($perusahaanPersCurrent) : ($perusahaanPersCurrent ? 'lainnya' : '');
    $wartawanLainnya = $wartawanChoice === 'lainnya' ? $wartawanCurrent : old('organisasiWartawanLainnya', '');
    $perusahaanPersLainnya = $perusahaanPersChoice === 'lainnya' ? $perusahaanPersCurrent : old('organisasiPerusahaanPersLainnya', '');
    $kbliOptions = [
        '58120' => ['Penerbitan Surat Kabar', 'siber,cetak,elektronik', null],
        '58130' => ['Penerbitan Jurnal dan Penerbitan Berkala', 'siber,cetak,elektronik', null],
        '60101' => ['Radio Analog', 'elektronik', 'radio'],
        '60102' => ['Radio Digital', 'elektronik', 'radio'],
        '60202' => ['Televisi Digital', 'elektronik', 'televisi'],
        '60311' => ['Aktivitas Kantor Berita oleh Pemerintah', 'siber,cetak,elektronik', null],
        '60312' => ['Aktivitas Kantor Berita oleh Swasta', 'siber,cetak,elektronik', null],
    ];
    $kbliCurrent = preg_replace('/^kbli\s*/i', '', trim((string) $value('noKlbi')));
    $document = function ($field, $folder) use ($record) {
        $filename = $record?->$field;
        return $filename ? '<a class="btn btn-sm btn-outline-primary" target="_blank" href="' . route('dokumen.show', ['folder' => $folder, 'filename' => $filename]) . '">Lihat dokumen</a>' : '<span class="text-danger small">Dokumen belum tersedia</span>';
    };
@endphp
<section class="scroll-section">
    <div class="card wizard mb-3" id="wizardBasic1">
        <div class="card-header border-0 pb-0">
            <ul class="nav nav-tabs justify-content-center" role="tablist">
                <li class="nav-item"><a class="nav-link active text-center" data-bs-toggle="tab" href="#perusahaanPers"><div class="mb-1 title d-none d-sm-block">PERUSAHAAN PERS</div></a></li>
                <li class="nav-item"><a class="nav-link text-center" data-bs-toggle="tab" href="#perwakilanMedia"><div class="mb-1 title d-none d-sm-block">PERWAKILAN MEDIA</div></a></li>
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
                                <input class="form-control media-name" 
                                name="namaMedia" 
                                value="{{ $value('namaMedia') }}" {{ $disabled }} 
                                required>
                            </div>
                            <input type="hidden" name="jenis_media" value="{{ $value('jenis_media') }}">
                            <div class="col-md-6">
                                <label class="form-label">Nama Perusahaan Pers</label>
                                <input class="form-control" name="namaPerusahaan" value="{{ $value('namaPerusahaan') }}" {{ $disabled }} required>
                            </div>
                            <div class="col-md-6 print-only">
                                <label class="form-label">Nama Perusahaan Percetakan</label>
                                <input class="form-control" name="namaPercetakan" value="{{ $value('namaPercetakan') }}" {{ $disabled }}>
                            </div>
                            <div class="col-md-6 print-only">
                                <label class="form-label">Alamat Perusahaan Percetakan</label>
                                <input class="form-control" name="alamatPercetakan" value="{{ $value('alamatPercetakan') }}" {{ $disabled }}>
                            </div>
                            <div class="col-md-6 electronic-only">
                                <label class="form-label">Jenis Siaran Elektronik</label>
                                <select class="form-select" name="subjenis_elektronik" {{ $disabled }}>
                                    <option value="">Pilih TV/Radio</option>
                                    <option value="televisi" @selected($value('jenisJangkauanSiarMediaElektronik') === 'televisi')>Televisi</option>
                                    <option value="radio" @selected($value('jenisJangkauanSiarMediaElektronik') === 'radio')>Radio</option>
                                </select>
                            </div>
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
                            <div class="col-md-6 electronic-only">
                                <label class="form-label">No. IPP</label>
                                <input class="form-control" name="izinIpp" value="{{ $value('izinIpp') }}" {{ $disabled }}>
                            </div>
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
                                    <option value="terverifikasi faktual" @selected($value('verifikasiDewanPers') === 'terverifikasi faktual')>Terverifikasi Faktual</option>
                                    <option value="belum terverifikasi faktual" @selected($value('verifikasiDewanPers') === 'belum terverifikasi faktual')>Belum Terverifikasi Faktual</option>
                                </select>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-4">
                                <label class="form-label">Nama Pimpinan Redaksi</label>
                                <input class="form-control" name="namaPimred" value="{{ $value('namaPimred') }}" {{ $disabled }} required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">No. Sertifikat Kompetensi Pimred</label>
                                <input class="form-control" name="serfikatUkwPimred" value="{{ $value('serfikatUkwPimred') }}" {{ $disabled }} required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Nama Pimpinan Perusahaan</label>
                                <input class="form-control" name="namaPimprus" value="{{ $value('namaPimprus') }}" {{ $disabled }} required>
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
                            @foreach ([
                                ['fileSerfikatUkwPimred','Sertifikat Kompetensi Dewan Pers Pimred','fileserfikatukwpimred'],
                                ['fileSuratPernyataanPimred','Surat Pernyataan Bermaterai Pimred','filesuratpernyataanpimred'],
                            ] as [$field,$label,$folder])
                                <div class="col-md-4 document-field"><label class="form-label">{{ $label }} (PNG, JPG, PDF)</label>@if($readonly){!! $document($field, $folder) !!}@else<input class="form-control document-upload" type="file" accept=".png,.jpg,.jpeg,.pdf,image/png,image/jpeg,application/pdf" data-target="{{ $field }}" @if($value($field) === '') required @endif><input type="hidden" name="{{ $field }}" value="{{ $value($field) }}">@endif</div>
                            @endforeach
                            <div class="col-md-6">
                                <label class="form-label">KBLI</label>
                                <select class="form-select" name="noKlbi" {{ $disabled }} required>
                                    <option value="">Pilih KBLI 2025</option>
                                    @if($kbliCurrent && !array_key_exists($kbliCurrent, $kbliOptions))
                                        <option value="{{ $kbliCurrent }}" data-kbli-legacy selected>{{ $kbliCurrent }} — kode lama/tidak sesuai</option>
                                    @endif
                                    @foreach($kbliOptions as $code => [$description, $mediaTypes, $subtype])
                                        <option value="{{ $code }}" data-kbli-option data-media="{{ $mediaTypes }}" @if(isset($subtype)) data-subjenis="{{ $subtype }}" @endif @selected($kbliCurrent === $code)>{{ $code }} — {{ $description }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12"><label class="form-label">Alamat Perusahaan Pers</label><input class="form-control" name="alamatPerusahaan" value="{{ $value('alamatPerusahaan') }}" {{ $disabled }} required></div>
                            <div class="col-md-4">
                                <label class="form-label">Kecamatan</label>
                                <input class="form-control" 
                                name="alamatKecPerusahaan" value="{{ $value('alamatKecPerusahaan') }}" {{ $disabled }} required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kabupaten/Kota</label>
                                <input 
                                class="form-control" 
                                name="alamatKabPerusahaan" 
                                value="{{ $value('alamatKabPerusahaan') }}" {{ $disabled }} required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Provinsi</label>
                                <input class="form-control" 
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
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6 document-field electronic-only"><label class="form-label">IPP dari Kemenkomdigi (PNG, JPG, atau PDF)</label>@if($readonly){!! $document('fileIzinIpp','fileizinipp') !!}@else<input class="form-control document-upload" type="file" accept=".png,.jpg,.jpeg,.pdf,image/png,image/jpeg,application/pdf" data-target="fileIzinIpp"><input type="hidden" name="fileIzinIpp" value="{{ $value('fileIzinIpp') }}">@endif</div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="perwakilanMedia">
                        <h5 class="card-title">Perwakilan Media</h5>
                        @if($verify)<label class="form-check mb-3"><input class="form-check-input verification-check" type="checkbox" value="Perwakilan Media" checked> Verifikasi Perwakilan Media</label>@endif
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Kepala Biro/Wartawan Perwakilan</label>
                                <input class="form-control" name="namaPerwakilan" value="{{ $value('namaPerwakilan') }}" {{ $disabled }} required>
                                <label class="form-label mt-2">Surat Keterangan sebagai Kepala Biro/Wartawan Perwakilan (PNG, JPG, atau PDF)</label>
                                @if($readonly)
                                    {!! $document('fileSuratKeteranganWartawan', 'filesuratketeranganwartawan') !!}
                                @else
                                    <input class="form-control document-upload" type="file" accept=".png,.jpg,.jpeg,.pdf,image/png,image/jpeg,application/pdf" data-target="fileSuratKeteranganWartawan" @if($value('fileSuratKeteranganWartawan') === '') required @endif>
                                    <input type="hidden" name="fileSuratKeteranganWartawan" value="{{ $value('fileSuratKeteranganWartawan') }}">
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. Sertifikat Kompetensi</label>
                                <input class="form-control" name="serfikatUkwPerwakilan" value="{{ $value('serfikatUkwPerwakilan') }}" {{ $disabled }} required>
                                <label class="form-label mt-2">Sertifikat Kompetensi Kepala Biro/Wartawan Perwakilan (PNG, JPG, atau PDF)</label>
                                @if($readonly)
                                    {!! $document('fileSerfikatUkwPerwakilan', 'fileserfikatukwperwakilan') !!}
                                @else
                                    <input class="form-control document-upload" type="file" accept=".png,.jpg,.jpeg,.pdf,image/png,image/jpeg,application/pdf" data-target="fileSerfikatUkwPerwakilan" @if($value('fileSerfikatUkwPerwakilan') === '') required @endif>
                                    <input type="hidden" name="fileSerfikatUkwPerwakilan" value="{{ $value('fileSerfikatUkwPerwakilan') }}">
                                @endif
                            </div>
                            <div class="col-12">
                                <label class="form-label">Alamat Domisili Kepala Biro/Wartawan Perwakilan</label>
                                <input class="form-control" 
                                name="alamatPerwakilan" 
                                value="{{ $value('alamatPerwakilan') }}" 
                                {{ $disabled }} required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kecamatan</label>
                                <input class="form-control" name="alamatKecPerwakilan" value="{{ $value('alamatKecPerwakilan') }}" {{ $disabled }} required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kabupaten/Kota</label>
                                <input class="form-control" name="alamatKabPerwakilan" value="{{ $value('alamatKabPerwakilan') }}" {{ $disabled }} required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Provinsi</label>
                                <input class="form-control" name="alamatProvPerwakilan" value="{{ $value('alamatProvPerwakilan') }}" {{ $disabled }} required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">NIK</label>
                                <input class="form-control" name="nomorKtpPerwakilan" value="{{ $value('nomorKtpPerwakilan') }}" {{ $disabled }} required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. KK</label>
                                <input class="form-control" name="nomorKKPerwakilan" value="{{ $value('nomorKKPerwakilan') }}" {{ $disabled }} required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label d-block">Organisasi Wartawan</label>
                                <div class="d-flex flex-wrap gap-3">
                                    @foreach($wartawanOptions as $item)
                                        <label class="form-check">
                                            <input class="form-check-input" type="radio" name="organisasiWartawan" value="{{ $item }}" data-organization="organisasiWartawan" @checked($wartawanChoice === $item) {{ $disabled }} required>
                                            <span class="form-check-label">{{ $item }}</span>
                                        </label>
                                    @endforeach
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" name="organisasiWartawan" value="lainnya" data-organization="organisasiWartawan" @checked($wartawanChoice === 'lainnya') {{ $disabled }} required>
                                        <span class="form-check-label">Lainnya</span>
                                    </label>
                                </div>
                                <input class="form-control mt-2 organization-other" name="organisasiWartawanLainnya" data-for="organisasiWartawan" value="{{ $wartawanLainnya }}" placeholder="Tulis organisasi wartawan lainnya" {{ $disabled }} @disabled(!$readonly && $wartawanChoice !== 'lainnya')>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label d-block">Organisasi Perusahaan Pers</label>
                                <div class="d-flex flex-wrap gap-3">
                                    @foreach($perusahaanPersOptions as $item)
                                        <label class="form-check">
                                            <input class="form-check-input" type="radio" name="organisasiPerusahaanPers" value="{{ $item }}" data-organization="organisasiPerusahaanPers" @checked($perusahaanPersChoice === $item) {{ $disabled }} required>
                                            <span class="form-check-label">{{ $item }}</span>
                                        </label>
                                    @endforeach
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" name="organisasiPerusahaanPers" value="lainnya" data-organization="organisasiPerusahaanPers" @checked($perusahaanPersChoice === 'lainnya') {{ $disabled }} required>
                                        <span class="form-check-label">Lainnya</span>
                                    </label>
                                </div>
                                <input class="form-control mt-2 organization-other" name="organisasiPerusahaanPersLainnya" data-for="organisasiPerusahaanPers" value="{{ $perusahaanPersLainnya }}" placeholder="Tulis organisasi perusahaan pers lainnya" {{ $disabled }} @disabled(!$readonly && $perusahaanPersChoice !== 'lainnya')>
                            </div>
                        </div>
                        <div class="row g-3">
                            @foreach ([
                                ['fileBuktiKeanggotaanOrganisasiWartawan','Bukti Keanggotaan Organisasi Wartawan','filebuktikeanggotaanorganisasiwartawan'], ['fileBuktiKeanggotaanOrganisasiPerusahaanPers','Bukti Keanggotaan Organisasi Perusahaan Pers','filebuktikeanggotaanorganisasiperusahaanpers']
                            ] as [$field,$label,$folder])
                                <div class="col-md-6 document-field"><label class="form-label">{{ $label }} (PNG, JPG, atau PDF)</label>@if($readonly){!! $document($field, $folder) !!}@else<input class="form-control document-upload" type="file" accept=".png,.jpg,.jpeg,.pdf,image/png,image/jpeg,application/pdf" data-target="{{ $field }}" @if($value($field) === '') required @endif><input type="hidden" name="{{ $field }}" value="{{ $value($field) }}">@endif</div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @unless($readonly)
                    <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4">
                            {{ $record ? 'Simpan Perubahan' : 'Kirim Pengajuan' }}
                        </button>
                    </div>
                @endunless
            </form>
        </div>
    </div>
</section>
