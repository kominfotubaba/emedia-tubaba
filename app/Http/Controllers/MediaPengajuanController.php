<?php

namespace App\Http\Controllers;

use App\Mail\notifVerifikasiTolak;
use App\Models\media_pengajuan;
use App\Models\new_media_pengajuan;
use App\Models\tahun;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MediaPengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = tahun::select('tahun')->where('pengajuan', 1)->count();
        if ($count == 0) {
            # code...
            $tahun_buka = date('Y');
        } else {
            $tahun_data = tahun::select('tahun')->where('pengajuan', 1)->get();
            $tahun_buka = json_decode(json_encode($tahun_data[0]->tahun));
        }
        $tahun_hitung = tahun::where('pengajuan', 1)->count();
        // $pengajuan_data = new_media_pengajuan::where('id_user', Auth::user()->id)->where('tahun_pengajuan', $tahun_buka)->count();
        $pengajuan_data = new_media_pengajuan::where('id_user', Auth::user()->id)->count();
        // dd($pengajuan_data);
        if (Auth::user()->role == 'user') {
            # code...
            if ($tahun_hitung == 1 && $pengajuan_data == 0) {
                # code...
                return view('admin.pengajuan.jenis', ['pengajuan_buka' => $tahun_hitung, 'pengajuan_data' => $pengajuan_data]);
            } else {
                return redirect('/daftar' . '/' . $tahun_buka . '/detail');
            }
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //deklarasi
        $data_id = $request->id;
        $tahun = tahun::select('tahun')->where('pengajuan', 1)->get();
        $tahun_buka = json_decode(json_encode($tahun[0]->tahun));
        $find = new_media_pengajuan::find($data_id);
        $duplikat_data = $find->replicate();
        $duplikat_data->created_at = Carbon::now();
        $duplikat_data->pengajuan_no =  $tahun_buka . '_' . Str::random(10);
        $duplikat_data->tahun_pengajuan =  $tahun_buka;
        $duplikat_data->save();
        return response()->json([
            'text' => 'data sukses'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->saveSimplifiedPengajuan($request);
        //

        $tahun = tahun::select('tahun')->where('pengajuan', 1)->get();
        $tahun_buka = json_decode(json_encode($tahun[0]->tahun));
        $pengajuan_no =  $tahun_buka . '_' . Str::random(10);
        $jenis_media = strtolower($request->jenis_media);

        $namaPerusahaan = str_replace('  ', ' ', strtolower($request->namaPerusahaan));
        $namaPenanggungJawab = strtolower($request->namaPenanggungJawab);
        $namaPimred = strtolower($request->namaPimred);
        $namaPimprus = strtolower($request->namaPimprus);
        $kumhamPerusahaan = strtolower($request->kumhamPerusahaan);
        $alamatPerusahaan = strtolower($request->alamatPerusahaan);
        $alamatWebsite = strtolower($request->alamatWebsite);
        $tlpnPerusahaan = strtolower($request->tlpnPerusahaan);
        $emailPerusahaan = strtolower($request->emailPerusahaan);
        $npwpPerusahaan = strtolower($request->npwpPerusahaan);
        $nibPerusahaan = strtolower($request->nibPerusahaan);
        $izinIpp = strtolower($request->izinIpp);
        $namaPercetakan = strtolower($request->namaPercetakan);
        $alamatPercetakan = strtolower($request->alamatPercetakan);
        $alamatProvPerusahaan = strtolower($request->alamatProvPerusahaan);
        $alamatKabPerusahaan = strtolower($request->alamatKabPerusahaan);
        $alamatKecPerusahaan = strtolower($request->alamatKecPerusahaan);
        $statusKswp = strtolower($request->statusKswp);
        $noKlbi = strtolower($request->noKlbi);
        $fileSuratPernyataanPimred = strtolower($request->fileSuratPernyataanPimred);
        $fileKumhamPerusahaan = strtolower($request->fileKumhamPerusahaan);
        $fileNpwpPerusahaan = strtolower($request->fileNpwpPerusahaan);
        $fileNibPerusahaan = strtolower($request->fileNibPerusahaan);
        $fileIzinIpp = strtolower($request->fileIzinIpp);
        $namaMedia = strtolower($request->namaMedia);
        $serfikatUkwPimred = strtolower($request->serfikatUkwPimred);
        $namaBank = strtolower($request->namaBank);
        $pemilikRekening = strtolower($request->pemilikRekening);
        $noRekening = strtolower($request->noRekening);
        $verifikasiDewanPers = str_replace('  ', '', trim(strtolower($request->verifikasiDewanPers)));
        $jenisSerfikatUkwPimred = strtolower($request->jenisSerfikatUkwPimred);
        $afiliasiPerusahaan = strtolower($request->afiliasiPerusahaan);
        $domisiliRedaksiMedia = str_replace('  ', '', strtolower($request->domisiliRedaksiMedia));
        $kanalKhusus = strtolower($request->kanalKhusus);
        $jenisRekening = strtolower($request->jenisRekening);
        $fileSerfikatUkwPimred = strtolower($request->fileSerfikatUkwPimred);
        $fileAfiliasiPerusahaan = strtolower($request->fileAfiliasiPerusahaan);
        $fileDomisiliRedaksiMedia = strtolower($request->fileDomisiliRedaksiMedia);
        $fileKanalKhusus = strtolower($request->fileKanalKhusus);
        $fileRekening = strtolower($request->fileRekening);
        $tahunBerdiriMedia = strtolower($request->tahunBerdiriMedia);
        $jenisJangkauanSiarMediaElektronik = strtolower($request->jenisJangkauanSiarMediaElektronik);
        $jangkauanSiarMediaElektronik = strtolower($request->jangkauanSiarMediaElektronik);
        $jumlahOplahMediaCetakPerMinggu = strtolower($request->jumlahOplahMediaCetakPerMinggu);
        $fileJumlahOplahMediaCetakPerMinggu = strtolower($request->fileJumlahOplahMediaCetakPerMinggu);
        $jumlahKontenBeritaAktif = strtolower($request->jumlahKontenBeritaAktif);
        $namaPerwakilan = strtolower($request->namaPerwakilan);
        $nomorKKPerwakilan = strtolower($request->nomorKKPerwakilan);
        $nomorKtpPerwakilan = strtolower($request->nomorKtpPerwakilan);
        $npwpPerwakilan = strtolower($request->npwpPerwakilan);
        $serfikatUkwPerwakilan = strtolower($request->serfikatUkwPerwakilan);
        $afiliasiPersPerwakilan = strtolower($request->afiliasiPersPerwakilan);
        $organisasiWartawan = strtolower($request->organisasiWartawan);
        $organisasiPerusahaanPers = strtolower($request->organisasiPerusahaanPers);
        $alamatPerwakilan = strtolower($request->alamatPerwakilan);
        $tlpnPerwakilan = strtolower($request->tlpnPerwakilan);
        $emailPerwakilan = strtolower($request->emailPerwakilan);
        $jenisSerfikatUkwPerwakilan = strtolower($request->jenisSerfikatUkwPerwakilan);
        $alamatProvPerwakilan = strtolower($request->alamatProvPerwakilan);
        $alamatKabPerwakilan = strtolower($request->alamatKabPerwakilan);
        $alamatKecPerwakilan = strtolower($request->alamatKecPerwakilan);
        $alamatKelPerwakilan = strtolower($request->alamatKelPerwakilan);
        $fileNpwpPerwakilan = strtolower($request->fileNpwpPerwakilan);
        $fileSerfikatUkwPerwakilan = strtolower($request->fileSerfikatUkwPerwakilan);
        $fileafiliasiPersPerwakilan = strtolower($request->fileafiliasiPersPerwakilan);
        $fileSuratKeteranganWartawan = strtolower($request->fileSuratKeteranganWartawan);

        // checking
        $pengajuan_cek = new_media_pengajuan::where('id_user', Auth::user()->id)->where('tahun_pengajuan', $tahun_buka)->count();
        $nama_perusahaan_cek = new_media_pengajuan::where('namaPerusahaan', $namaPerusahaan)->where('tahun_pengajuan', $tahun_buka)->count();
        $ktp_cek = new_media_pengajuan::where('nomorKtpPerwakilan', $nomorKtpPerwakilan)->where('tahun_pengajuan', $tahun_buka)->count();
        $kk_cek = new_media_pengajuan::where('nomorKKPerwakilan', $nomorKKPerwakilan)->where('tahun_pengajuan', $tahun_buka)->count();
        $nama_media_cek = new_media_pengajuan::where('namaMedia', $namaMedia)->where('tahun_pengajuan', $tahun_buka)->count();

        if ($nama_perusahaan_cek >= 1) {
            # code...
            $pesan = 'Pengajuan Nama Perusahaan Telah Digunakan';
            $icon = 'error';
            $title = 'Operasi Gagal';
        } elseif ($nama_media_cek >= 1) {
            # code...
            $pesan = 'Nama Media Telah Digunakan';
            $icon = 'error';
            $title = 'Operasi Gagal';
        } elseif ($ktp_cek >= 1) {
            # code...
            $pesan = 'Pengajuan KTP Telah Digunakan';
            $icon = 'error';
            $title = 'Operasi Gagal';
        } elseif ($kk_cek >= 1) {
            $pesan = 'Pengajuan KK Telah Digunakan';
            $icon = 'error';
            $title = 'Operasi Gagal';
        } elseif ($nomorKKPerwakilan == $nomorKtpPerwakilan) {
            $pesan = 'NO KK Dan KTP Tidak Boleh Sama';
            $icon = 'error';
            $title = 'Operasi Gagal';
        } else {
            if ($pengajuan_cek >= 1) {
                # code...
                $pesan = 'Pengajuan tahun ' . $tahun_buka . ' telah diajukan silahkan cek data daftar pengajuan data';
                $icon = 'error';
                $title = 'Operasi Gagal';
            } else {
                $cek_ketersediaan_data = new_media_pengajuan::where('id_user', Auth::user()->id)->where('tahun_pengajuan', $tahun_buka)->count();
                // dd($cek_ketersediaan_data);
                if ($cek_ketersediaan_data == 0) {
                    # code...
                    // insert data
                    $pengajuan = new new_media_pengajuan();
                    $pengajuan->id_user = Auth::user()->id;
                    $pengajuan->pengajuan_no = $pengajuan_no;
                    $pengajuan->jenis_media = $jenis_media;
                    // DATA BADAN HUKUM
                    $pengajuan->namaPerusahaan = $namaPerusahaan;
                    $pengajuan->namaPenanggungJawab = $namaPenanggungJawab;
                    $pengajuan->namaPimred = $namaPimred;
                    $pengajuan->namaPimprus = $namaPimprus;
                    $pengajuan->kumhamPerusahaan = $kumhamPerusahaan;
                    $pengajuan->alamatPerusahaan = $alamatPerusahaan;
                    $pengajuan->alamatWebsite = $alamatWebsite;
                    $pengajuan->tlpnPerusahaan = $tlpnPerusahaan;
                    $pengajuan->emailPerusahaan = $emailPerusahaan;
                    $pengajuan->npwpPerusahaan = $npwpPerusahaan;
                    $pengajuan->nibPerusahaan = $nibPerusahaan;
                    $pengajuan->izinIpp = $izinIpp;
                    $pengajuan->namaPercetakan = $namaPercetakan;
                    $pengajuan->alamatPercetakan = $alamatPercetakan;
                    $pengajuan->alamatProvPerusahaan = $alamatProvPerusahaan;
                    $pengajuan->alamatKabPerusahaan = $alamatKabPerusahaan;
                    $pengajuan->alamatKecPerusahaan = $alamatKecPerusahaan;
                    $pengajuan->statusKswp = $statusKswp;
                    $pengajuan->noKlbi = $noKlbi;
                    $pengajuan->fileSuratPernyataanPimred = $fileSuratPernyataanPimred;
                    $pengajuan->fileKumhamPerusahaan = $fileKumhamPerusahaan;
                    $pengajuan->fileNpwpPerusahaan = $fileNpwpPerusahaan;
                    $pengajuan->fileNibPerusahaan = $fileNibPerusahaan;
                    $pengajuan->fileIzinIpp = $fileIzinIpp;
                    // DATA MEDIA
                    $pengajuan->namaMedia = $namaMedia;
                    $pengajuan->serfikatUkwPimred = $serfikatUkwPimred;
                    $pengajuan->namaBank = $namaBank;
                    $pengajuan->pemilikRekening = $pemilikRekening;
                    $pengajuan->noRekening = $noRekening;
                    $pengajuan->verifikasiDewanPers = $verifikasiDewanPers;
                    $pengajuan->jenisSerfikatUkwPimred = $jenisSerfikatUkwPimred;
                    $pengajuan->afiliasiPerusahaan = $afiliasiPerusahaan;
                    $pengajuan->domisiliRedaksiMedia = $domisiliRedaksiMedia;
                    $pengajuan->kanalKhusus = $kanalKhusus;
                    $pengajuan->jenisRekening = $jenisRekening;
                    $pengajuan->fileSerfikatUkwPimred = $fileSerfikatUkwPimred;
                    $pengajuan->fileAfiliasiPerusahaan = $fileAfiliasiPerusahaan;
                    $pengajuan->fileDomisiliRedaksiMedia = $fileDomisiliRedaksiMedia;
                    $pengajuan->fileKanalKhusus = $fileKanalKhusus;
                    $pengajuan->fileRekening = $fileRekening;
                    // KUALIFIKASI MEDIA
                    $pengajuan->tahunBerdiriMedia = $tahunBerdiriMedia;
                    $pengajuan->jenisJangkauanSiarMediaElektronik = $jenisJangkauanSiarMediaElektronik;
                    $pengajuan->jangkauanSiarMediaElektronik = $jangkauanSiarMediaElektronik;
                    $pengajuan->jumlahOplahMediaCetakPerMinggu = $jumlahOplahMediaCetakPerMinggu;
                    $pengajuan->fileJumlahOplahMediaCetakPerMinggu = $fileJumlahOplahMediaCetakPerMinggu;
                    $pengajuan->jumlahKontenBeritaAktif = $jumlahKontenBeritaAktif;
                    //    PERWAKILAN MEDIA
                    $pengajuan->namaPerwakilan = $namaPerwakilan;
                    $pengajuan->nomorKKPerwakilan = $nomorKKPerwakilan;
                    $pengajuan->nomorKtpPerwakilan = $nomorKtpPerwakilan;
                    $pengajuan->npwpPerwakilan = $npwpPerwakilan;
                    $pengajuan->serfikatUkwPerwakilan = $serfikatUkwPerwakilan;
                    $pengajuan->afiliasiPersPerwakilan = $afiliasiPersPerwakilan;
                    $pengajuan->organisasiWartawan = $organisasiWartawan;
                    $pengajuan->organisasiPerusahaanPers = $organisasiPerusahaanPers;
                    $pengajuan->alamatPerwakilan = $alamatPerwakilan;
                    $pengajuan->tlpnPerwakilan = $tlpnPerwakilan;
                    $pengajuan->emailPerwakilan = $emailPerwakilan;
                    $pengajuan->jenisSerfikatUkwPerwakilan = $jenisSerfikatUkwPerwakilan;
                    $pengajuan->alamatProvPerwakilan = $alamatProvPerwakilan;
                    $pengajuan->alamatKabPerwakilan = $alamatKabPerwakilan;
                    $pengajuan->alamatKecPerwakilan = $alamatKecPerwakilan;
                    $pengajuan->alamatKelPerwakilan = $alamatKelPerwakilan;
                    $pengajuan->fileNpwpPerwakilan = $fileNpwpPerwakilan;
                    $pengajuan->fileSerfikatUkwPerwakilan = $fileSerfikatUkwPerwakilan;
                    $pengajuan->fileafiliasiPersPerwakilan = $fileafiliasiPersPerwakilan;
                    $pengajuan->fileSuratKeteranganWartawan = $fileSuratKeteranganWartawan;
                    // status
                    $pengajuan->status = 'ajukan';
                    $pengajuan->tahun_pengajuan = $tahun_buka;
                    //    end
                    $pengajuan->save();

                    $pesan = 'data Berhasil di Input';
                    $icon = 'success';
                    $title = 'Sukses';
                } else {
                    # code...
                    $pesan = 'Data Sudah Ada';
                    $icon = 'error';
                    $title = 'Error';
                }
            }
        }

        return response()->json(
            [
                'massage' => $pesan,
                'icon' => $icon,
                'title' => $title
            ]
        );
    }

    public function checkDuplicate(Request $request)
    {
        $fields = [
            'namaMedia' => ['namaMedia', 'Nama Media'],
            'namaPerusahaan' => ['namaPerusahaan', 'Nama Perusahaan Pers'],
            'nibPerusahaan' => ['nibPerusahaan', 'No. NIB'],
            'kumhamPerusahaan' => ['kumhamPerusahaan', 'No. AHU'],
            'izinIpp' => ['izinIpp', 'No. IPP'],
            'npwpPerusahaan' => ['npwpPerusahaan', 'NPWP'],
            'namaPimred' => ['namaPimred', 'Nama Pimpinan Redaksi'],
            'serfikatUkwPimred' => ['serfikatUkwPimred', 'No. Sertifikat Kompetensi Pimred'],
            'namaPimprus' => ['namaPimprus', 'Nama Pimpinan Perusahaan'],
            'tlpnPerusahaan' => ['tlpnPerusahaan', 'No. Telepon Redaksi'],
            'emailPerusahaan' => ['emailPerusahaan', 'Alamat Email Redaksi'],
            'alamatWebsite' => ['alamatWebsite', 'Link Website'],
            'linkYoutube' => ['linkYoutube', 'Link YouTube'],
            'linkFacebook' => ['linkFacebook', 'Link Facebook'],
            'linkInstagram' => ['linkInstagram', 'Link Instagram'],
            'linkTiktok' => ['linkTiktok', 'Link TikTok'],
            'linkThreads' => ['linkThreads', 'Link Threads'],
            'linkX' => ['linkX', 'Link X'],
            'namaPercetakan' => ['namaPercetakan', 'Nama Perusahaan Percetakan'],
            'namaPerwakilan' => ['namaPerwakilan', 'Nama Kepala Biro/Wartawan Perwakilan'],
            'serfikatUkwPerwakilan' => ['serfikatUkwPerwakilan', 'No. Sertifikat Kompetensi'],
            'npwpPerwakilan' => ['npwpPerwakilan', 'NPWP Kepala Biro/Wartawan Perwakilan'],
            'organisasiWartawanLainnya' => ['organisasiWartawan', 'Organisasi Wartawan'],
            'organisasiPerusahaanPersLainnya' => ['organisasiPerusahaanPers', 'Organisasi Perusahaan Pers'],
        ];

        $data = $request->validate([
            'field' => ['required', 'string'],
            'value' => ['nullable', 'string', 'max:255'],
            'pengajuan_no' => ['nullable', 'string'],
        ]);

        if (!isset($fields[$data['field']]) || blank($data['value'])) {
            return response()->json(['duplicate' => false]);
        }

        [$column, $label] = $fields[$data['field']];
        $query = new_media_pengajuan::query()
            ->whereRaw('LOWER(' . $column . ') = ?', [mb_strtolower(trim($data['value']))]);

        if (!empty($data['pengajuan_no'])) {
            $query->where('pengajuan_no', '!=', $data['pengajuan_no']);
        }

        return response()->json([
            'duplicate' => $query->exists(),
            'message' => $label . ' sudah terdaftar.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\media_pengajuan  $media_pengajuan
     * @return \Illuminate\Http\Response
     */
    public function show($jenis)
    {
        //
        $tahun = tahun::where('pengajuan', 1)->count();
        return view('admin.pengajuan.form', [
            'pengajuan' => $tahun,
            'media_jenis' => $jenis
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\media_pengajuan  $media_pengajuan
     * @return \Illuminate\Http\Response
     */
    public function edit($no_pengajuan)
    {
        //
        $cek_akses = new_media_pengajuan::where('pengajuan_no', $no_pengajuan)->first();
        $count = tahun::select('tahun')->where('pengajuan', 1)->count();
        # code...
        if ($count == 0) {
            # code...
            $tahun_buka = date('Y');
        } else {
            $tahun_data = tahun::select('tahun')->where('pengajuan', 1)->get();
            $tahun_buka = json_decode(json_encode($tahun_data[0]->tahun));
        }

        if ($cek_akses->id_user == Auth::user()->id) {
            # code...
            //declare
            $count = tahun::select('tahun')->where('pengajuan', 1)->count();
            if ($count == 0) {
                # code...
                $tahun_buka = date('Y');
            } else {
                $tahun_data = tahun::select('tahun')->where('pengajuan', 1)->get();
                $tahun_buka = json_decode(json_encode($tahun_data[0]->tahun));
            }
            $tahun_hitung = tahun::where('pengajuan', 1)->count();
            $pengajuan_cek = new_media_pengajuan::where('id_user', Auth::user()->id)->where('tahun_pengajuan', $tahun_buka)->count();
            $media_data = new_media_pengajuan::where('pengajuan_no', $no_pengajuan)->get();
            return view('admin.pengajuan.form_edit', [
                'pengajuan_buka' => $tahun_hitung,
                'pengajuan_data' => $pengajuan_cek,
                'media_data' => $media_data
            ]);
        } else {
            return redirect('/daftar' . '/' . $tahun_buka . '/detail');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\media_pengajuan  $media_pengajuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return $this->saveSimplifiedPengajuan($request, $request->pengajuan_no);
        //

        $tahun_pengajuan = tahun::select('tahun')->where('pengajuan', 1)->get();

        if (isset($tahun_pengajuan[0])) {
            # code...
            $tahun_buka = json_decode(json_encode($tahun_pengajuan[0]->tahun));
        } else {
            $tahun_buka = date('Y');
        }
        // $pengajuan_no =  $tahun_buka . '_' . Str::random(10);
        // $jenis_media = strtolower($request->jenis_media);

        $pengajuan_no =  $request->pengajuan_no;
        $jenis_media = strtolower($request->jenis_media);
        $namaPerusahaan = str_replace('  ', ' ', strtolower($request->namaPerusahaan));
        $namaPenanggungJawab = strtolower($request->namaPenanggungJawab);
        $namaPimred = strtolower($request->namaPimred);
        $namaPimprus = strtolower($request->namaPimprus);
        $kumhamPerusahaan = strtolower($request->kumhamPerusahaan);
        $alamatPerusahaan = strtolower($request->alamatPerusahaan);
        $alamatWebsite = strtolower($request->alamatWebsite);
        $tlpnPerusahaan = strtolower($request->tlpnPerusahaan);
        $emailPerusahaan = strtolower($request->emailPerusahaan);
        $npwpPerusahaan = strtolower($request->npwpPerusahaan);
        $nibPerusahaan = strtolower($request->nibPerusahaan);
        $izinIpp = strtolower($request->izinIpp);
        $namaPercetakan = strtolower($request->namaPercetakan);
        $alamatPercetakan = strtolower($request->alamatPercetakan);
        $alamatProvPerusahaan = strtolower($request->alamatProvPerusahaan);
        $alamatKabPerusahaan = strtolower($request->alamatKabPerusahaan);
        $alamatKecPerusahaan = strtolower($request->alamatKecPerusahaan);
        $statusKswp = strtolower($request->statusKswp);
        $noKlbi = strtolower($request->noKlbi);
        $fileSuratPernyataanPimred = strtolower($request->fileSuratPernyataanPimred);
        $fileKumhamPerusahaan = strtolower($request->fileKumhamPerusahaan);
        $fileNpwpPerusahaan = strtolower($request->fileNpwpPerusahaan);
        $fileNibPerusahaan = strtolower($request->fileNibPerusahaan);
        $fileIzinIpp = strtolower($request->fileIzinIpp);
        $namaMedia = strtolower($request->namaMedia);
        $serfikatUkwPimred = strtolower($request->serfikatUkwPimred);
        $namaBank = strtolower($request->namaBank);
        $pemilikRekening = strtolower($request->pemilikRekening);
        $noRekening = strtolower($request->noRekening);
        $verifikasiDewanPers = str_replace('  ', '', strtolower($request->verifikasiDewanPers));
        $jenisSerfikatUkwPimred = strtolower($request->jenisSerfikatUkwPimred);
        $afiliasiPerusahaan = strtolower($request->afiliasiPerusahaan);
        $domisiliRedaksiMedia = str_replace('  ', '', strtolower($request->domisiliRedaksiMedia));
        $kanalKhusus = strtolower($request->kanalKhusus);
        $jenisRekening = strtolower($request->jenisRekening);
        $fileSerfikatUkwPimred = strtolower($request->fileSerfikatUkwPimred);
        $fileAfiliasiPerusahaan = strtolower($request->fileAfiliasiPerusahaan);
        $fileDomisiliRedaksiMedia = strtolower($request->fileDomisiliRedaksiMedia);
        $fileKanalKhusus = strtolower($request->fileKanalKhusus);
        $fileRekening = strtolower($request->fileRekening);
        $tahunBerdiriMedia = strtolower($request->tahunBerdiriMedia);
        $jenisJangkauanSiarMediaElektronik = strtolower($request->jenisJangkauanSiarMediaElektronik);
        $jangkauanSiarMediaElektronik = strtolower($request->jangkauanSiarMediaElektronik);
        $jumlahOplahMediaCetakPerMinggu = strtolower($request->jumlahOplahMediaCetakPerMinggu);
        $fileJumlahOplahMediaCetakPerMinggu = strtolower($request->fileJumlahOplahMediaCetakPerMinggu);
        $jumlahKontenBeritaAktif = strtolower($request->jumlahKontenBeritaAktif);
        $namaPerwakilan = strtolower($request->namaPerwakilan);
        $nomorKKPerwakilan = strtolower($request->nomorKKPerwakilan);
        $nomorKtpPerwakilan = strtolower($request->nomorKtpPerwakilan);
        $npwpPerwakilan = strtolower($request->npwpPerwakilan);
        $serfikatUkwPerwakilan = strtolower($request->serfikatUkwPerwakilan);
        $afiliasiPersPerwakilan = strtolower($request->afiliasiPersPerwakilan);
        $organisasiWartawan = strtolower($request->organisasiWartawan);
        $organisasiPerusahaanPers = strtolower($request->organisasiPerusahaanPers);
        $alamatPerwakilan = strtolower($request->alamatPerwakilan);
        $tlpnPerwakilan = strtolower($request->tlpnPerwakilan);
        $emailPerwakilan = strtolower($request->emailPerwakilan);
        $jenisSerfikatUkwPerwakilan = strtolower($request->jenisSerfikatUkwPerwakilan);
        $alamatProvPerwakilan = strtolower($request->alamatProvPerwakilan);
        $alamatKabPerwakilan = strtolower($request->alamatKabPerwakilan);
        $alamatKecPerwakilan = strtolower($request->alamatKecPerwakilan);
        $alamatKelPerwakilan = strtolower($request->alamatKelPerwakilan);
        $fileNpwpPerwakilan = strtolower($request->fileNpwpPerwakilan);
        $fileSerfikatUkwPerwakilan = strtolower($request->fileSerfikatUkwPerwakilan);
        $fileafiliasiPersPerwakilan = strtolower($request->fileafiliasiPersPerwakilan);
        $fileSuratKeteranganWartawan = strtolower($request->fileSuratKeteranganWartawan);

        $tahun = tahun::select('tahun')->where('pengajuan_edit', 1)->get();
        if (isset($tahun[0])) {
            # code...
            $tahun_edit = json_decode(json_encode($tahun[0]->tahun));
        } else {
            $tahun_pengajuan = new_media_pengajuan::where('pengajuan_no',  $pengajuan_no)->first();
            $tahun_buka_edit_single = $tahun_pengajuan->tahun_pengajuan;
            $status_buka_edit = $tahun_pengajuan->buka_edit;
            if ($status_buka_edit == 'buka') {
                # code...
                $tahun_edit = $tahun_buka_edit_single;
            } else {
                # code...
                return response()->json([
                    'massage' => 'Waktu Edit Sudah Berakhir',
                    'icon' => 'error',
                    'title' => 'Waktu Edit Sudah Berakhir',
                    'tahun_buka' => $tahun_buka
                ]);
            }
        }
        $nama_perusahaan_cek = new_media_pengajuan::where('pengajuan_no', '!=', $pengajuan_no)->where('namaPerusahaan', $namaPerusahaan)->where('tahun_pengajuan', $tahun_edit)->count();
        $nama_media_cek = new_media_pengajuan::where('pengajuan_no', '!=', $pengajuan_no)->where('namaMedia', $namaMedia)->where('tahun_pengajuan', $tahun_edit)->count();
        $ktp_cek = new_media_pengajuan::where('pengajuan_no', '!=', $pengajuan_no)->where('nomorKtpPerwakilan', $nomorKtpPerwakilan)->where('tahun_pengajuan', $tahun_edit)->count();
        $kk_cek = new_media_pengajuan::where('pengajuan_no', '!=', $pengajuan_no)->where('nomorKKPerwakilan', $nomorKKPerwakilan)->where('tahun_pengajuan', $tahun_edit)->count();


        // dd([$pengajuan_no, $nama_perusahaan_cek, $jenis_media]);

        if ($nama_perusahaan_cek >= 1) {
            # code...
            $pesan = 'Pengajuan Nama Perusahaan Telah Digunakan';
            $icon = 'error';
            $title = 'Operasi Gagal';
        } elseif ($nama_media_cek >= 1) {
            # code...
            $pesan = 'Nama Media Telah Digunakan';
            $icon = 'error';
            $title = 'Operasi Gagal';
        } elseif ($ktp_cek >= 1) {
            # code...
            $pesan = 'Pengajuan KTP Telah Digunakan';
            $icon = 'error';
            $title = 'Operasi Gagal';
        } elseif ($kk_cek >= 1) {
            $pesan = 'Pengajuan KK Telah Digunakan';
            $icon = 'error';
            $title = 'Operasi Gagal';
        } elseif ($nomorKKPerwakilan == $nomorKtpPerwakilan) {
            $pesan = 'NO KK Dan KTP Tidak Boleh Sama';
            $icon = 'error';
            $title = 'Operasi Gagal';
        } else {
            // update
            $data = [
                'jenis_media' => $jenis_media,
                'namaPerusahaan' => $namaPerusahaan,
                'namaPenanggungJawab' => $namaPenanggungJawab,
                'namaPimred' => $namaPimred,
                'namaPimprus' => $namaPimprus,
                'kumhamPerusahaan' => $kumhamPerusahaan,
                'alamatPerusahaan' => $alamatPerusahaan,
                'alamatWebsite' => $alamatWebsite,
                'tlpnPerusahaan' => $tlpnPerusahaan,
                'emailPerusahaan' => $emailPerusahaan,
                'npwpPerusahaan' => $npwpPerusahaan,
                'nibPerusahaan' => $nibPerusahaan,
                'izinIpp' => $izinIpp,
                'namaPercetakan' => $namaPercetakan,
                'alamatPercetakan' => $alamatPercetakan,
                'alamatProvPerusahaan' => $alamatProvPerusahaan,
                'alamatKabPerusahaan' => $alamatKabPerusahaan,
                'alamatKecPerusahaan' => $alamatKecPerusahaan,
                'statusKswp' => $statusKswp,
                'noKlbi' => $noKlbi,
                'fileSuratPernyataanPimred' => $fileSuratPernyataanPimred,
                'fileKumhamPerusahaan' => $fileKumhamPerusahaan,
                'fileNpwpPerusahaan' => $fileNpwpPerusahaan,
                'fileNibPerusahaan' => $fileNibPerusahaan,
                'fileIzinIpp' => $fileIzinIpp,
                'namaMedia' => $namaMedia,
                'serfikatUkwPimred' => $serfikatUkwPimred,
                'namaBank' => $namaBank,
                'pemilikRekening' => $pemilikRekening,
                'noRekening' => $noRekening,
                'verifikasiDewanPers' => $verifikasiDewanPers,
                'jenisSerfikatUkwPimred' => $jenisSerfikatUkwPimred,
                'afiliasiPerusahaan' => $afiliasiPerusahaan,
                'domisiliRedaksiMedia' => $domisiliRedaksiMedia,
                'kanalKhusus' => $kanalKhusus,
                'jenisRekening' => $jenisRekening,
                'fileSerfikatUkwPimred' => $fileSerfikatUkwPimred,
                'fileAfiliasiPerusahaan' => $fileAfiliasiPerusahaan,
                'fileDomisiliRedaksiMedia' => $fileDomisiliRedaksiMedia,
                'fileKanalKhusus' => $fileKanalKhusus,
                'fileRekening' => $fileRekening,
                'tahunBerdiriMedia' => $tahunBerdiriMedia,
                'jenisJangkauanSiarMediaElektronik' => $jenisJangkauanSiarMediaElektronik,
                'jangkauanSiarMediaElektronik' => $jangkauanSiarMediaElektronik,
                'jumlahOplahMediaCetakPerMinggu' => $jumlahOplahMediaCetakPerMinggu,
                'fileJumlahOplahMediaCetakPerMinggu' => $fileJumlahOplahMediaCetakPerMinggu,
                'jumlahKontenBeritaAktif' => $jumlahKontenBeritaAktif,
                'namaPerwakilan' => $namaPerwakilan,
                'nomorKKPerwakilan' => $nomorKKPerwakilan,
                'nomorKtpPerwakilan' => $nomorKtpPerwakilan,
                'npwpPerwakilan' => $npwpPerwakilan,
                'serfikatUkwPerwakilan' => $serfikatUkwPerwakilan,
                'afiliasiPersPerwakilan' => $afiliasiPersPerwakilan,
                'organisasiWartawan' => $organisasiWartawan,
                'organisasiPerusahaanPers' => $organisasiPerusahaanPers,
                'alamatPerwakilan' => $alamatPerwakilan,
                'tlpnPerwakilan' => $tlpnPerwakilan,
                'emailPerwakilan' => $emailPerwakilan,
                'jenisSerfikatUkwPerwakilan' => $jenisSerfikatUkwPerwakilan,
                'alamatProvPerwakilan' => $alamatProvPerwakilan,
                'alamatKabPerwakilan' => $alamatKabPerwakilan,
                'alamatKecPerwakilan' => $alamatKecPerwakilan,
                'alamatKelPerwakilan' => $alamatKelPerwakilan,
                'fileNpwpPerwakilan' => $fileNpwpPerwakilan,
                'fileSerfikatUkwPerwakilan' => $fileSerfikatUkwPerwakilan,
                'fileafiliasiPersPerwakilan' => $fileafiliasiPersPerwakilan,
                'fileSuratKeteranganWartawan' => $fileSuratKeteranganWartawan,
                'keterangan' => '',
                'status' => 'edit'
            ];

            $pengajuan_update = new_media_pengajuan::where('pengajuan_no', $pengajuan_no)->update($data);

            $pesan = 'data berhasil diupdate';
            $icon = 'success';
            $title = 'Sukses';
        }

        // dd($pengajuan_no);
        return response()->json([
            'massage' => $pesan,
            'icon' => $icon,
            'title' => $title,
            'tahun_buka' => $tahun_buka
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\media_pengajuan  $media_pengajuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(media_pengajuan $media_pengajuan)
    {
        //
    }

    /**
     * Persist the two-step Perusahaan Pers / Perwakilan Media application.
     * Uploaded documents are first stored by upload_data and submitted as filenames.
     */
    private function saveSimplifiedPengajuan(Request $request, ?string $pengajuanNo = null)
    {
        if ($pengajuanNo) {
            $existing = new_media_pengajuan::where('pengajuan_no', $pengajuanNo)->firstOrFail();
            abort_unless((string) $existing->id_user === (string) Auth::id(), 403);
        }
        $rules = [
            'jenis_media' => ['required', 'in:siber,cetak,elektronik'],
            'subjenis_elektronik' => ['nullable', 'in:televisi,radio'],
            'namaMedia' => ['required', 'string', 'max:255'],
            'namaPerusahaan' => ['required', 'string', 'max:255'],
            'namaPercetakan' => ['nullable', 'string', 'max:255'],
            'alamatPercetakan' => ['nullable', 'string', 'max:255'],
            'nibPerusahaan' => ['required', 'string', 'max:255'],
            'kumhamPerusahaan' => ['required', 'string', 'max:255'],
            'npwpPerusahaan' => ['required', 'string', 'max:255'],
            'verifikasiDewanPers' => ['required', 'in:terdata,terverifikasi administrasi,terverifikasi faktual,belum terdata'],
            'noKlbi' => ['required', 'string', 'max:255'],
            'alamatPerusahaan' => ['required', 'string', 'max:255'],
            'alamatKecPerusahaan' => ['required', 'string', 'max:255'],
            'alamatKabPerusahaan' => ['required', 'string', 'max:255'],
            'alamatProvPerusahaan' => ['required', 'string', 'max:255'],
            'tlpnPerusahaan' => ['required', 'string', 'max:50'],
            'emailPerusahaan' => ['required', 'email', 'max:100'],
            'alamatWebsite' => ['nullable', 'url', 'max:255'],
            'linkYoutube' => ['nullable', 'url', 'max:255'],
            'linkFacebook' => ['nullable', 'url', 'max:255'],
            'linkInstagram' => ['nullable', 'url', 'max:255'],
            'linkTiktok' => ['nullable', 'url', 'max:255'],
            'linkThreads' => ['nullable', 'url', 'max:255'],
            'linkX' => ['nullable', 'url', 'max:255'],
            'namaPimred' => ['required', 'string', 'max:255', 'different:namaPimprus'],
            'serfikatUkwPimred' => ['required', 'string', 'max:255'],
            'namaPimprus' => ['required', 'string', 'max:255'],
            'jenisSerfikatUkwPimred' => ['required', 'in:madya,utama'],
            'namaPerwakilan' => ['required', 'string', 'max:255'],
            'serfikatUkwPerwakilan' => ['nullable', 'string', 'max:255'],
            'jenisSerfikatUkwPerwakilan' => ['nullable', 'in:muda,madya,utama,belum ada sertifikat'],
            'alamatPerwakilan' => ['nullable', 'string', 'max:255'],
            'alamatKecPerwakilan' => ['required', 'string', 'max:255'],
            'alamatKabPerwakilan' => ['required', 'string', 'max:255'],
            'alamatProvPerwakilan' => ['required', 'string', 'max:255'],
            'npwpPerwakilan' => ['required', 'string', 'max:255'],
            'organisasiWartawan' => ['nullable', 'in:PWI,AJI,IJTI,PFI,lainnya'],
            'organisasiWartawanLainnya' => ['nullable', 'required_if:organisasiWartawan,lainnya', 'string', 'max:255'],
            'organisasiPerusahaanPers' => ['nullable', 'in:JMSI,SMSI,AMSI,PRSSNI,ATVLI,ATVSI,SPS,lainnya'],
            'organisasiPerusahaanPersLainnya' => ['nullable', 'required_if:organisasiPerusahaanPers,lainnya', 'string', 'max:255'],
            'fileNibPerusahaan' => ['required', 'string'],
            'fileKumhamPerusahaan' => ['required', 'string'],
            'fileNpwpPerusahaan' => ['required', 'string'],
            'fileSerfikatUkwPimred' => ['required', 'string'],
            'fileSuratPernyataanPimred' => ['nullable', 'required_if:jenisSerfikatUkwPimred,madya', 'string'],
            'fileSuratKeteranganWartawan' => ['required', 'string'],
            'fileNpwpPerwakilan' => ['required', 'string'],
            'fileSerfikatUkwPerwakilan' => ['nullable', 'string'],
            'fileBuktiKeanggotaanOrganisasiWartawan' => ['nullable', 'string'],
            'fileBuktiKeanggotaanOrganisasiPerusahaanPers' => ['nullable', 'string'],
        ];

        if ($request->input('jenis_media') === 'elektronik') {
            $rules['subjenis_elektronik'] = ['required', 'in:televisi,radio'];
            $rules['izinIpp'] = ['required', 'string', 'max:255'];
            $rules['fileIzinIpp'] = ['required', 'string'];
        }

        if ($request->input('jenis_media') === 'cetak') {
            $rules['namaPercetakan'] = ['required', 'string', 'max:255'];
            $rules['alamatPercetakan'] = ['required', 'string', 'max:255'];
        }

        $messages = [
            'required' => ':attribute wajib diisi.',
            'required_if' => ':attribute wajib diisi.',
            'different' => ':attribute tidak boleh sama dengan Nama Pimpinan Perusahaan.',
            'email' => ':attribute harus menggunakan alamat email yang valid.',
            'url' => ':attribute harus berupa URL yang valid, misalnya https://contoh.com.',
            'regex' => ':attribute memiliki format yang tidak valid.',
            'in' => ':attribute tidak valid.',
        ];
        $attributes = [
            'namaMedia' => 'Nama Media', 'namaPerusahaan' => 'Nama Perusahaan Pers',
            'namaPercetakan' => 'Nama Perusahaan Percetakan', 'alamatPercetakan' => 'Alamat Perusahaan Percetakan',
            'subjenis_elektronik' => 'Jenis Siaran Elektronik', 'nibPerusahaan' => 'No. NIB',
            'kumhamPerusahaan' => 'No. AHU', 'izinIpp' => 'No. IPP', 'npwpPerusahaan' => 'NPWP',
            'verifikasiDewanPers' => 'Status Perusahaan Pers', 'noKlbi' => 'KBLI',
            'alamatPerusahaan' => 'Alamat Perusahaan Pers', 'alamatKecPerusahaan' => 'Kecamatan Perusahaan',
            'alamatKabPerusahaan' => 'Kabupaten/Kota Perusahaan', 'alamatProvPerusahaan' => 'Provinsi Perusahaan',
            'tlpnPerusahaan' => 'No. Telepon Redaksi', 'emailPerusahaan' => 'Alamat Email Redaksi',
            'alamatWebsite' => 'Link Website', 'linkYoutube' => 'Link YouTube', 'linkFacebook' => 'Link Facebook',
            'linkInstagram' => 'Link Instagram', 'linkTiktok' => 'Link TikTok', 'linkThreads' => 'Link Threads', 'linkX' => 'Link X',
            'namaPimred' => 'Nama Pimpinan Redaksi', 'serfikatUkwPimred' => 'No. Sertifikat Kompetensi Pimred',
            'namaPimprus' => 'Nama Pimpinan Perusahaan', 'jenisSerfikatUkwPimred' => 'Kompetensi Pimred',
            'namaPerwakilan' => 'Nama Kepala Biro/Wartawan Perwakilan', 'serfikatUkwPerwakilan' => 'No. Sertifikat Kompetensi',
            'jenisSerfikatUkwPerwakilan' => 'Kompetensi Kepala Biro/Wartawan Perwakilan',
            'alamatPerwakilan' => 'Alamat Domisili Perwakilan', 'alamatKecPerwakilan' => 'Kecamatan Perwakilan',
            'alamatKabPerwakilan' => 'Kabupaten/Kota Perwakilan', 'alamatProvPerwakilan' => 'Provinsi Perwakilan',
            'npwpPerwakilan' => 'NPWP Kepala Biro/Wartawan Perwakilan',
            'organisasiWartawan' => 'Organisasi Wartawan', 'organisasiWartawanLainnya' => 'Organisasi Wartawan Lainnya',
            'organisasiPerusahaanPers' => 'Organisasi Perusahaan Pers', 'organisasiPerusahaanPersLainnya' => 'Organisasi Perusahaan Pers Lainnya',
            'fileNibPerusahaan' => 'Dokumen NIB', 'fileKumhamPerusahaan' => 'Dokumen AHU', 'fileIzinIpp' => 'Dokumen IPP',
            'fileNpwpPerusahaan' => 'Dokumen NPWP', 'fileSerfikatUkwPimred' => 'Sertifikat Kompetensi Pimred',
            'fileSuratPernyataanPimred' => 'Surat Pernyataan Pimred', 'fileSuratKeteranganWartawan' => 'Surat Keterangan Perwakilan',
            'fileNpwpPerwakilan' => 'Dokumen NPWP Kepala Biro/Wartawan Perwakilan',
            'fileSerfikatUkwPerwakilan' => 'Sertifikat Kompetensi Perwakilan',
            'fileBuktiKeanggotaanOrganisasiWartawan' => 'Bukti Keanggotaan Organisasi Wartawan',
            'fileBuktiKeanggotaanOrganisasiPerusahaanPers' => 'Bukti Keanggotaan Organisasi Perusahaan Pers',
        ];
        $data = $request->validate($rules, $messages, $attributes);
        $kbliCodes = $this->normalizeKbliCodes($data['noKlbi']);
        if (!$kbliCodes) {
            return response()->json([
                'massage' => 'Setiap kode KBLI harus terdiri dari lima digit angka.',
                'icon' => 'error',
                'title' => 'KBLI Tidak Sesuai',
            ], 422);
        }

        $data['noKlbi'] = implode(', ', $kbliCodes);
        $wartawan = ($data['organisasiWartawan'] ?? null) === 'lainnya'
            ? trim($data['organisasiWartawanLainnya'] ?? '')
            : ($data['organisasiWartawan'] ?? null);
        $perusahaanPers = ($data['organisasiPerusahaanPers'] ?? null) === 'lainnya'
            ? trim($data['organisasiPerusahaanPersLainnya'] ?? '')
            : ($data['organisasiPerusahaanPers'] ?? null);

        $tahun = tahun::where('pengajuan', 1)->value('tahun') ?? date('Y');
        $normal = fn ($value) => is_string($value) ? mb_strtolower(trim($value)) : $value;
        $base = [
            'jenis_media' => $data['jenis_media'],
            'namaMedia' => $normal($data['namaMedia']),
            'namaPerusahaan' => $normal($data['namaPerusahaan']),
            'namaPercetakan' => $data['jenis_media'] === 'cetak' ? $normal($data['namaPercetakan']) : null,
            'alamatPercetakan' => $data['jenis_media'] === 'cetak' ? $normal($data['alamatPercetakan']) : null,
            'nibPerusahaan' => $normal($data['nibPerusahaan']),
            'kumhamPerusahaan' => $normal($data['kumhamPerusahaan']),
            'npwpPerusahaan' => $normal($data['npwpPerusahaan']),
            'verifikasiDewanPers' => $data['verifikasiDewanPers'],
            'noKlbi' => $normal($data['noKlbi']),
            'alamatPerusahaan' => $normal($data['alamatPerusahaan']),
            'alamatKecPerusahaan' => $normal($data['alamatKecPerusahaan']),
            'alamatKabPerusahaan' => $normal($data['alamatKabPerusahaan']),
            'alamatProvPerusahaan' => $normal($data['alamatProvPerusahaan']),
            'tlpnPerusahaan' => $normal($data['tlpnPerusahaan']),
            'emailPerusahaan' => $normal($data['emailPerusahaan']),
            'alamatWebsite' => $data['jenis_media'] === 'siber' ? null : $normal($data['alamatWebsite'] ?? null),
            'linkYoutube' => $normal($data['linkYoutube'] ?? null),
            'linkFacebook' => $normal($data['linkFacebook'] ?? null),
            'linkInstagram' => $normal($data['linkInstagram'] ?? null),
            'linkTiktok' => $normal($data['linkTiktok'] ?? null),
            'linkThreads' => $normal($data['linkThreads'] ?? null),
            'linkX' => $normal($data['linkX'] ?? null),
            'namaPimred' => $normal($data['namaPimred']),
            'serfikatUkwPimred' => $normal($data['serfikatUkwPimred']),
            'namaPimprus' => $normal($data['namaPimprus']),
            'jenisSerfikatUkwPimred' => $data['jenisSerfikatUkwPimred'],
            'izinIpp' => $request->input('jenis_media') === 'elektronik' ? $normal($data['izinIpp']) : null,
            'jenisJangkauanSiarMediaElektronik' => $request->input('jenis_media') === 'elektronik' ? $data['subjenis_elektronik'] : null,
            'fileNibPerusahaan' => $data['fileNibPerusahaan'],
            'fileKumhamPerusahaan' => $data['fileKumhamPerusahaan'],
            'fileNpwpPerusahaan' => $data['fileNpwpPerusahaan'],
            'fileIzinIpp' => $request->input('jenis_media') === 'elektronik' ? $data['fileIzinIpp'] : null,
            'fileSerfikatUkwPimred' => $data['fileSerfikatUkwPimred'],
            'fileSuratPernyataanPimred' => $data['jenisSerfikatUkwPimred'] === 'madya' ? $data['fileSuratPernyataanPimred'] : null,
            'namaPerwakilan' => $normal($data['namaPerwakilan']),
            'serfikatUkwPerwakilan' => $normal($data['serfikatUkwPerwakilan'] ?? null),
            'jenisSerfikatUkwPerwakilan' => $data['jenisSerfikatUkwPerwakilan'] ?? null,
            'alamatPerwakilan' => $normal($data['alamatPerwakilan'] ?? null),
            'alamatKecPerwakilan' => $normal($data['alamatKecPerwakilan']),
            'alamatKabPerwakilan' => $normal($data['alamatKabPerwakilan']),
            'alamatProvPerwakilan' => $normal($data['alamatProvPerwakilan']),
            'npwpPerwakilan' => $normal($data['npwpPerwakilan']),
            'organisasiWartawan' => $normal($wartawan),
            'organisasiPerusahaanPers' => $normal($perusahaanPers),
            'fileSuratKeteranganWartawan' => $data['fileSuratKeteranganWartawan'],
            'fileNpwpPerwakilan' => $data['fileNpwpPerwakilan'],
            'fileSerfikatUkwPerwakilan' => $data['fileSerfikatUkwPerwakilan'] ?? null,
            'fileBuktiKeanggotaanOrganisasiWartawan' => $data['fileBuktiKeanggotaanOrganisasiWartawan'] ?? null,
            'fileBuktiKeanggotaanOrganisasiPerusahaanPers' => $data['fileBuktiKeanggotaanOrganisasiPerusahaanPers'] ?? null,
        ];

        $query = new_media_pengajuan::query()->where('tahun_pengajuan', $tahun);
        if ($pengajuanNo) {
            $query->where('pengajuan_no', '!=', $pengajuanNo);
        }
        foreach (['namaPerusahaan' => 'Nama Perusahaan', 'namaMedia' => 'Nama Media'] as $column => $label) {
            if ((clone $query)->where($column, $base[$column])->exists()) {
                return response()->json(['massage' => "$label telah digunakan", 'icon' => 'error', 'title' => 'Operasi Gagal'], 422);
            }
        }

        $identityQuery = new_media_pengajuan::query();
        if ($pengajuanNo) {
            $identityQuery->where('pengajuan_no', '!=', $pengajuanNo);
        }
        foreach (['npwpPerwakilan' => 'NPWP Kepala Biro/Wartawan Perwakilan'] as $column => $label) {
            if ((clone $identityQuery)->where($column, $base[$column])->exists()) {
                return response()->json([
                    'massage' => "$label sudah terdaftar pada pengajuan lain. Pengajuan tidak dapat dikirim.",
                    'icon' => 'error',
                    'title' => "$label Sudah Digunakan",
                ], 422);
            }
        }
        if ($pengajuanNo) {
            new_media_pengajuan::where('pengajuan_no', $pengajuanNo)->update($base + ['keterangan' => '', 'status' => 'edit']);
            return response()->json(['massage' => 'Data berhasil diupdate', 'icon' => 'success', 'title' => 'Sukses', 'tahun_buka' => $tahun]);
        }
        if (new_media_pengajuan::where('id_user', Auth::id())->where('tahun_pengajuan', $tahun)->exists()) {
            return response()->json(['massage' => "Pengajuan tahun $tahun telah diajukan", 'icon' => 'error', 'title' => 'Operasi Gagal'], 422);
        }
        new_media_pengajuan::create($base + [
            'id_user' => Auth::id(),
            'pengajuan_no' => $tahun . '_' . Str::random(10),
            'status' => 'ajukan',
            'tahun_pengajuan' => $tahun,
        ]);
        return response()->json(['massage' => 'Data berhasil diinput', 'icon' => 'success', 'title' => 'Sukses']);
    }

    /** Hanya menerima kode lima digit, dengan awalan "KBLI" yang opsional. */
    private function normalizeKbliCode(string $value): ?string
    {
        return preg_match('/^(?:kbli\s*)?(\d{5})$/i', trim($value), $matches)
            ? $matches[1]
            : null;
    }

    /** Mengubah daftar KBLI yang dipisahkan koma menjadi kode-kode unik lima digit. */
    private function normalizeKbliCodes(string $value): array
    {
        $values = explode(',', $value);
        $codes = array_map(fn ($item) => $this->normalizeKbliCode($item), $values);

        return in_array(null, $codes, true) ? [] : array_values(array_unique($codes));
    }

    /**
     * upload media
     */
    public function upload_data(Request $request)
    {
        $request->validate([
            'data' => ['required', 'string', 'regex:/^[A-Za-z0-9_-]+$/'],
            'file' => ['required_unless:data,uploadsignature', 'file', 'mimes:pdf,png,jpg,jpeg', 'max:10240'],
        ], [
            'file.required_unless' => 'Pilih dokumen yang akan diunggah.',
            'file.file' => 'Dokumen yang dipilih tidak dapat dibaca. Silakan pilih ulang dokumen.',
            'file.mimes' => 'Dokumen harus berformat PDF, PNG, JPG, atau JPEG.',
            'file.max' => 'Ukuran dokumen maksimal 10 MB.',
        ]);
        $param = $request->data;
        $image = $request->images;
        $path = public_path('tmp/uploads/' . trim(strtolower($param), '#'));

        File::ensureDirectoryExists($path);

        if ($param == 'uploadsignature') {
            $data_uri =  $image;
            $encoded_image = explode(",", $data_uri)[1];
            $decoded_image = base64_decode($encoded_image);
            $original_name = 'signature_';
            $name = $original_name . Str::random(20) . ".png";
            $file = file_put_contents($path . '/' . $name, $decoded_image);
        } else {
            // nama file dan pindah ori
            $file = $request->file('file');
            $name = strtolower(Str::random(40) . '.' . $file->extension());
            $original_name = $file->getClientOriginalName();
            $file->move($path, $name);
        }
        return response()->json([
            'name'          => $name,
            'original_name' => $original_name,
        ]);
    }

    /**
     * checking URL
     */

    public function check_url(Request $request)
    {
        $domain = $request->input('namaMedia');

        // $ch = curl_init('https://' . $domain);
        $ch = curl_init($domain);

        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
        curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 3050);
        $output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode == 200) {
            echo "true";
        } elseif ($httpcode == 301 || $httpcode == 308) {
            echo "true";
        } elseif ($httpcode == 0) {
            echo "true";
        } else {
            echo "false";
        }
        exit;

        // $html_brand = $request->input('namaMedia');
        // $ch = curl_init();

        // $options = array(
        //     CURLOPT_URL            => $html_brand,
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_HEADER         => true,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_ENCODING       => "",
        //     CURLOPT_AUTOREFERER    => true,
        //     CURLOPT_CONNECTTIMEOUT => 5,
        //     CURLOPT_TIMEOUT        => 10,
        //     CURLOPT_MAXREDIRS      => 10,
        // );
        // curl_setopt_array($ch, $options);
        // $response = curl_exec($ch);
        // $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        // if ($httpCode != 200) {
        //     echo "Return code is {$httpCode} \n"
        //         . curl_error($ch);
        // } else {
        //     echo "<pre>" . htmlspecialchars($response) . "</pre>";
        // }

        // curl_close($ch);
        // dd($httpCode);
    }

    /**
     * show data pengajuan untuk cek data pengajuan ataupun untuk verifikasi data
     */
    public function show_data($no_pengajuan)
    {
        //declare
        $count = tahun::select('tahun')->where('pengajuan', 1)->count();
        if ($count == 0) {
            # code...
            $tahun_buka = date('Y');
        } else {
            $tahun_data = tahun::select('tahun')->where('pengajuan', 1)->get();
            $tahun_buka = json_decode(json_encode($tahun_data[0]->tahun));
        }

        $tahun_hitung = tahun::where('pengajuan', 1)->count();
        $pengajuan_cek = new_media_pengajuan::where('id_user', Auth::user()->id)->where('tahun_pengajuan', $tahun_buka)->count();
        $media_data = new_media_pengajuan::where('pengajuan_no', $no_pengajuan)->get();
        return view('admin.pengajuan.form_cek', [
            'pengajuan_buka' => $tahun_hitung,
            'pengajuan_data' => $pengajuan_cek,
            'media_data' => $media_data
        ]);
    }

    /**
     * show data pengajuan untuk cek data pengajuan ataupun untuk verifikasi data
     */
    public function show_data_verify($no_pengajuan)
    {
        //declare
        $count = tahun::select('tahun')->where('pengajuan', 1)->count();
        if ($count == 0) {
            # code...
            $tahun_buka = date('Y');
        } else {
            $tahun_data = tahun::select('tahun')->where('pengajuan', 1)->get();
            $tahun_buka = json_decode(json_encode($tahun_data[0]->tahun));
        }
        $tahun_verifikasi = tahun::select('verifikasi')->where('verifikasi', 1)->first();

        if (is_null($tahun_verifikasi)) {
            # code...
            $verifikasi = 0;
        } else {
            # code...
            $verifikasi = $tahun_verifikasi->verifikasi;
        }

        $tahun_hitung = tahun::where('pengajuan', 1)->count();
        $pengajuan_cek = new_media_pengajuan::where('id_user', Auth::user()->id)->where('tahun_pengajuan', $tahun_buka)->count();
        $media_data = new_media_pengajuan::where('pengajuan_no', $no_pengajuan)->get();
        return view('admin.pengajuan.form_verify', [
            'pengajuan_buka' => $tahun_hitung,
            'pengajuan_data' => $pengajuan_cek,
            'media_data' => $media_data,
            'tahun_verifikasi' => $verifikasi
        ]);
    }

    /**
     * verifikasi user  di terima maupun ditolak
     */
    public function verifikasi(Request $request)
    {
        $reviewRecord = new_media_pengajuan::where('pengajuan_no', $request->pengajuan_no)->firstOrFail();
        if ($request->param === 'terima' && !\App\Support\PengajuanReview::complete($reviewRecord)) {
            return response()->json(['message' => 'Verifikasi seluruh field wajib dan simpan checklist sebelum menerima pengajuan.'], 422);
        }
        $pengajuan_no = $request->pengajuan_no;
        $keterangan = $request->keterangan;
        $status = $request->status;
        $nilai = $request->nilai;
        $grade = $request->grade;
        $param = $request->param;
        $note = $request->note;

        function mapped_implode($glue, $array, $symbol = '. ')
        {
            return implode(
                $glue,
                array_map(
                    function ($k, $v) use ($symbol) {
                        return $k . $symbol . $v;
                    },
                    array_keys($array),
                    array_values($array)
                )
            );
        }

        $data_media = new_media_pengajuan::select(
            'new_media_pengajuans.id_user',
            'users.id',
            'new_media_pengajuans.pengajuan_no as idpengajuan',
            'new_media_pengajuans.jenis_media as jenis',
            'new_media_pengajuans.namaMedia as namamedia',
            'users.email as useremail',
            'new_media_pengajuans.status as status',
            'new_media_pengajuans.tahun_pengajuan as tahun'
        )->join('users', 'users.id', '=', 'new_media_pengajuans.id_user')->where('pengajuan_no', $pengajuan_no)->first();

        if ($data_media['status'] == 'ajukan' || $data_media['status'] == 'edit' || $data_media['status'] == 'tolak') {
            if ($param == 'terima') {
                # code...
                // data diterima
                $pesan = 'data dengan nomor pengajuan: ' . $pengajuan_no . ' berhasil diterima';
                $icon = 'success';
                $title = 'data berhasil terkirim';
                $data_keterangan = $keterangan;
                $stated = 'update';
                $keterangan_final = 'verify';
            } else {
                if ($keterangan) {
                    # code...
                    array_unshift($keterangan, "");
                    unset($keterangan[0]);
                    $number = 1;
                    foreach ($keterangan as $k) {
                        $number_data[] = $number++ . '. ';
                    }
                    $dataSendMail = mapped_implode(', <br>', $keterangan);

                    if ($param == 'undefinedValue') {
                        //  tidak dapat dinilai
                        $mailDatas = [
                            'jenis' => $data_media['jenis'],
                            'no' => $data_media['idpengajuan'],
                            'nama' => $data_media['namamedia'],
                            'keterangan' => 'Data Input Tidak Dapat Terdefinisi ' . $dataSendMail,
                            'detail_keterangan' => $note,
                            // 'waktu_perbaikan' => '5 Februari 2024 s/d 9 Februari 2024'
                            'waktu_perbaikan' => '-'
                        ];
                        // Mail::to($data_media['useremail'])->send(new notifVerifikasiTolak($mailDatas));
                        $data_keterangan = 'Data Input Tidak Terdefinisi';
                        $stated = 'update';
                        $pesan = 'data dengan nomor pengajuan: ' . $pengajuan_no . ' Tidak Dapat Dinilai';
                        $icon = 'success';
                        $title = 'Data Tidak Terdefinisi';
                        $keterangan_final = $data_keterangan . '<br><br>note <br>' . $note;
                    } else {
                        // data ditolak
                        $mailDatas = [
                            'jenis' => $data_media['jenis'],
                            'no' => $data_media['idpengajuan'],
                            'nama' => $data_media['namamedia'],
                            'keterangan' => $dataSendMail,
                            'detail_keterangan' => $note,
                            // 'waktu_perbaikan' => '5 Februari 2024 s/d 9 Februari 2024'
                            'waktu_perbaikan' => '-'
                        ];
                        // Mail::to($data_media['useremail'])->send(new notifVerifikasiTolak($mailDatas));
                        $data_keterangan = 'data ditolak silahkan cek data: <br>' . mapped_implode(', <br>', $keterangan);
                        $stated = 'update';
                        $pesan = 'data dengan nomor pengajuan: ' . $pengajuan_no . ' berhasil ditolak dan dikirim ke email ' . $data_media['useremail'];
                        $icon = 'success';
                        $title = 'data berhasil ditolak';
                        $keterangan_final = $data_keterangan . '<br><br>note <br>' . $note;
                    }
                } else {
                    $stated = null;
                    $pesan = 'Pilih Data Yang Akan Di Tolak';
                    $icon = 'error';
                    $title = 'Uncheck Data';
                }
                $grade = null;
                $nilai = null;
            }
            if ($stated == 'update') {
                # code...
                new_media_pengajuan::where('pengajuan_no', $pengajuan_no)->update(
                    [
                        'keterangan' => $keterangan_final,
                        'status' => $status,
                        'nilai' => $grade,
                        'nilaiDalamAngka' => $nilai,
                        'buka_edit' => 'tidak'
                    ]
                );
            }
        } else {
            $pesan = 'Data Dengan Nomor Pengajuan: ' . $pengajuan_no . ' Sudah Diverifikasi';
            $icon = 'error';
            $title = 'Data Sudah Diverifikasi';
        }
        return response()->json([
            'massage' => $pesan,
            'icon' => $icon,
            'title' => $title,
            'tahun' => $data_media['tahun']
        ]);
    }

    public function send_mail(Request $request)
    {
        $pengajuan_no = $request->no;
        $data_media = new_media_pengajuan::select(
            'new_media_pengajuans.id_user',
            'users.id',
            'new_media_pengajuans.pengajuan_no as idpengajuan',
            'new_media_pengajuans.jenis_media as jenis',
            'new_media_pengajuans.namaMedia as namamedia',
            'users.email as useremail',
            'new_media_pengajuans.status as status',
            'new_media_pengajuans.tahun_pengajuan as tahun',
            'new_media_pengajuans.keterangan as keterangan'
        )->join('users', 'users.id', '=', 'new_media_pengajuans.id_user')
            ->where('pengajuan_no', $pengajuan_no)
            ->first();

        function implodes($glue, $array, $symbol = '. ')
        {
            return implode(
                $glue,
                array_map(
                    function ($k, $v) use ($symbol) {
                        return $k . $symbol . $v;
                    },
                    array_keys($array),
                    array_values($array)
                )
            );
        }

        $mailDatas = [
            'jenis' => $data_media['jenis'],
            'no' => $data_media['idpengajuan'],
            'nama' => $data_media['namamedia'],
            'keterangan' => $data_media->keterangan,
            'detail_keterangan' => '',
            'waktu_perbaikan' => '-'
        ];
        // Mail::to($data_media['useremail'])->send(new notifVerifikasiTolak($mailDatas));

        $pesan = 'Data Dengan Nomor Pengajuan: ' . $pengajuan_no . ' Dikirim Ke Email ' . $data_media['namamedia'];
        $icon = 'success';
        $title = 'Data Terkirim';

        return response()->json([
            'massage' => $pesan,
            'icon' => $icon,
            'title' => $title,
        ]);
    }
}
