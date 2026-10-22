<?php

namespace App\Http\Controllers;

use App\Models\media_pengajuan;
use App\Models\new_media_pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        $param = $request->query('param');
        $draw = (int) $request->query('draw', 0);

        try {
            $query = new_media_pengajuan::query()->where('tahun_pengajuan', '2025');

            if ($param === 'perwakilan' && $request->filled('jenis_media')) {
                switch ($request->string('jenis_media')->lower()->value()) {
                    case 'tv':
                        $query->where('jenis_media', 'elektronik')
                            ->whereRaw('LOWER(jenisJangkauanSiarMediaElektronik) = ?', ['televisi']);
                        break;
                    case 'radio':
                        $query->where('jenis_media', 'elektronik')
                            ->whereRaw('LOWER(jenisJangkauanSiarMediaElektronik) = ?', ['radio']);
                        break;
                    case 'fotografi':
                        $query->whereRaw('LOWER(jenis_media) = ?', ['fotografi']);
                        break;
                    case 'cetak':
                    case 'siber':
                        $query->whereRaw('LOWER(jenis_media) = ?', [
                            $request->string('jenis_media')->lower()->value(),
                        ]);
                        break;
                }
            }

            if ($param == 'badan' && $request->filled('jenis_media')) {
                $query->whereRaw('LOWER(jenis_media) = ?', [mb_strtolower($request->string('jenis_media')->value())]);
            }


            $data = $query->get();

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
                        return '<a target="_blank" href="https://emedia.tubaba.go.id/tmp/uploads/fileserfikatukwpimred/' . $data->fileSerfikatUkwPimred . '" class="btn btn-info">' . $data->jenisSerfikatUkwPimred . '</a>';
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
                        return $data->namaPenanggungJawab;
                    })
                    ->addColumn('surat_pernyataan_pimred', function ($data) {
                        return '<a target="_blank" href="https://emedia.tubaba.go.id/tmp/uploads/filesuratpernyataanpimred/' . $data->fileSuratPernyataanPimred . '" class="btn btn-info">Lihat</a>';
                    })
                    ->addColumn('alamat_kabupaten', function ($data) {
                        return $data->alamatKabPerusahaan;
                    })
                    ->addColumn('alamat_provinsi', function ($data) {
                        return $data->alamatProvPerusahaan;
                    })
                    ->addColumn('status_kswp', function ($data) {
                        return $data->statusKswp;
                    })
                    ->addColumn('nib_perusahaan', function ($data) {
                        return $data->nibPerusahaan;
                    })
                    ->addColumn('klbi_perusahaan', function ($data) {
                        return $data->noKlbi;
                    })
                    ->addColumn('kbki_perusahaan', function ($data) {
                        return $data->noKbki;
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
                    ->addColumn('status_persyaratan', function ($data) {
                        $verifikasi = mb_strtolower(trim((string) $data->verifikasiDewanPers));
                        if ($verifikasi === '' || str_starts_with($verifikasi, 'belum')) {
                            return 'Belum';
                        }
                        return str_contains($verifikasi, 'terverifikasi') ? 'Memenuhi syarat' : 'Belum';
                    })
                    ->rawColumns([
                        'status_persyaratan',
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
                        return $data->alamatKabPerwakilan;
                    })
                    ->addColumn('provinsi_perwakilan', function ($data) {
                        return $data->alamatProvPerwakilan;
                    })
                    ->addColumn('afiliasi_perwakilan', function ($data) {
                        return $data->afiliasiPersPerwakilan;
                    })
                    ->addColumn('kompetensi_perwakilan', function ($data) {
                        if ($data->fileSerfikatUkwPerwakilan) {
                            $sertifikat = '<a target="_blank" href="https://emedia.tubaba.go.id/tmp/uploads/fileserfikatukwperwakilan/' . $data->fileSerfikatUkwPerwakilan . '" class="btn btn-info">Lihat</a>';
                        } else {
                            $sertifikat = '';
                        }
                        return  $sertifikat;
                    })

                    ->rawColumns([
                        'kabupaten_perwakilan',
                        'provinsi_perwakilan',
                        'afiliasi_perwakilan',
                        'kompetensi_perwakilan'
                    ])
                    ->make(true);
            }

            // Parameter tidak dikenal / tidak diisi -> tetap balas JSON yang valid
            return response()->json([
                'draw' => $draw,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
            ]);
        } catch (\Throwable $e) {
            Log::error('data_all error: ' . $e->getMessage(), ['exception' => $e]);

            return response()->json([
                'draw' => $draw,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
                'error' => config('app.debug') ? $e->getMessage() : 'Gagal memuat data.',
            ], 500);
        }
    }
}
