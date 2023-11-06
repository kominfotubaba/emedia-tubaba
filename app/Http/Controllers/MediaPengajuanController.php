<?php

namespace App\Http\Controllers;

use App\Mail\notifVerifikasiTolak;
use App\Models\media_pengajuan;
use App\Models\tahun;
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
        $pengajuan_data = media_pengajuan::where('id_user', Auth::user()->id)->where('tahun_pengajuan', $tahun_buka)->count();
        // $pengajuan_data = media_pengajuan::where('id_user', Auth::user()->id)->count();
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
        $nama_perusahaan = str_replace('  ', ' ', strtolower($request->nama_perusahaan));
        $nama_pimred = strtolower($request->nama_pimred);
        $alamat_perusahaan = strtolower($request->alamat_perusahaan);
        $tlpn_perusahaan = strtolower($request->tlpn_perusahaan);
        $email_perusahaan = strtolower($request->email_perusahaan);
        $npwp_perusahaan = strtolower($request->npwp_perusahaan);
        $akta_perusahaan = strtolower($request->akta_perusahaan);
        $kumham_perusahaan = strtolower($request->kumham_perusahaan);
        $wartawan_kompeten_perusahaan = strtolower($request->wartawan_kompeten_perusahaan);
        $nama_percetakan = strtolower($request->nama_percetakan);
        $alamat_percetakan = strtolower($request->alamat_percetakan);
        // file
        // $file_npwp_perusahaan = URL::to('/tmp/uploads/fileNpwpPerusahaan/' .  $request->file_npwp_perusahaan);
        // $file_akta_perusahaan = URL::to('/tmp/uploads/fileAktaPerusahaan/' . $request->file_akta_perusahaan);
        // $file_kumham_perusahaan = URL::to('/tmp/uploads/fileKumhamPerusahaan/' . $request->file_kumham_perusahaan);
        // $file_dewan_pers_perusahaan = URL::to('/tmp/uploads/fileDewanPersPerusahaan/' . $request->file_dewan_pers_perusahaan);
        // $file_spt_perusahaan = URL::to('/tmp/uploads/fileSptPerusahaan/' . $request->file_spt_perusahaan);
        // $file_domisili_perusahaan = URL::to('/tmp/uploads/fileDomisiliPerusahaan/' . $request->file_domisili_perusahaan);
        // $file_kuasa_perwakilan = URL::to('/tmp/uploads/fileKuasaPerwakilan/' . $request->file_kuasa_perwakilan);
        // $file_kerjasama = URL::to('/tmp/uploads/fileKerjasama/' . $request->file_kerjasama);
        $file_npwp_perusahaan = $request->file_npwp_perusahaan;
        $file_akta_perusahaan = $request->file_akta_perusahaan;
        $file_kumham_perusahaan = $request->file_kumham_perusahaan;
        $file_wartawan_kompeten_perusahaan = $request->file_wartawan_kompeten_perusahaan;
        $file_dewan_pers_perusahaan = $request->file_dewan_pers_perusahaan;
        $file_afiliasi_perusahaan = $request->file_afiliasi_perusahaan;
        $file_spt_perusahaan = $request->file_spt_perusahaan;
        $file_domisili_perusahaan = $request->file_domisili_perusahaan;
        $file_kuasa_perwakilan = $request->file_kuasa_perwakilan;
        $file_kerjasama = $request->file_kerjasama;
        $file_izin_ipp = $request->file_izin_ipp;

        // perwakilan
        $nama_media = strtolower($request->nama_media);
        $nama_biro_perwakilan = strtolower($request->nama_biro_perwakilan);
        $alamat_perwakilan = strtolower($request->alamat_perwakilan);
        $tlpn_perwakilan = strtolower($request->tlpn_perwakilan);
        $email_perwakilan = strtolower($request->email_perwakilan);
        $ktp_perwakilan = strtolower($request->ktp_perwakilan);
        $kk_perwakilan = strtolower($request->kk_perwakilan);
        $npwp_perwakilan = strtolower($request->npwp_perwakilan);
        $kompetensi_perwakilan = strtolower($request->kompetensi_perwakilan);
        $jenis_rekening = strtolower($request->jenis_rekening);
        $nama_bank = strtolower($request->nama_bank);
        $pemilik_rekening = strtolower($request->pemilik_rekening);
        $no_rekening = strtolower($request->no_rekening);
        // file
        // $file_ktp_perwakilan = URL::to('/tmp/uploads/fileKtpPerwakilan/' . $request->file_ktp_perwakilan);
        // $file_kk_perwakilan = URL::to('/tmp/uploads/fileKkPerwakilan/' . $request->file_kk_perwakilan);
        // $file_npwp_perwakilan = URL::to('/tmp/uploads/fileNpwpPerwakilan/' . $request->file_npwp_perwakilan);
        // $file_kopetensi_perwakilan = URL::to('/tmp/uploads/fileKopetensiPerwakilan/' . $request->file_kopetensi_perwakilan);
        // $file_afiliasi_perwakilan = URL::to('/tmp/uploads/fileAfiliasiPerwakilan/' . $request->file_afiliasi_perwakilan);
        // $file_domisili_perwakilan = URL::to('/tmp/uploads/fileDomisiliPerwakilan/' . $request->file_domisili_perwakilan);
        // $file_kode_etik_perwakilan = URL::to('/tmp/uploads/fileKodeEtikPerwakilan/' . $request->file_kode_etik_perwakilan);
        // $file_pernyataan_media_perwakilan = URL::to('/tmp/uploads/filePernyataanMediaPerwakilan/' . $request->file_pernyataan_media_perwakilan);
        // $file_rekening = URL::to('/tmp/uploads/fileRekening/' . $request->file_rekening);
        // $file_signature_data = URL::to('/tmp/uploads/fileSignatureData/' . $request->file_signature_data);
        $file_ktp_perwakilan = $request->file_ktp_perwakilan;
        $file_kk_perwakilan = $request->file_kk_perwakilan;
        $file_npwp_perwakilan = $request->file_npwp_perwakilan;
        $file_kopetensi_perwakilan = $request->file_kopetensi_perwakilan;
        $file_afiliasi_perwakilan = $request->file_afiliasi_perwakilan;
        $file_domisili_perwakilan = $request->file_domisili_perwakilan;
        $file_kode_etik_perwakilan = $request->file_kode_etik_perwakilan;
        $file_pernyataan_media_perwakilan = $request->file_pernyataan_media_perwakilan;
        $file_rekening = $request->file_rekening;
        $file_signature_data = $request->file_signature_data;

        // checking
        $pengajuan_cek = media_pengajuan::where('id_user', Auth::user()->id)->where('tahun_pengajuan', $tahun_buka)->count();
        $nama_perusahaan_cek = media_pengajuan::where('nama_perusahaan', $nama_perusahaan)->where('tahun_pengajuan', $tahun_buka)->count();
        $ktp_cek = media_pengajuan::where('ktp_perwakilan', $ktp_perwakilan)->where('tahun_pengajuan', $tahun_buka)->count();
        $kk_cek = media_pengajuan::where('kk_perwakilan', $kk_perwakilan)->where('tahun_pengajuan', $tahun_buka)->count();
        $nama_media_cek = media_pengajuan::where('nama_media', $nama_media)->where('tahun_pengajuan', $tahun_buka)->count();

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

                // insert data
                $pengajuan = new media_pengajuan();
                $pengajuan->id_user = Auth::user()->id;
                $pengajuan->pengajuan_no = $pengajuan_no;
                $pengajuan->jenis_media = $jenis_media;
                $pengajuan->nama_perusahaan = $nama_perusahaan;
                $pengajuan->nama_pimred = $nama_pimred;
                $pengajuan->alamat_perusahaan = $alamat_perusahaan;
                $pengajuan->tlpn_perusahaan = $tlpn_perusahaan;
                $pengajuan->email_perusahaan = $email_perusahaan;
                $pengajuan->npwp_perusahaan = $npwp_perusahaan;
                $pengajuan->akta_perusahaan = $akta_perusahaan;
                $pengajuan->kumham_perusahaan = $kumham_perusahaan;
                $pengajuan->wartawan_kompeten_perusahaan = $wartawan_kompeten_perusahaan;
                $pengajuan->nama_percetakan = $nama_percetakan;
                $pengajuan->alamat_percetakan = $alamat_percetakan;
                // file
                $pengajuan->file_npwp_perusahaan = $file_npwp_perusahaan;
                $pengajuan->file_akta_perusahaan = $file_akta_perusahaan;
                $pengajuan->file_kumham_perusahaan = $file_kumham_perusahaan;
                $pengajuan->file_wartawan_kompeten_perusahaan = $file_wartawan_kompeten_perusahaan;
                $pengajuan->file_dewan_pers_perusahaan = $file_dewan_pers_perusahaan;
                $pengajuan->file_afiliasi_perusahaan = $file_afiliasi_perusahaan;
                $pengajuan->file_spt_perusahaan = $file_spt_perusahaan;
                $pengajuan->file_domisili_perusahaan = $file_domisili_perusahaan;
                $pengajuan->file_kuasa_perwakilan = $file_kuasa_perwakilan;
                $pengajuan->file_kerjasama = $file_kerjasama;
                $pengajuan->file_izin_ipp = $file_izin_ipp;
                // perwakilan
                $pengajuan->nama_media = $nama_media;
                $pengajuan->nama_biro_perwakilan = $nama_biro_perwakilan;
                $pengajuan->alamat_perwakilan = $alamat_perwakilan;
                $pengajuan->tlpn_perwakilan = $tlpn_perwakilan;
                $pengajuan->email_perwakilan = $email_perwakilan;
                $pengajuan->ktp_perwakilan = $ktp_perwakilan;
                $pengajuan->kk_perwakilan = $kk_perwakilan;
                $pengajuan->npwp_perwakilan = $npwp_perwakilan;
                $pengajuan->kompetensi_perwakilan = $kompetensi_perwakilan;
                $pengajuan->jenis_rekening = $jenis_rekening;
                $pengajuan->nama_bank = $nama_bank;
                $pengajuan->pemilik_rekening = $pemilik_rekening;
                $pengajuan->no_rekening = $no_rekening;
                $pengajuan->tahun_pengajuan = $tahun_buka;
                $pengajuan->status = 'ajukan';
                // file
                $pengajuan->file_ktp_perwakilan = $file_ktp_perwakilan;
                $pengajuan->file_kk_perwakilan = $file_kk_perwakilan;
                $pengajuan->file_npwp_perwakilan = $file_npwp_perwakilan;
                $pengajuan->file_kopetensi_perwakilan = $file_kopetensi_perwakilan;
                $pengajuan->file_afiliasi_perwakilan = $file_afiliasi_perwakilan;
                $pengajuan->file_domisili_perwakilan = $file_domisili_perwakilan;
                $pengajuan->file_kode_etik_perwakilan = $file_kode_etik_perwakilan;
                $pengajuan->file_pernyataan_media_perwakilan = $file_pernyataan_media_perwakilan;
                $pengajuan->file_rekening = $file_rekening;
                $pengajuan->file_signature_data = $file_signature_data;
                $pengajuan->save();

                $pesan = 'data Berhasil di Input';
                $icon = 'success';
                $title = 'Sukses';
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
        $pengajuan_cek = media_pengajuan::where('id_user', Auth::user()->id)->where('tahun_pengajuan', $tahun_buka)->count();
        $media_data = media_pengajuan::where('pengajuan_no', $no_pengajuan)->get();
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
        // Perusahaan
        $pengajuan_no =  $request->pengajuan_no;
        $jenis_media = strtolower($request->jenis_media);
        $nama_perusahaan = str_replace('  ', ' ', strtolower($request->nama_perusahaan));
        $nama_pimred = strtolower($request->nama_pimred);
        $alamat_perusahaan = strtolower($request->alamat_perusahaan);
        $tlpn_perusahaan = strtolower($request->tlpn_perusahaan);
        $email_perusahaan = strtolower($request->email_perusahaan);
        $npwp_perusahaan = strtolower($request->npwp_perusahaan);
        $akta_perusahaan = strtolower($request->akta_perusahaan);
        $kumham_perusahaan = strtolower($request->kumham_perusahaan);
        $wartawan_kompeten_perusahaan = strtolower($request->wartawan_kompeten_perusahaan);
        $nama_percetakan = strtolower($request->nama_percetakan);
        $alamat_percetakan = strtolower($request->alamat_percetakan);
        // file
        $file_npwp_perusahaan = $request->file_npwp_perusahaan;
        $file_akta_perusahaan = $request->file_akta_perusahaan;
        $file_kumham_perusahaan = $request->file_kumham_perusahaan;
        $file_wartawan_kompeten_perusahaan = $request->file_wartawan_kompeten_perusahaan;
        $file_dewan_pers_perusahaan = $request->file_dewan_pers_perusahaan;
        $file_afiliasi_perusahaan = $request->file_afiliasi_perusahaan;
        $file_spt_perusahaan = $request->file_spt_perusahaan;
        $file_domisili_perusahaan = $request->file_domisili_perusahaan;
        $file_kuasa_perwakilan = $request->file_kuasa_perwakilan;
        $file_kerjasama = $request->file_kerjasama;
        $file_izin_ipp = $request->file_izin_ipp;
        // perwakilan
        $nama_media = strtolower($request->nama_media);
        $nama_biro_perwakilan = strtolower($request->nama_biro_perwakilan);
        $alamat_perwakilan = strtolower($request->alamat_perwakilan);
        $tlpn_perwakilan = strtolower($request->tlpn_perwakilan);
        $email_perwakilan = strtolower($request->email_perwakilan);
        $ktp_perwakilan = strtolower($request->ktp_perwakilan);
        $kk_perwakilan = strtolower($request->kk_perwakilan);
        $npwp_perwakilan = strtolower($request->npwp_perwakilan);
        $kompetensi_perwakilan = strtolower($request->kompetensi_perwakilan);
        $jenis_rekening = strtolower($request->jenis_rekening);
        $nama_bank = strtolower($request->nama_bank);
        $pemilik_rekening = strtolower($request->pemilik_rekening);
        $no_rekening = strtolower($request->no_rekening);
        // file
        $file_ktp_perwakilan = $request->file_ktp_perwakilan;
        $file_kk_perwakilan = $request->file_kk_perwakilan;
        $file_npwp_perwakilan = $request->file_npwp_perwakilan;
        $file_kopetensi_perwakilan = $request->file_kopetensi_perwakilan;
        $file_afiliasi_perwakilan = $request->file_afiliasi_perwakilan;
        $file_domisili_perwakilan = $request->file_domisili_perwakilan;
        $file_kode_etik_perwakilan = $request->file_kode_etik_perwakilan;
        $file_pernyataan_media_perwakilan = $request->file_pernyataan_media_perwakilan;
        $file_rekening = $request->file_rekening;
        $file_signature_data = $request->file_signature_data;

        $tahun = tahun::select('tahun')->where('pengajuan_edit', 1)->get();
        $tahun_edit = json_decode(json_encode($tahun[0]->tahun));
        $nama_perusahaan_cek = media_pengajuan::where('pengajuan_no', '!=', $pengajuan_no)->where('nama_perusahaan', $nama_perusahaan)->where('tahun_pengajuan', $tahun_edit)->count();
        $nama_media_cek = media_pengajuan::where('pengajuan_no', '!=', $pengajuan_no)->where('nama_media', $nama_media)->where('tahun_pengajuan', $tahun_edit)->count();
        $ktp_cek = media_pengajuan::where('pengajuan_no', '!=', $pengajuan_no)->where('ktp_perwakilan', $ktp_perwakilan)->where('tahun_pengajuan', $tahun_edit)->count();
        $kk_cek = media_pengajuan::where('pengajuan_no', '!=', $pengajuan_no)->where('kk_perwakilan', $kk_perwakilan)->where('tahun_pengajuan', $tahun_edit)->count();


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
                // perusahaan
                'jenis_media' => $jenis_media,
                'nama_perusahaan' => $nama_perusahaan,
                'nama_pimred' => $nama_pimred,
                'alamat_perusahaan' => $alamat_perusahaan,
                'tlpn_perusahaan' => $tlpn_perusahaan,
                'email_perusahaan' => $email_perusahaan,
                'npwp_perusahaan' => $npwp_perusahaan,
                'akta_perusahaan' => $akta_perusahaan,
                'kumham_perusahaan' => $kumham_perusahaan,
                'nama_percetakan' => $nama_percetakan,
                'alamat_percetakan' => $alamat_percetakan,
                'wartawan_kompeten_perusahaan' => $wartawan_kompeten_perusahaan,
                // perwakilan
                'nama_media' => $nama_media,
                'nama_biro_perwakilan' => $nama_biro_perwakilan,
                'alamat_perwakilan' => $alamat_perwakilan,
                'tlpn_perwakilan' => $tlpn_perwakilan,
                'email_perwakilan' => $email_perwakilan,
                'ktp_perwakilan' => $ktp_perwakilan,
                'kk_perwakilan' => $kk_perwakilan,
                'npwp_perwakilan' => $npwp_perwakilan,
                'kompetensi_perwakilan' => $kompetensi_perwakilan,
                'jenis_rekening' => $jenis_rekening,
                'nama_bank' => $nama_bank,
                'pemilik_rekening' => $pemilik_rekening,
                'no_rekening' => $no_rekening,
                'file_npwp_perusahaan' => $file_npwp_perusahaan,
                'file_akta_perusahaan' => $file_akta_perusahaan,
                'file_kumham_perusahaan' => $file_kumham_perusahaan,
                'file_wartawan_kompeten_perusahaan' => $file_wartawan_kompeten_perusahaan,
                'file_dewan_pers_perusahaan' => $file_dewan_pers_perusahaan,
                'file_afiliasi_perusahaan' => $file_afiliasi_perusahaan,
                'file_spt_perusahaan' => $file_spt_perusahaan,
                'file_domisili_perusahaan' => $file_domisili_perusahaan,
                'file_kuasa_perwakilan' => $file_kuasa_perwakilan,
                'file_kerjasama' => $file_kerjasama,
                'file_izin_ipp' => $file_izin_ipp,
                'file_ktp_perwakilan' => $file_ktp_perwakilan,
                'file_kk_perwakilan' => $file_kk_perwakilan,
                'file_npwp_perwakilan' => $file_npwp_perwakilan,
                'file_kopetensi_perwakilan' => $file_kopetensi_perwakilan,
                'file_afiliasi_perwakilan' => $file_afiliasi_perwakilan,
                'file_domisili_perwakilan' => $file_domisili_perwakilan,
                'file_kode_etik_perwakilan' => $file_kode_etik_perwakilan,
                'file_pernyataan_media_perwakilan' => $file_pernyataan_media_perwakilan,
                'file_rekening' => $file_rekening,
                'file_signature_data' => $file_signature_data,
                'status' => 'edit',
                'keterangan' => '',
            ];

            $pengajuan_update = media_pengajuan::where('pengajuan_no', $pengajuan_no)->update($data);

            $pesan = 'data berhasil diupdate';
            $icon = 'success';
            $title = 'Sukses';
        }

        // dd($pengajuan_no);
        return response()->json([
            'massage' => $pesan,
            'icon' => $icon,
            'title' => $title
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
        $path = public_path('tmp/uploads/' . $param);

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
        $pengajuan_cek = media_pengajuan::where('id_user', Auth::user()->id)->where('tahun_pengajuan', $tahun_buka)->count();
        $media_data = media_pengajuan::where('pengajuan_no', $no_pengajuan)->get();
        return view('admin.pengajuan.form_cek', [
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

        $pengajuan_no = $request->pengajuan_no;
        $keterangan = $request->keterangan;
        $status = $request->status;

        $data_media = media_pengajuan::select(
            'media_pengajuans.id_user',
            'users.id',
            'media_pengajuans.pengajuan_no as idpengajuan',
            'media_pengajuans.jenis_media as jenis',
            'media_pengajuans.nama_media as namamedia',
            'users.email as useremail',
            'media_pengajuans.status as status'
        )->join('users', 'users.id', '=', 'media_pengajuans.id_user')->where('pengajuan_no', $pengajuan_no)->first();

        if ($data_media['status'] == 'ajukan' || $data_media['status'] == 'edit') {
            if ($status == 'terima') {
                // data diterima
                $pesan = 'data dengan nomor pengajuan: ' . $pengajuan_no . ' berhasil diterima';
                $data_keterangan = $keterangan;
            } else {
                // data ditolak
                array_unshift($keterangan, "");
                unset($keterangan[0]);
                $number = 1;
                foreach ($keterangan as $k) {
                    $number_data[] = $number++ . '. ';
                }
                $data_keterangan = 'data ditolak silahkan cek data: <br>' . mapped_implode(', <br>', $keterangan);
                $dataSendMail = mapped_implode(', <br>', $keterangan);
                $pesan = 'data dengan nomor pengajuan: ' . $pengajuan_no . ' ditolak';

                $mailDatas = [
                    'jenis' => $data_media['jenis'],
                    'no' => $data_media['idpengajuan'],
                    'nama' => $data_media['namamedia'],
                    'keterangan' => $dataSendMail
                ];

                Mail::to($data_media['useremail'])->send(new notifVerifikasiTolak($mailDatas));
            }


            media_pengajuan::where('pengajuan_no', $pengajuan_no)->update(
                [
                    'keterangan' => $data_keterangan,
                    'status' => $status
                ]
            );
            $icon = 'success';
            $title = 'data berhasil terkirim';
        } else {
            $pesan = 'Data Dengan Nomor Pengajuan: ' . $pengajuan_no . ' Sudah Diverifikasi';
            $icon = 'error';
            $title = 'Data Sudah Diverifikasi';
        }
        return response()->json([
            'massage' => $pesan,
            'icon' => $icon,
            'title' => $title
        ]);
    }
}
