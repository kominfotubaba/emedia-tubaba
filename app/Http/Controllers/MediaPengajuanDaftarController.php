<?php

namespace App\Http\Controllers;

use App\Models\media_jenis;
use App\Models\media_pengajuan;
use App\Mail\notifVerifikasiTolak;
use App\Models\new_media_pengajuan;
use App\Models\tahun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Mail;

class MediaPengajuanDaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return view('admin.pengajuan.daftar_pengajuan');
    }

    public function index_detail(Request $request)
    {
        //
        $tahun = $request->segment(2);
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
        $pengajuan_tahun = new_media_pengajuan::where('id_user', Auth::user()->id)->where('tahun_pengajuan', $tahun)->count();
        $data_pengajuan = new_media_pengajuan::where('id_user', Auth::user()->id)->orderByDesc('tahun_pengajuan')->get();
        return view('admin.pengajuan.list', [
            'pengajuan_buka' => $tahun_hitung,
            'pengajuan_data' => $pengajuan_cek,
            'pengajuan_tahun' => $pengajuan_tahun,
            'data_pengajuan' => $data_pengajuan,
            'tahun' => $tahun,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_detail(Request $request)
    {
        //
        $tahun = $request->segment(2);
        if (Auth::user()->role == 'user') {
            # code...
            // $data = media_pengajuan::where('tahun_pengajuan', $tahun)->where('id_user', Auth::user()->id)->join('tahuns', 'media_pengajuans.tahun_pengajuan', '=', 'tahuns.tahun')->orderBy('media_pengajuans.id', 'desc')->get();
            $data = new_media_pengajuan::where('tahun_pengajuan', $tahun)
                ->where('id_user', Auth::user()->id)
                ->join('tahuns', 'new_media_pengajuans.tahun_pengajuan', '=', 'tahuns.tahun')
                ->orderBy('new_media_pengajuans.id', 'desc')->get();
        } else {
            // $data = media_pengajuan::where('tahun_pengajuan', $tahun)->join('tahuns', 'media_pengajuans.tahun_pengajuan', '=', 'tahuns.tahun')->orderBy('media_pengajuans.id', 'desc')->get();
            $data = new_media_pengajuan::where('tahun_pengajuan', $tahun)
                ->join('tahuns', 'new_media_pengajuans.tahun_pengajuan', '=', 'tahuns.tahun')
                ->orderBy('new_media_pengajuans.id', 'desc')->get();
        }
        return DataTables()->of($data)
            ->addColumn('action', function ($data) {
                if ($data->status == 'terima') {
                    # code...
                    $btn = 'btn-success';
                } elseif ($data->status == 'ajukan') {
                    $btn = 'btn-info';
                } elseif ($data->status == 'tolak') {
                    $btn = 'btn-danger';
                } elseif ($data->status == 'edit') {
                    $btn = 'btn-warning';
                } else {
                    $btn = 'btn-dark';
                }

                $button = '<button class="cekdaftar btn ' . $btn . '" data-id="' . $data->pengajuan_no . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                </svg></button>';

                if (Auth::user()->role == 'user') {
                    if (($data->pengajuan_edit == 1) || ($data->buka_edit == 'buka')) {
                        # code...
                        $button .= '<button class="editdaftar btn btn-quaternary" data-id="' . $data->pengajuan_no . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg></button>';
                    }
                }

                if (Auth::user()->role == 'admin') {
                    // if ($data->verifikasi == 1) {
                    if (($data->status == 'edit') || ($data->status == 'ajukan') || ($data->status == 'tolak')) {
                        # code...
                        $button .= '<button class="sendMail btn btn-light" data-id="' . $data->pengajuan_no . '">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                                <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                            </svg>
                        </button>';
                        $button .= '<button class="verifikasi btn btn-quaternary" data-id="' . $data->pengajuan_no . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-check" viewBox="0 0 16 16">
                            <path d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
                            <path d="M15.854 10.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.707 0l-1.5-1.5a.5.5 0 0 1 .707-.708l1.146 1.147 2.646-2.647a.5.5 0 0 1 .708 0z"/>
                          </svg></button>';
                    }
                    if ($data->buka_edit == 'buka') {
                        $button .= '<button class="bukaEdit btn btn-light" data-id="' . $data->pengajuan_no . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock-fill" viewBox="0 0 16 16">
                                <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2"/>
                              </svg></button>';
                    } else {
                        $button .= '<button class="tutupEdit btn btn-alternate" data-id="' . $data->pengajuan_no . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2"/>
                              </svg></button>';
                    }
                    // }
                }

                $group = '<div class="btn-group m-2" role="group">' . $button . '</div>';
                return $group;
            })
            ->addColumn('keterangan', function ($data) {
                if ($data->status == 'terima') {
                    # code...
                    $bg = 'bg-primary';
                    $keterangan =  $data->keterangan;
                } elseif ($data->status == 'ajukan') {
                    $bg = 'bg-info';
                    $keterangan = 'data baru di' . $data->status . ' oleh media ' . $data->nama_media;
                } elseif ($data->status == 'tolak') {
                    $bg = 'bg-danger';
                    $keterangan =  wordwrap($data->keterangan, 50, "<br>\n");;
                } elseif ($data->status == 'edit') {
                    $bg = 'bg-warning';
                    $keterangan = 'di' . $data->status . ' oleh media ' . $data->nama_media;
                } else {
                    $bg = 'bg-light';
                    $keterangan = '';
                }
                return '<span class="badge m-2 ' . $bg . '">' . $keterangan . '</span>';
            })
            ->addColumn('grade', function ($data) {
                $publish = tahun::where('tahun', $data->tahun_pengajuan)->first();
                if (Auth::user()->role == 'admin' || $publish->publish == 1) {
                    # code...
                    $nilai = $data->nilai;
                } else {
                    $nilai = '';
                }
                return $nilai;
            })
            ->rawColumns(['action', 'keterangan', 'grade'])
            ->make(true);
    }

    public function show(Request $request)
    {
        //
        $data = tahun::orderByDesc('tahun')->get();
        return DataTables()->of($data)
            ->addColumn('aksi', function ($data) {
                if ((Auth::user()->role == 'admin') || Auth::user()->role == 'user') {

                    $button = '<a href="/daftar/' . $data->tahun . '/detail" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-database-fill" viewBox="0 0 16 16">
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
                if ($data->pengajuan == 1) {
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $pengajuan_no = $request->pengajuan_no;
        $status = $request->status;
        $dataUsers = new_media_pengajuan::where('pengajuan_no', $pengajuan_no)->first();

        if ($status == 'buka') {
            # code...
            $mail = User::where('id', $dataUsers->id_user)->first();
            $mailDatas = [
                'jenis' => $dataUsers->jenis_media,
                'no' => $dataUsers->pengajuan_no,
                'nama' => $dataUsers->namaMedia,
                'email' => $mail->email,
                // 'keterangan' => 'Mohon Untuk Mengupload Ulang Bukti Dukung Pengajuan Media',
                'keterangan' => '',
                'detail_keterangan' => ' ',
                'waktu_perbaikan' => ' ',
                // 'waktu_perbaikan' => '4 Maret 2024'
            ];

            // Mail::to($mail->email)->send(new notifVerifikasiTolak($mailDatas));
            // Mail::to('andreperiozaherpa@gmail.com')->send(new notifVerifikasiTolak($mailDatas));

            $update = new_media_pengajuan::where('pengajuan_no', $pengajuan_no)->update([
                'buka_edit' => 'buka'
            ]);
        } else {
            # code...
            $update = new_media_pengajuan::where('pengajuan_no', $pengajuan_no)->update([
                'buka_edit' => 'tidak'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
