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

class MediaPengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

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
        //

        $tahun = tahun::select('tahun')->where('pengajuan', 1)->get();
        $tahun_buka = json_decode(json_encode($tahun[0]->tahun));
        $pengajuan_no =  $tahun_buka . '_' . Str::random(10);
        $jenis_media = strtolower($request->jenis_media);

        $namaPerusahaan = str_replace('  ', ' ', strtolower($request->namaPerusahaan));
        $namaPenanggungJawab = strtolower($request->namaPenanggungJawab);
        $namaPimred = strtolower($request->namaPimred);
        $kumhamPerusahaan = strtolower($request->kumhamPerusahaan);
        $alamatPerusahaan = strtolower($request->alamatPerusahaan);
        $tlpnPerusahaan = strtolower($request->tlpnPerusahaan);
        $emailPerusahaan = strtolower($request->emailPerusahaan);
        $npwpPerusahaan = strtolower($request->npwpPerusahaan);
        $nibPerusahaan = strtolower($request->nibPerusahaan);
        $noKbki = strtolower($request->noKbki);
        $izinIpp = strtolower($request->izinIpp);
        $namaPercetakan = strtolower($request->namaPercetakan);
        $alamatProvPerusahaan = strtolower($request->alamatProvPerusahaan);
        $alamatKabPerusahaan = strtolower($request->alamatKabPerusahaan);
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
        $verifikasiDewanPers = strtolower($request->verifikasiDewanPers);
        $jenisSerfikatUkwPimred = strtolower($request->jenisSerfikatUkwPimred);
        $afiliasiPerusahaan = strtolower($request->afiliasiPerusahaan);
        $domisiliRedaksiMedia = strtolower($request->domisiliRedaksiMedia);
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
                    $pengajuan->kumhamPerusahaan = $kumhamPerusahaan;
                    $pengajuan->alamatPerusahaan = $alamatPerusahaan;
                    $pengajuan->tlpnPerusahaan = $tlpnPerusahaan;
                    $pengajuan->emailPerusahaan = $emailPerusahaan;
                    $pengajuan->npwpPerusahaan = $npwpPerusahaan;
                    $pengajuan->nibPerusahaan = $nibPerusahaan;
                    $pengajuan->noKbki = $noKbki;
                    $pengajuan->izinIpp = $izinIpp;
                    $pengajuan->namaPercetakan = $namaPercetakan;
                    $pengajuan->alamatProvPerusahaan = $alamatProvPerusahaan;
                    $pengajuan->alamatKabPerusahaan = $alamatKabPerusahaan;
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
        //
        // // Perusahaan
        // $nama_perusahaan = str_replace('  ', ' ', strtolower($request->nama_perusahaan));
        // $nama_pimred = strtolower($request->nama_pimred);
        // $alamat_perusahaan = strtolower($request->alamat_perusahaan);
        // $tlpn_perusahaan = strtolower($request->tlpn_perusahaan);
        // $email_perusahaan = strtolower($request->email_perusahaan);
        // $npwp_perusahaan = strtolower($request->npwp_perusahaan);
        // $akta_perusahaan = strtolower($request->akta_perusahaan);
        // $kumham_perusahaan = strtolower($request->kumham_perusahaan);
        // $wartawan_kompeten_perusahaan = strtolower($request->wartawan_kompeten_perusahaan);
        // $nama_percetakan = strtolower($request->nama_percetakan);
        // $alamat_percetakan = strtolower($request->alamat_percetakan);
        // // file
        // $file_npwp_perusahaan = $request->file_npwp_perusahaan;
        // $file_akta_perusahaan = $request->file_akta_perusahaan;
        // $file_kumham_perusahaan = $request->file_kumham_perusahaan;
        // $file_wartawan_kompeten_perusahaan = $request->file_wartawan_kompeten_perusahaan;
        // $file_dewan_pers_perusahaan = $request->file_dewan_pers_perusahaan;
        // $file_afiliasi_perusahaan = $request->file_afiliasi_perusahaan;
        // $file_spt_perusahaan = $request->file_spt_perusahaan;
        // $file_domisili_perusahaan = $request->file_domisili_perusahaan;
        // $file_kuasa_perwakilan = $request->file_kuasa_perwakilan;
        // $file_kerjasama = $request->file_kerjasama;
        // $file_izin_ipp = $request->file_izin_ipp;
        // // perwakilan
        // $nama_media = strtolower($request->nama_media);
        // $nama_biro_perwakilan = strtolower($request->nama_biro_perwakilan);
        // $alamat_perwakilan = strtolower($request->alamat_perwakilan);
        // $tlpn_perwakilan = strtolower($request->tlpn_perwakilan);
        // $email_perwakilan = strtolower($request->email_perwakilan);
        // $ktp_perwakilan = strtolower($request->ktp_perwakilan);
        // $kk_perwakilan = strtolower($request->kk_perwakilan);
        // $npwp_perwakilan = strtolower($request->npwp_perwakilan);
        // $kompetensi_perwakilan = strtolower($request->kompetensi_perwakilan);
        // $jenis_rekening = strtolower($request->jenis_rekening);
        // $nama_bank = strtolower($request->nama_bank);
        // $pemilik_rekening = strtolower($request->pemilik_rekening);
        // $no_rekening = strtolower($request->no_rekening);
        // // file
        // $file_ktp_perwakilan = $request->file_ktp_perwakilan;
        // $file_kk_perwakilan = $request->file_kk_perwakilan;
        // $file_npwp_perwakilan = $request->file_npwp_perwakilan;
        // $file_kopetensi_perwakilan = $request->file_kopetensi_perwakilan;
        // $file_afiliasi_perwakilan = $request->file_afiliasi_perwakilan;
        // $file_domisili_perwakilan = $request->file_domisili_perwakilan;
        // $file_kode_etik_perwakilan = $request->file_kode_etik_perwakilan;
        // $file_pernyataan_media_perwakilan = $request->file_pernyataan_media_perwakilan;
        // $file_rekening = $request->file_rekening;
        // $file_signature_data = $request->file_signature_data;

        $tahun = tahun::select('tahun')->where('pengajuan', 1)->get();
        $tahun_buka = json_decode(json_encode($tahun[0]->tahun));
        // $pengajuan_no =  $tahun_buka . '_' . Str::random(10);
        // $jenis_media = strtolower($request->jenis_media);

        $pengajuan_no =  $request->pengajuan_no;
        $jenis_media = strtolower($request->jenis_media);
        $namaPerusahaan = str_replace('  ', ' ', strtolower($request->namaPerusahaan));
        $namaPenanggungJawab = strtolower($request->namaPenanggungJawab);
        $namaPimred = strtolower($request->namaPimred);
        $kumhamPerusahaan = strtolower($request->kumhamPerusahaan);
        $alamatPerusahaan = strtolower($request->alamatPerusahaan);
        $tlpnPerusahaan = strtolower($request->tlpnPerusahaan);
        $emailPerusahaan = strtolower($request->emailPerusahaan);
        $npwpPerusahaan = strtolower($request->npwpPerusahaan);
        $nibPerusahaan = strtolower($request->nibPerusahaan);
        $noKbki = strtolower($request->noKbki);
        $izinIpp = strtolower($request->izinIpp);
        $namaPercetakan = strtolower($request->namaPercetakan);
        $alamatProvPerusahaan = strtolower($request->alamatProvPerusahaan);
        $alamatKabPerusahaan = strtolower($request->alamatKabPerusahaan);
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
        $verifikasiDewanPers = strtolower($request->verifikasiDewanPers);
        $jenisSerfikatUkwPimred = strtolower($request->jenisSerfikatUkwPimred);
        $afiliasiPerusahaan = strtolower($request->afiliasiPerusahaan);
        $domisiliRedaksiMedia = strtolower($request->domisiliRedaksiMedia);
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

        $tahun = tahun::select('tahun')->where('pengajuan_edit', 1)->get();
        $tahun_edit = json_decode(json_encode($tahun[0]->tahun));
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
        } else {
            // update
            $data = [
                // 'jenis_media' => $jenis_media,
                // 'namaPerusahaan' => $namaPerusahaan,
                // 'namaPenanggungJawab' => $namaPenanggungJawab,
                // 'namaPimred' => $namaPimred,
                // 'kumhamPerusahaan' => $kumhamPerusahaan,
                // 'alamatPerusahaan' => $alamatPerusahaan,
                // 'tlpnPerusahaan' => $tlpnPerusahaan,
                // 'emailPerusahaan' => $emailPerusahaan,
                // 'npwpPerusahaan' => $npwpPerusahaan,
                // 'nibPerusahaan' => $nibPerusahaan,
                // 'noKbki' => $noKbki,
                // 'izinIpp' => $izinIpp,
                // 'namaPercetakan' => $namaPercetakan,
                // 'alamatProvPerusahaan' => $alamatProvPerusahaan,
                // 'alamatKabPerusahaan' => $alamatKabPerusahaan,
                // 'statusKswp' => $statusKswp,
                // 'noKlbi' => $noKlbi,
                'fileSuratPernyataanPimred' => $fileSuratPernyataanPimred,
                'fileKumhamPerusahaan' => $fileKumhamPerusahaan,
                'fileNpwpPerusahaan' => $fileNpwpPerusahaan,
                'fileNibPerusahaan' => $fileNibPerusahaan,
                'fileIzinIpp' => $fileIzinIpp,
                // 'namaMedia' => $namaMedia,
                // 'serfikatUkwPimred' => $serfikatUkwPimred,
                // 'namaBank' => $namaBank,
                // 'pemilikRekening' => $pemilikRekening,
                // 'noRekening' => $noRekening,
                // 'verifikasiDewanPers' => $verifikasiDewanPers,
                // 'jenisSerfikatUkwPimred' => $jenisSerfikatUkwPimred,
                // 'afiliasiPerusahaan' => $afiliasiPerusahaan,
                // 'domisiliRedaksiMedia' => $domisiliRedaksiMedia,
                // 'kanalKhusus' => $kanalKhusus,
                // 'jenisRekening' => $jenisRekening,
                'fileSerfikatUkwPimred' => $fileSerfikatUkwPimred,
                'fileAfiliasiPerusahaan' => $fileAfiliasiPerusahaan,
                'fileDomisiliRedaksiMedia' => $fileDomisiliRedaksiMedia,
                'fileKanalKhusus' => $fileKanalKhusus,
                'fileRekening' => $fileRekening,
                // 'tahunBerdiriMedia' => $tahunBerdiriMedia,
                // 'jenisJangkauanSiarMediaElektronik' => $jenisJangkauanSiarMediaElektronik,
                // 'jangkauanSiarMediaElektronik' => $jangkauanSiarMediaElektronik,
                // 'jumlahOplahMediaCetakPerMinggu' => $jumlahOplahMediaCetakPerMinggu,
                'fileJumlahOplahMediaCetakPerMinggu' => $fileJumlahOplahMediaCetakPerMinggu,
                // 'jumlahKontenBeritaAktif' => $jumlahKontenBeritaAktif,
                // 'namaPerwakilan' => $namaPerwakilan,
                // 'nomorKKPerwakilan' => $nomorKKPerwakilan,
                // 'nomorKtpPerwakilan' => $nomorKtpPerwakilan,
                // 'npwpPerwakilan' => $npwpPerwakilan,
                // 'serfikatUkwPerwakilan' => $serfikatUkwPerwakilan,
                // 'afiliasiPersPerwakilan' => $afiliasiPersPerwakilan,
                // 'alamatPerwakilan' => $alamatPerwakilan,
                // 'tlpnPerwakilan' => $tlpnPerwakilan,
                // 'emailPerwakilan' => $emailPerwakilan,
                // 'jenisSerfikatUkwPerwakilan' => $jenisSerfikatUkwPerwakilan,
                // 'alamatProvPerwakilan' => $alamatProvPerwakilan,
                // 'alamatKabPerwakilan' => $alamatKabPerwakilan,
                // 'alamatKecPerwakilan' => $alamatKecPerwakilan,
                // 'alamatKelPerwakilan' => $alamatKelPerwakilan,
                'fileNpwpPerwakilan' => $fileNpwpPerwakilan,
                'fileSerfikatUkwPerwakilan' => $fileSerfikatUkwPerwakilan,
                'fileafiliasiPersPerwakilan' => $fileafiliasiPersPerwakilan,
                // 'keterangan' => '',
                // 'status' => 'edit'
            ];

            // $directory = __DIR__;
            foreach ($data as $key => $value) {
                $directory =  public_path('tmp/uploads/' . $key);
                $images = glob($directory . "/*", GLOB_BRACE);
                foreach ($images as $img) {
                    if (strtolower(pathinfo($img)['basename']) == $value) {
                        # code...
                        $out[] = pathinfo($img)['basename'];
                    } else {
                        $out[] = 0;
                    }
                }
                foreach ($out as $o) {
                    # code...
                    if (!($o == 0)) {
                        # code...
                        $print = $o;
                    }
                }
                // dd($key);
                if ($print) {
                    # code...
                    // dd($print);
                    $path[] =  'tmp/uploads/' . strtolower($key);
                    // rename($path . '/' . $print, $path . '/' . $value);
                }
            }
            dd($path);
            // $pengajuan_update = new_media_pengajuan::where('pengajuan_no', $pengajuan_no)->update($data);

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
     * upload media
     */
    public function upload_data(Request $request)
    {
        $param = $request->data;
        $image = $request->images;
        $path = public_path('tmp/uploads/' . trim(strtolower($param), '#'));

        if (!$path) {
            Storage::makeDirectory($path);
        }

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
            $name = Str::random(40) . '.' . $file->extension();
            $original_name = $file->getClientOriginalName();
            $file->move($path, strtolower($name));
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

        // dd($httpcode);
        if ($httpcode == 200) {
            echo "true";
        } elseif ($httpcode == 301 || $httpcode == 308) {
            echo "true";
        } else {
            echo "false";
        }
        exit;
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

        $tahun_hitung = tahun::where('pengajuan', 1)->count();
        $pengajuan_cek = new_media_pengajuan::where('id_user', Auth::user()->id)->where('tahun_pengajuan', $tahun_buka)->count();
        $media_data = new_media_pengajuan::where('pengajuan_no', $no_pengajuan)->get();
        return view('admin.pengajuan.form_verify', [
            'pengajuan_buka' => $tahun_hitung,
            'pengajuan_data' => $pengajuan_cek,
            'media_data' => $media_data
        ]);
    }

    /**
     * verifikasi user  di terima maupun ditolak
     */
    public function verifikasi(Request $request)
    {
        // $pengajuan_no = $request->pengajuan_no;
        // $keterangan = $request->keterangan;
        // $status = $request->status;
        // $data = $request->data;

        // function mapped_implode($glue, $array, $symbol = '. ')
        // {
        //     return implode(
        //         $glue,
        //         array_map(
        //             function ($k, $v) use ($symbol) {
        //                 return $k . $symbol . $v;
        //             },
        //             array_keys($array),
        //             array_values($array)
        //         )
        //     );
        // }

        // $data_media = new_media_pengajuan::select(
        //     'new_media_pengajuans.id_user',
        //     'users.id',
        //     'new_media_pengajuans.pengajuan_no as idpengajuan',
        //     'new_media_pengajuans.jenis_media as jenis',
        //     'new_media_pengajuans.namaMedia as namamedia',
        //     'users.email as useremail',
        //     'new_media_pengajuans.status as status'
        // )->join('users', 'users.id', '=', 'new_media_pengajuans.id_user')->where('pengajuan_no', $pengajuan_no)->first();



        // dd($data);
        // function mapped_implode($glue, $array, $symbol = '. ')
        // {
        //     return implode(
        //         $glue,
        //         array_map(
        //             function ($k, $v) use ($symbol) {
        //                 return $k . $symbol . $v;
        //             },
        //             array_keys($array),
        //             array_values($array)
        //         )
        //     );
        // }

        // $pengajuan_no = $request->pengajuan_no;
        // $keterangan = $request->keterangan;
        // $status = $request->status;

        // $data_media = media_pengajuan::select(
        //     'media_pengajuans.id_user',
        //     'users.id',
        //     'media_pengajuans.pengajuan_no as idpengajuan',
        //     'media_pengajuans.jenis_media as jenis',
        //     'media_pengajuans.nama_media as namamedia',
        //     'users.email as useremail',
        //     'media_pengajuans.status as status'
        // )->join('users', 'users.id', '=', 'media_pengajuans.id_user')->where('pengajuan_no', $pengajuan_no)->first();

        // if ($data_media['status'] == 'ajukan' || $data_media['status'] == 'edit') {
        //     if ($status == 'terima') {
        //         // data diterima
        //         $pesan = 'data dengan nomor pengajuan: ' . $pengajuan_no . ' berhasil diterima';
        //         $data_keterangan = $keterangan;
        //     } else {
        //         // data ditolak
        //         array_unshift($keterangan, "");
        //         unset($keterangan[0]);
        //         $number = 1;
        //         foreach ($keterangan as $k) {
        //             $number_data[] = $number++ . '. ';
        //         }
        //         $data_keterangan = 'data ditolak silahkan cek data: <br>' . mapped_implode(', <br>', $keterangan);
        //         $dataSendMail = mapped_implode(', <br>', $keterangan);
        //         $pesan = 'data dengan nomor pengajuan: ' . $pengajuan_no . ' ditolak';

        //         $mailDatas = [
        //             'jenis' => $data_media['jenis'],
        //             'no' => $data_media['idpengajuan'],
        //             'nama' => $data_media['namamedia'],
        //             'keterangan' => $dataSendMail
        //         ];

        //         Mail::to($data_media['useremail'])->send(new notifVerifikasiTolak($mailDatas));
        //     }


        //     media_pengajuan::where('pengajuan_no', $pengajuan_no)->update(
        //         [
        //             'keterangan' => $data_keterangan,
        //             'status' => $status
        //         ]
        //     );
        //     $icon = 'success';
        //     $title = 'data berhasil terkirim';
        // } else {
        //     $pesan = 'Data Dengan Nomor Pengajuan: ' . $pengajuan_no . ' Sudah Diverifikasi';
        //     $icon = 'error';
        //     $title = 'Data Sudah Diverifikasi';
        // }
        // return response()->json([
        //     'massage' => $pesan,
        //     'icon' => $icon,
        //     'title' => $title
        // ]);




        // // Perusahaan
        // $nama_perusahaan = str_replace('  ', ' ', strtolower($request->nama_perusahaan));
        // $nama_pimred = strtolower($request->nama_pimred);
        // $alamat_perusahaan = strtolower($request->alamat_perusahaan);
        // $tlpn_perusahaan = strtolower($request->tlpn_perusahaan);
        // $email_perusahaan = strtolower($request->email_perusahaan);
        // $npwp_perusahaan = strtolower($request->npwp_perusahaan);
        // $akta_perusahaan = strtolower($request->akta_perusahaan);
        // $kumham_perusahaan = strtolower($request->kumham_perusahaan);
        // $wartawan_kompeten_perusahaan = strtolower($request->wartawan_kompeten_perusahaan);
        // $nama_percetakan = strtolower($request->nama_percetakan);
        // $alamat_percetakan = strtolower($request->alamat_percetakan);
        // // file
        // $file_npwp_perusahaan = $request->file_npwp_perusahaan;
        // $file_akta_perusahaan = $request->file_akta_perusahaan;
        // $file_kumham_perusahaan = $request->file_kumham_perusahaan;
        // $file_wartawan_kompeten_perusahaan = $request->file_wartawan_kompeten_perusahaan;
        // $file_dewan_pers_perusahaan = $request->file_dewan_pers_perusahaan;
        // $file_afiliasi_perusahaan = $request->file_afiliasi_perusahaan;
        // $file_spt_perusahaan = $request->file_spt_perusahaan;
        // $file_domisili_perusahaan = $request->file_domisili_perusahaan;
        // $file_kuasa_perwakilan = $request->file_kuasa_perwakilan;
        // $file_kerjasama = $request->file_kerjasama;
        // $file_izin_ipp = $request->file_izin_ipp;
        // // perwakilan
        // $nama_media = strtolower($request->nama_media);
        // $nama_biro_perwakilan = strtolower($request->nama_biro_perwakilan);
        // $alamat_perwakilan = strtolower($request->alamat_perwakilan);
        // $tlpn_perwakilan = strtolower($request->tlpn_perwakilan);
        // $email_perwakilan = strtolower($request->email_perwakilan);
        // $ktp_perwakilan = strtolower($request->ktp_perwakilan);
        // $kk_perwakilan = strtolower($request->kk_perwakilan);
        // $npwp_perwakilan = strtolower($request->npwp_perwakilan);
        // $kompetensi_perwakilan = strtolower($request->kompetensi_perwakilan);
        // $jenis_rekening = strtolower($request->jenis_rekening);
        // $nama_bank = strtolower($request->nama_bank);
        // $pemilik_rekening = strtolower($request->pemilik_rekening);
        // $no_rekening = strtolower($request->no_rekening);
        // // file
        // $file_ktp_perwakilan = $request->file_ktp_perwakilan;
        // $file_kk_perwakilan = $request->file_kk_perwakilan;
        // $file_npwp_perwakilan = $request->file_npwp_perwakilan;
        // $file_kopetensi_perwakilan = $request->file_kopetensi_perwakilan;
        // $file_afiliasi_perwakilan = $request->file_afiliasi_perwakilan;
        // $file_domisili_perwakilan = $request->file_domisili_perwakilan;
        // $file_kode_etik_perwakilan = $request->file_kode_etik_perwakilan;
        // $file_pernyataan_media_perwakilan = $request->file_pernyataan_media_perwakilan;
        // $file_rekening = $request->file_rekening;
        // $file_signature_data = $request->file_signature_data;


        // $tahun = tahun::select('tahun')->where('pengajuan', 1)->get();
        // $tahun_buka = json_decode(json_encode($tahun[0]->tahun));
        // $pengajuan_no =  $tahun_buka . '_' . Str::random(10);
        // $jenis_media = strtolower($request->jenis_media);

        $pengajuan_no =  $request->pengajuan_no;
        $jenis_media = strtolower($request->jenis_media);
        $namaPerusahaan = str_replace('  ', ' ', strtolower($request->namaPerusahaan));
        $namaPenanggungJawab = strtolower($request->namaPenanggungJawab);
        $namaPimred = strtolower($request->namaPimred);
        $kumhamPerusahaan = strtolower($request->kumhamPerusahaan);
        $alamatPerusahaan = strtolower($request->alamatPerusahaan);
        $tlpnPerusahaan = strtolower($request->tlpnPerusahaan);
        $emailPerusahaan = strtolower($request->emailPerusahaan);
        $npwpPerusahaan = strtolower($request->npwpPerusahaan);
        $nibPerusahaan = strtolower($request->nibPerusahaan);
        $noKbki = strtolower($request->noKbki);
        $izinIpp = strtolower($request->izinIpp);
        $namaPercetakan = strtolower($request->namaPercetakan);
        $alamatProvPerusahaan = strtolower($request->alamatProvPerusahaan);
        $alamatKabPerusahaan = strtolower($request->alamatKabPerusahaan);
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
        $verifikasiDewanPers = strtolower($request->verifikasiDewanPers);
        $jenisSerfikatUkwPimred = strtolower($request->jenisSerfikatUkwPimred);
        $afiliasiPerusahaan = strtolower($request->afiliasiPerusahaan);
        $domisiliRedaksiMedia = strtolower($request->domisiliRedaksiMedia);
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

        $tahun = tahun::select('tahun')->where('pengajuan_edit', 1)->get();
        $tahun_edit = json_decode(json_encode($tahun[0]->tahun));
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
        } else {
            // update
            $data = [
                // 'jenis_media' => $jenis_media,
                // 'namaPerusahaan' => $namaPerusahaan,
                // 'namaPenanggungJawab' => $namaPenanggungJawab,
                // 'namaPimred' => $namaPimred,
                // 'kumhamPerusahaan' => $kumhamPerusahaan,
                // 'alamatPerusahaan' => $alamatPerusahaan,
                // 'tlpnPerusahaan' => $tlpnPerusahaan,
                // 'emailPerusahaan' => $emailPerusahaan,
                // 'npwpPerusahaan' => $npwpPerusahaan,
                // 'nibPerusahaan' => $nibPerusahaan,
                // 'noKbki' => $noKbki,
                // 'izinIpp' => $izinIpp,
                // 'namaPercetakan' => $namaPercetakan,
                // 'alamatProvPerusahaan' => $alamatProvPerusahaan,
                // 'alamatKabPerusahaan' => $alamatKabPerusahaan,
                // 'statusKswp' => $statusKswp,
                // 'noKlbi' => $noKlbi,
                'fileSuratPernyataanPimred' => $fileSuratPernyataanPimred,
                'fileKumhamPerusahaan' => $fileKumhamPerusahaan,
                'fileNpwpPerusahaan' => $fileNpwpPerusahaan,
                'fileNibPerusahaan' => $fileNibPerusahaan,
                'fileIzinIpp' => $fileIzinIpp,
                // 'namaMedia' => $namaMedia,
                // 'serfikatUkwPimred' => $serfikatUkwPimred,
                // 'namaBank' => $namaBank,
                // 'pemilikRekening' => $pemilikRekening,
                // 'noRekening' => $noRekening,
                // 'verifikasiDewanPers' => $verifikasiDewanPers,
                // 'jenisSerfikatUkwPimred' => $jenisSerfikatUkwPimred,
                // 'afiliasiPerusahaan' => $afiliasiPerusahaan,
                // 'domisiliRedaksiMedia' => $domisiliRedaksiMedia,
                // 'kanalKhusus' => $kanalKhusus,
                // 'jenisRekening' => $jenisRekening,
                'fileSerfikatUkwPimred' => $fileSerfikatUkwPimred,
                'fileAfiliasiPerusahaan' => $fileAfiliasiPerusahaan,
                'fileDomisiliRedaksiMedia' => $fileDomisiliRedaksiMedia,
                'fileKanalKhusus' => $fileKanalKhusus,
                'fileRekening' => $fileRekening,
                // 'tahunBerdiriMedia' => $tahunBerdiriMedia,
                // 'jenisJangkauanSiarMediaElektronik' => $jenisJangkauanSiarMediaElektronik,
                // 'jangkauanSiarMediaElektronik' => $jangkauanSiarMediaElektronik,
                // 'jumlahOplahMediaCetakPerMinggu' => $jumlahOplahMediaCetakPerMinggu,
                'fileJumlahOplahMediaCetakPerMinggu' => $fileJumlahOplahMediaCetakPerMinggu,
                // 'jumlahKontenBeritaAktif' => $jumlahKontenBeritaAktif,
                // 'namaPerwakilan' => $namaPerwakilan,
                // 'nomorKKPerwakilan' => $nomorKKPerwakilan,
                // 'nomorKtpPerwakilan' => $nomorKtpPerwakilan,
                // 'npwpPerwakilan' => $npwpPerwakilan,
                // 'serfikatUkwPerwakilan' => $serfikatUkwPerwakilan,
                // 'afiliasiPersPerwakilan' => $afiliasiPersPerwakilan,
                // 'alamatPerwakilan' => $alamatPerwakilan,
                // 'tlpnPerwakilan' => $tlpnPerwakilan,
                // 'emailPerwakilan' => $emailPerwakilan,
                // 'jenisSerfikatUkwPerwakilan' => $jenisSerfikatUkwPerwakilan,
                // 'alamatProvPerwakilan' => $alamatProvPerwakilan,
                // 'alamatKabPerwakilan' => $alamatKabPerwakilan,
                // 'alamatKecPerwakilan' => $alamatKecPerwakilan,
                // 'alamatKelPerwakilan' => $alamatKelPerwakilan,
                'fileNpwpPerwakilan' => $fileNpwpPerwakilan,
                'fileSerfikatUkwPerwakilan' => $fileSerfikatUkwPerwakilan,
                'fileafiliasiPersPerwakilan' => $fileafiliasiPersPerwakilan,
                // 'keterangan' => '',
                // 'status' => 'edit'
            ];

            // $directory = __DIR__;
            foreach ($data as $key => $value) {
                $directory =  public_path('tmp/uploads/' . strtolower($key));
                $images = glob($directory . "/*");

                // foreach ($out as $o) {
                //     # code...
                //     if (!($o == 0)) {
                //         # code...
                //         $print = $o;
                //     } else {
                //         $print = null;
                //     }
                // }
                // // dd($print);
                // if ($print) {
                //     # code...
                //     // dd($print);
                //     if ($value) {
                //         $path =   public_path('tmp/uploads/' . strtolower($key));
                //         # code...
                //         rename($path . '/' . $print, $path . '/' . $value);
                //     }
                // }
                foreach ($images as $img) {
                    $out = pathinfo($img)['basename'];
                }
            }

            dd($out);
            // $pengajuan_update = new_media_pengajuan::where('pengajuan_no', $pengajuan_no)->update($data);

            $pesan = 'data berhasil diupdate';
            $icon = 'success';
            $title = 'Sukses';
        }
    }
}
