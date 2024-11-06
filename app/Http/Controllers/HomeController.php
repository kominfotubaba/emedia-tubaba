<?php

namespace App\Http\Controllers;

use App\Models\media_pengajuan;
use App\Models\new_media_pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function data_perusahaan()
    {
        return view('data-badan-hukum');
    }
    public function data_media()
    {
        return view('data-media');
    }
    public function data_perwakilan_media()
    {
        return view('data-perwakilan-media');
    }
    public function data_verifikasi()
    {
        return view('data-verifikasi');
    }

    public function data_all(Request $request)
    {
        $param = $request->param;
        // $data = media_pengajuan::get();
        $data = new_media_pengajuan::get();
        if ($param == 'media') {
            # code...
            return DataTables()->of($data)
                ->addColumn('tahun_berdiri', function ($data) {
                    return $data->tahunBerdiriMedia;
                })
                ->addColumn('status_verifikasi', function ($data) {
                    return $data->verifikasiDewanPers;
                })
                ->addColumn('sertifikat_pimred', function ($data) {
                    return $data->jenisSerfikatUkwPimred;
                })
                ->addColumn('no_sertifikat_pimred', function ($data) {
                    return  $data->serfikatUkwPimred;
                })
                ->addColumn('afiliasi_media', function ($data) {
                    return $data->afiliasiPerusahaan;
                })
                ->addColumn('domisili_redaksi', function ($data) {
                    return $data->domisiliRedaksiMedia;
                })
                ->addColumn('kanal_program', function ($data) {
                    return $data->kanalKhusus;
                })
                ->rawColumns([
                    'tahun_berdiri',
                    'status_verifikasi',
                    'sertifikat_pimred',
                    'no_sertifikat_pimred',
                    'afiliasi_media',
                    'domisili_redaksi',
                    'kanal_program',
                ])
                ->make(true);
        } elseif ($param == 'badan') {
            # code...
            return DataTables()->of($data)
                ->addColumn('penanggung_jawab', function ($data) {
                    return null;
                })
                ->addColumn('surat_pernyataan_pimred', function ($data) {
                    return 'lihat';
                })
                ->addColumn('alamat_kabupaten', function ($data) {
                    return null;
                })
                ->addColumn('alamat_provinsi', function ($data) {
                    return null;
                })
                ->addColumn('status_kswp', function ($data) {
                    return null;
                })
                ->addColumn('nib_perusahaan', function ($data) {
                    return null;
                })
                ->addColumn('klbi_perusahaan', function ($data) {
                    return null;
                })
                ->addColumn('kbki_perusahaan', function ($data) {
                    return null;
                })
                ->addColumn('izin_ipp_perusahaan', function ($data) {
                    return $data->file_izin_ipp ?? null;
                })
                ->addColumn('nama_percetakan', function ($data) {
                    return $data->nama_percetakan ?? null;
                })
                ->addColumn('alamat_percetakan', function ($data) {
                    return $data->alamat_percetakan ?? null;
                })
                ->rawColumns([
                    'penanggung_jawab',
                    'surat_pernyataan_pimred',
                    'alamat_kabupaten',
                    'alamat_provinsi',
                    'status_kswp',
                    'nib_perusahaan',
                    'klbi_perusahaan',
                    'kbki_perusahaan',
                    'izin_ipp_perusahaan',
                    'nama_percetakan',
                    'alamat_percetakan'
                ])
                ->make(true);
        } elseif ($param == 'perwakilan') {
            # code...
            return DataTables()->of($data)
                ->addColumn('kabupaten_perwakilan', function ($data) {
                    return null;
                })
                ->addColumn('provinsi_perwakilan', function ($data) {
                    return null;
                })
                ->addColumn('afiliasi_perwakilan', function ($data) {
                    return null;
                })

                ->rawColumns([
                    'kabupaten_perwakilan',
                    'provinsi_perwakilan',
                    'afiliasi_perwakilan',
                ])
                ->make(true);
        }
    }
}
