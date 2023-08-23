<?php

namespace App\Http\Controllers;

use App\Models\media_jenis;
use App\Models\media_pengajuan;
use App\Models\tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class MediaPengajuanDaftarController extends Controller
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
        $pengajuan_cek = media_pengajuan::where('id_user', Auth::user()->id)->where('tahun_pengajuan', $tahun_buka)->count();
        return view('admin.pengajuan.list', ['pengajuan_buka' => $tahun_hitung, 'pengajuan_data' => $pengajuan_cek]);
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
    public function show()
    {
        //
        if (Auth::user()->role == 'user') {
            # code...
            // $data = media_pengajuan::where('id_user', Auth::user()->id)->get();
            $data = media_pengajuan::where('id_user', Auth::user()->id)->join('tahuns', 'media_pengajuans.tahun_pengajuan', '=', 'tahuns.tahun')->orderBy('media_pengajuans.id', 'desc')->get();
        } else {
            $data = media_pengajuan::join('tahuns', 'media_pengajuans.tahun_pengajuan', '=', 'tahuns.tahun')->orderBy('media_pengajuans.id', 'desc')->get();
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
                    if ($data->pengajuan_edit == 1) {
                        # code...
                        $button .= '<button class="editdaftar btn btn-quaternary" data-id="' . $data->pengajuan_no . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg></button>';
                    }
                }

                if (Auth::user()->role == 'admin') {
                    if ($data->verifikasi == 1) {
                        if ($data->status == 'edit' || $data->status == 'ajukan') {
                            # code...
                            $button .= '<button class="verifikasi btn btn-quaternary" data-id="' . $data->pengajuan_no . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-check" viewBox="0 0 16 16">
                            <path d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
                            <path d="M15.854 10.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.707 0l-1.5-1.5a.5.5 0 0 1 .707-.708l1.146 1.147 2.646-2.647a.5.5 0 0 1 .708 0z"/>
                          </svg> data </button>';
                        }
                    }
                }

                $group = '<div class="btn-group m-2" role="group">' . $button . '</div>';
                return $group;
            })
            ->addColumn('keterangan', function ($data) {
                if ($data->status == 'terima') {
                    # code...
                    $bg = 'bg-primary';
                    $keterangan = $data->keterangan;
                } elseif ($data->status == 'ajukan') {
                    $bg = 'bg-info';
                    $keterangan = 'data baru di' . $data->status . ' oleh media ' . $data->nama_media;
                } elseif ($data->status == 'tolak') {
                    $bg = 'bg-danger';
                    $keterangan = $data->keterangan;
                } elseif ($data->status == 'edit') {
                    $bg = 'bg-warning';
                    $keterangan = 'di' . $data->status . ' oleh media ' . $data->nama_media;
                } else {
                    $bg = 'bg-light';
                    $keterangan = '';
                }
                return '<span class="badge m-2 ' . $bg . '">' . $keterangan . '</span>';
            })
            ->rawColumns(['action', 'keterangan'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
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
