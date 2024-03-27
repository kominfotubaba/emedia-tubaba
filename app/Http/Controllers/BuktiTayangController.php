<?php

namespace App\Http\Controllers;

use App\Models\BuktiTayang;
use App\Models\Order;
use App\Models\Pejabat;
use App\Models\tahun;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BuktiTayangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('admin.bukti.bukti_tayang');
    }

    public function index_detail(Request $request)
    {
        //
        $tahun = $request->segment(2);
        return view('admin.bukti.bukti_tayang_detail', [
            'tahun' => $tahun
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $no_order = $request->id;
        $data = BuktiTayang::select(
            'bukti_tayangs.tahun as tahun',
            'bukti_tayangs.no_order as nomor_order',
            'orders.nama_media as nama_media',
            'orders.nama_perusahaan as nama_perusahaan',
            'orders.nama_paket as paket',
            'orders.detail_paket as detail_paket',
            'orders.jumlah_paket as volume',
            'orders.nilai_order as nilai',
            'orders.total_nilai_order as total_nilai',
            'bukti_tayangs.status as status',
            'orders.keterangan as keterangan',
            'bukti_tayangs.file_bukti_tayang as data_files',
        )
            ->leftJoin('orders', 'orders.no_order', '=', 'bukti_tayangs.no_order')
            ->where('bukti_tayangs.no_order', $no_order)
            ->orderByDesc('bukti_tayangs.created_at')
            ->get();
        return response()->json($data[0]);
    }

    public function create_input(Request $request)
    {
        # code...
        $no_order = $request->segment(4);
        $data = BuktiTayang::select(
            'bukti_tayangs.tahun as tahun',
            'bukti_tayangs.no_order as nomor_order',
            'orders.nama_media as nama_media',
            'orders.nama_perusahaan as nama_perusahaan',
            'orders.nama_paket as paket',
            'orders.detail_paket as detail_paket',
            'orders.jumlah_paket as volume',
            'orders.nilai_order as nilai',
            'orders.total_nilai_order as total_nilai',
            'bukti_tayangs.status as status',
            'orders.keterangan as keterangan',
            'bukti_tayangs.file_bukti_tayang as data_files',
        )
            ->leftJoin('orders', 'orders.no_order', '=', 'bukti_tayangs.no_order')
            ->where('orders.id_user',  Auth::user()->id)
            ->where('bukti_tayangs.no_order', $no_order)
            ->orderByDesc('bukti_tayangs.created_at')
            ->get();

        return view('admin.bukti.bukti_tayang_form', [
            'tahun' => $data[0]->tahun ?? null,
            'data' => $data
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
        $params = $request->param;
        $nomor_order = $request->nomor_order;
        $path = public_path('tmp/bukti_tayang/');
        if ($params == 'uploads_bukti') {
            $file = $request->file('file');
            $name = 'BT.' . $nomor_order . '.' . $file->extension();
            $original_name = $file->getClientOriginalName();
            $file->move($path, $name);

            return response()->json([
                'name'          => $name,
                'original_name' => $original_name,
            ]);
        } else {
            $validated = $request->validate([
                'nomor_order' => 'required',
                'nomor_order' => 'required',
                'nama_media' => 'required',
                'nama_paket' => 'required',
                'detail_paket' => 'required',
                'jumlah_paket' => 'required',
                'keterangan' => 'required',
                'file_pdf' => 'required',
            ]);

            if ($validated) {
                # code...
                $data = BuktiTayang::where('no_order', $nomor_order)->update([
                    'file_bukti_tayang' => $validated['file_pdf'],
                    'keterangan' => $validated['keterangan'],
                    'status' => 'cek'
                ]);
                $data_tayang = BuktiTayang::where('no_order', $nomor_order)->get();
                return redirect('/bukti_tayang' . '/' . $data_tayang[0]->tahun . '/detail')->with('success', 'Data Berhasil Disimpan');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BuktiTayang  $buktiTayang
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $data = tahun::orderByDesc('tahun')->get();
        return DataTables()->of($data)
            ->addColumn('aksi', function ($data) {
                if ((Auth::user()->role == 'admin') || Auth::user()->role == 'user') {

                    $button = '<a href="/bukti_tayang/' . $data->tahun . '/detail" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-database-fill" viewBox="0 0 16 16">
                    <path d="M3.904 1.777C4.978 1.289 6.427 1 8 1s3.022.289 4.096.777C13.125 2.245 14 2.993 14 4s-.875 1.755-1.904 2.223C11.022 6.711 9.573 7 8 7s-3.022-.289-4.096-.777C2.875 5.755 2 5.007 2 4s.875-1.755 1.904-2.223Z"/>
                    <path d="M2 6.161V7c0 1.007.875 1.755 1.904 2.223C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777C13.125 8.755 14 8.007 14 7v-.839c-.457.432-1.004.751-1.49.972C11.278 7.693 9.682 8 8 8s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972Z"/>
                    <path d="M2 9.161V10c0 1.007.875 1.755 1.904 2.223C4.978 12.711 6.427 13 8 13s3.022-.289 4.096-.777C13.125 11.755 14 11.007 14 10v-.839c-.457.432-1.004.751-1.49.972-1.232.56-2.828.867-4.51.867s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972Z"/>
                    <path d="M2 12.161V13c0 1.007.875 1.755 1.904 2.223C4.978 15.711 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13v-.839c-.457.432-1.004.751-1.49.972-1.232.56-2.828.867-4.51.867s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972Z"/>
                    </svg></a>';
                } else {
                    $button = '';
                }
                return '<div class="my-2 btn-group btn-group-sm" role="group" aria-label="Basic example">' . $button . '</div>';
            })
            ->addColumn('status', function ($data) {
                if ($data->order == 1) {
                    # code...
                    $bg = 'success';
                    $status = 'Aktif';
                } else {
                    $bg = 'danger';
                    $status = 'Tidak Aktif';
                }
                return '<span class="badge rounded-pill bg-' . $bg . '">' . $status . '</span>';
            })
            ->rawColumns(['aksi', 'status'])
            ->make(true);
    }

    public function show_detail(Request $request)
    {
        //
        $tahun = $request->segment(2);
        if (Auth::user()->role == 'admin') {
            # code...
            $data = BuktiTayang::select(
                'bukti_tayangs.tahun as tahun',
                'bukti_tayangs.no_order as nomor_order',
                'orders.nama_media as nama_media',
                'orders.nama_perusahaan as nama_perusahaan',
                'orders.nama_paket as Paket',
                'orders.jumlah_paket as volume',
                'orders.nilai_order as nilai',
                'orders.total_nilai_order as total_nilai',
                'bukti_tayangs.status as status',
            )
                ->leftJoin('orders', 'orders.no_order', '=', 'bukti_tayangs.no_order')
                ->where('bukti_tayangs.tahun', $tahun)
                ->orderByDesc('bukti_tayangs.created_at')
                ->get();
        } else {
            $data = BuktiTayang::select(
                'bukti_tayangs.tahun as tahun',
                'bukti_tayangs.no_order as nomor_order',
                'orders.nama_media as nama_media',
                'orders.nama_perusahaan as nama_perusahaan',
                'orders.nama_paket as Paket',
                'orders.jumlah_paket as volume',
                'orders.nilai_order as nilai',
                'orders.total_nilai_order as total_nilai',
                'bukti_tayangs.status as status',
            )
                ->leftJoin('orders', 'orders.no_order', '=', 'bukti_tayangs.no_order')
                ->where('orders.id_user', Auth::user()->id)
                ->where('bukti_tayangs.tahun', $tahun)
                ->orderByDesc('bukti_tayangs.created_at')
                ->get();
        }

        return DataTables()->of($data)
            ->addColumn('aksi', function ($data) {
                $button = '';

                $button .= '<button class="btn btn-info cekdetail" data-id="' . $data->nomor_order . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eyeglasses" viewBox="0 0 16 16">
                    <path d="M4 6a2 2 0 1 1 0 4 2 2 0 0 1 0-4zm2.625.547a3 3 0 0 0-5.584.953H.5a.5.5 0 0 0 0 1h.541A3 3 0 0 0 7 8a1 1 0 0 1 2 0 3 3 0 0 0 5.959.5h.541a.5.5 0 0 0 0-1h-.541a3 3 0 0 0-5.584-.953A1.993 1.993 0 0 0 8 6c-.532 0-1.016.208-1.375.547zM14 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
                    </svg>
                    </button>';
                if (Auth::user()->role == 'user') {
                    # code...
                    if (($data->status == 'tunggu') || ($data->status == 'tolak')) {
                        # code...
                        $button .= '<a href="/bukti_tayang/' . $data->tahun . '/create' . '/' . $data->nomor_order . '" class="inputbukti btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up" viewBox="0 0 16 16">
                        <path d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707V11.5z"/>
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                      </svg>
                            </a>';
                    }
                }
                if (Auth::user()->role == 'admin') {
                    # code...
                    if ($data->status == 'terima') {
                        # code...
                        // $button .= '<a href="/bukti_tayang/' . $data->tahun . '/create' . '/' . $data->nomor_order . '" class="inputbukti btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                        // <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                        // <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                        // </svg>
                        // </a>';

                        // button print
                        $button .= '<button class="dataPrint btn btn-success" data-id="' . $data->nomor_order . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                        </svg>
                        </button>';
                    }
                }

                // if ($data->status == 'terima') {
                //     # code...
                //     $button .= '<button class="dataPrint btn btn-success" data-id="' . $data->nomor_order . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                //         <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                //         <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                //     </svg>
                //     </button>';
                // }

                return '<div class="grupbutton my-2 btn-group btn-group-sm" role="group" aria-label="Basic example">' . $button . '</div>';
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 'tunggu') {
                    # code...
                    $bg = 'warning';
                    $status = $data->status;
                } elseif ($data->status == 'cek') {
                    $bg = 'info';
                    $status = 'Sedang Dilakukan Pengecekan Ulang';
                } elseif ($data->status == 'terima') {
                    $bg = 'secondary';
                    if (Auth::user()->role == 'admin') {
                        # code...
                        $status = 'Bukti Tayang Telah Diterima';
                    } else {
                        $status = 'Bukti Tayang Telah Diterima';
                    }
                } elseif ($data->status == 'selesai') {
                    $bg = 'secondary';
                    if (Auth::user()->role == 'admin') {
                        # code...
                        $status = 'SP2D Telah Diinput';
                    } else {
                        $status = 'Pembayaran Telah Diterima';
                    }
                } else {
                    $bg = 'danger';
                    $status = 'Silahkan Cek Bukti Tayang';
                }
                return '<span class="badge rounded-pill bg-' . $bg . '">' . $status . '</span>';
            })
            ->addColumn('total_nilai', function ($data) {
                $nilai = number_format($data->total_nilai);

                return 'Rp. ' . $nilai;
            })
            ->rawColumns(['aksi', 'status', 'total_nilai'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BuktiTayang  $buktiTayang
     * @return \Illuminate\Http\Response
     */
    public function edit(BuktiTayang $buktiTayang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BuktiTayang  $buktiTayang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $no_order = $request->id;
        $param = $request->param;
        if (Auth::user()->role == 'admin') {
            # code...
            BuktiTayang::where('no_order', $no_order)->update([
                'status' => $param
            ]);
            $icon = 'success';
            $title = 'Data ' . $param;
            $text = 'Data Berhasil Diterima';
        } else {
            # code...
            $icon = 'error';
            $title = 'Hak Akses';
            $text = 'Anda Tidak Memiliki Akses Pada Data Tersebut';
        }
        return response()->json([
            'icon' => $icon,
            'title' => $title,
            'text' => $text
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BuktiTayang  $buktiTayang
     * @return \Illuminate\Http\Response
     */
    public function destroy(BuktiTayang $buktiTayang)
    {
        //
    }

    public function print($no_order)
    {
        $data = Order::leftJoin('bukti_tayangs', 'orders.no_order', '=', 'bukti_tayangs.no_order')
            ->join('new_media_pengajuans', 'orders.no_pengajuan', '=', 'new_media_pengajuans.pengajuan_no')
            ->select(
                'orders.no_order as nomor_order',
                'orders.tahun as tahun_order',
                'orders.jenis_media as jenis_media',
                'orders.nama_media as nama_media',
                'orders.nama_biro as nama_biro',
                'orders.nama_pimred as nama_pimred',
                'orders.nama_perusahaan as nama_perusahaan',
                'orders.kepala_dinas as kepala_dinas',
                'orders.kepala_dinas_nip as kepala_dinas_nip',
                'orders.nama_paket as nama_paket',
                'orders.detail_paket as detail_paket',
                'orders.jumlah_paket as jumlah_paket',
                'orders.nilai_order as nilai_order',
                'orders.total_nilai_order as total_nilai_order',
                'orders.keterangan as keterangan',
                'orders.id_ekatalog as id_ekatalog',
                'bukti_tayangs.pbj as pbj',
                'bukti_tayangs.pbj_nip as pbj_nip',
                'bukti_tayangs.kpa as kpa',
                'bukti_tayangs.kpa_nip as kpa_nip',
                'bukti_tayangs.pptk as pptk',
                'bukti_tayangs.pptk_nip as pptk_nip',
                'bukti_tayangs.pengelola_barang as pengelola_barang',
                'bukti_tayangs.pengelola_barang_nip as pengelola_barang_nip',
                'bukti_tayangs.bendahara as bendahara',
                'bukti_tayangs.bendahara_nip as bendahara_nip',
                'bukti_tayangs.admin as admin',
                'new_media_pengajuans.alamatPerusahaan as alamat_perusahaan',
                'new_media_pengajuans.namaBank as bank',
                'new_media_pengajuans.pemilikRekening as pemilik_rekening',
                'new_media_pengajuans.noRekening as no_rek',
                'bukti_tayangs.updated_at as updated_at'
            )
            ->where('orders.no_order', $no_order)
            ->get();

        // $data = $no_order;
        dd($data);
        return view('admin.bukti.beritaacara', [
            'data' => $data,
        ]);
    }
}
