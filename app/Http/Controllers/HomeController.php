<?php

namespace App\Http\Controllers;

use App\Models\media_pengajuan;
use App\Models\new_media_pengajuan;
use App\Models\tahun;
use Carbon\Carbon;
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
        return redirect('/data-perusahaan');
    }
    public function data_perwakilan_media()
    {
        return view('data-perwakilan-media');
    }
    public function data_verifikasi()
    {
        return view('data-verifikasi');
    }

    /**
     * Serve shared documents and previously uploaded local files.
     */
    public function document(string $folder, string $filename)
    {
        $folders = [
            'filenibperusahaan',
            'filekumhamperusahaan',
            'filenpwpperusahaan',
            'filenpwpperwakilan',
            'fileizinipp',
            'fileserfikatukwpimred',
            'filesuratpernyataanpimred',
            'filesuratketeranganwartawan',
            'fileserfikatukwperwakilan',
            'filebuktikeanggotaanorganisasiwartawan',
            'filebuktikeanggotaanorganisasiperusahaanpers',
        ];

        abort_unless(in_array($folder, $folders, true), 404);
        $filename = basename($filename);
        abort_if($filename === '', 404);

        $sharedRoot = config('filesystems.shared_document_root');
        $roots = array_filter([$sharedRoot, public_path('tmp/uploads')]);
        foreach (array_unique($roots) as $root) {
            foreach (array_unique([$filename, strtolower($filename)]) as $candidate) {
                $path = $root . '/' . $folder . '/' . $candidate;
                if (is_file($path)) {
                    return response()->file($path);
                }
            }
        }

        abort(404, 'Dokumen tidak ditemukan pada server ini.');
    }

    public function data_all(Request $request)
    {
        $param = $request->query('param');
        $draw = (int) $request->query('draw', 0);

        try {
            $tahunAktif = tahun::where('pengajuan', 1)->value('tahun') ?? date('Y');
            // Beranda hanya menampilkan pengajuan yang sudah diterima admin.
            // Pengajuan baru, masih diverifikasi, atau ditolak tetap tersimpan
            // untuk proses internal tetapi tidak dipublikasikan.
            $query = new_media_pengajuan::query()
                ->where('tahun_pengajuan', $tahunAktif)
                ->where('status', 'terima');

            if ($param === 'perwakilan' && $request->filled('jenis_media')) {
                switch ($request->string('jenis_media')->lower()->value()) {
                    case 'cetak':
                    case 'siber':
                    case 'elektronik':
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

            if ($param == 'badan') {
                # code...
                return DataTables()->of($data)
                    ->addColumn('pimprus', function ($data) {
                        return $data->namaPimprus;
                    })
                    ->addColumn('alamat_website', function ($data) {
                        return $data->alamatWebsite;
                    })
                    ->addColumn('alamat_kecamatan', function ($data) {
                        return $data->alamatKecPerusahaan;
                    })
                    ->addColumn('surat_pernyataan_pimred', function ($data) {
                        if (!$data->fileSuratPernyataanPimred) {
                            return '';
                        }
                        $url = route('dokumen.show', ['folder' => 'filesuratpernyataanpimred', 'filename' => $data->fileSuratPernyataanPimred], false);
                        return '<a target="_blank" href="' . e($url) . '" class="btn btn-info">Lihat</a>';
                    })
                    ->addColumn('alamat_kabupaten', function ($data) {
                        return $data->alamatKabPerusahaan;
                    })
                    ->addColumn('alamat_provinsi', function ($data) {
                        return $data->alamatProvPerusahaan;
                    })
                    ->addColumn('status_perusahaan_pers', function ($data) {
                        $verifikasi = mb_strtolower(trim((string) $data->verifikasiDewanPers));

                        if (str_contains($verifikasi, 'faktual') && !str_contains($verifikasi, 'belum')) {
                            return 'terverifikasi faktual';
                        }

                        if (str_contains($verifikasi, 'administrasi') || str_contains($verifikasi, 'administratif')) {
                            return 'terverifikasi administrasi';
                        }

                        if (str_contains($verifikasi, 'terdata') && !str_contains($verifikasi, 'belum')) {
                            return 'terdata';
                        }

                        return 'belum terdata';
                    })
                    ->addColumn('keterangan_perusahaan_pers', function ($data) {
                        if ($data->status === 'terima') {
                            return 'Memenuhi Syarat';
                        }

                        // Keterangan dibuat saat verifikasi ditolak. Tanggal perubahan
                        // tersebut menjadi awal masa pelengkapan dokumen selama satu tahun.
                        $batasPelengkapan = $data->updated_at
                            ? Carbon::parse($data->updated_at)->addYear()
                            : null;

                        return $batasPelengkapan && $batasPelengkapan->isPast()
                            ? 'Belum Lengkap'
                            : 'Belum Memenuhi Syarat';
                    })
                    ->addColumn('catatan_persyaratan', function ($data) {
                        if ($data->status === 'terima') {
                            return '';
                        }

                        $catatan = html_entity_decode((string) $data->keterangan, ENT_QUOTES, 'UTF-8');
                        $catatan = preg_replace('/<br\\s*\\/?\\s*>/i', "\n", $catatan);

                        return trim(strip_tags($catatan));
                    })
                    ->addColumn('batas_pelengkapan', function ($data) {
                        return $data->status !== 'terima' && $data->updated_at
                            ? Carbon::parse($data->updated_at)->addYear()->format('d-m-Y')
                            : null;
                    })
                    ->rawColumns([
                        'status_perusahaan_pers',
                        'keterangan_perusahaan_pers',
                        'pimprus',
                        'surat_pernyataan_pimred',
                        'alamat_kabupaten',
                        'alamat_provinsi',
                        'alamat_kecamatan',
                        'alamat_website'
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
                        return $data->fileBuktiKeanggotaanOrganisasiWartawan;
                    })
                    ->addColumn('organisasi_wartawan', function ($data) {
                        return $data->organisasiWartawan;
                    })
                    ->addColumn('organisasi_perusahaan_pers', function ($data) {
                        return $data->organisasiPerusahaanPers;
                    })
                    ->addColumn('bukti_organisasi_perusahaan_pers', function ($data) {
                        return $data->fileBuktiKeanggotaanOrganisasiPerusahaanPers;
                    })
                    ->addColumn('surat_keterangan_wartawan', function ($data) {
                        if ($data->fileSuratKeteranganWartawan) {
                            $url = route('dokumen.show', ['folder' => 'filesuratketeranganwartawan', 'filename' => $data->fileSuratKeteranganWartawan], false);
                            return '<a target="_blank" href="' . e($url) . '" class="btn btn-info">Lihat</a>';
                        }
                        return '';
                    })
                    ->addColumn('kompetensi_perwakilan', function ($data) {
                        return $data->fileSerfikatUkwPerwakilan;
                    })
                    ->addColumn('status_wartawan', function ($data) {
                        return $data->jenisSerfikatUkwPerwakilan ?: ($data->serfikatUkwPerwakilan ? 'Kompeten' : 'Belum Kompeten');
                    })

                    ->rawColumns([
                        'kabupaten_perwakilan',
                        'provinsi_perwakilan',
                        'afiliasi_perwakilan',
                        'organisasi_wartawan',
                        'organisasi_perusahaan_pers',
                        'bukti_organisasi_perusahaan_pers',
                        'surat_keterangan_wartawan',
                        'kompetensi_perwakilan',
                        'status_wartawan'
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
