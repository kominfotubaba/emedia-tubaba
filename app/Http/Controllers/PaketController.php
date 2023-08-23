<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Paket_detail;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.paket.paket');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_detail()
    {
        //
        return view('admin.paket.paket_detail');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.paket.paket_form');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_detail(Request $request)
    {
        //
        return view('admin.paket.paket_detail_form');
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
        $validated = $request->validate([
            'jenis_media' => 'required',
            'klasifikasi_paket' => 'required',
            'nama_paket' => 'required',
            'kode' => 'required',
        ]);
        if ($validated) {
            $kode_cek = Paket::where('deleted_at', null)->where('paket_klasifikasi', $validated['kode'] . $validated['klasifikasi_paket'])->count();
            if ($kode_cek == 1) {
                return back()->withInput()
                    ->with('error', 'Kode Klasifikasi Paket Sudah Tersedia');
            } else {
                $data = new Paket();
                $data->jenis_media = $validated['jenis_media'];
                $data->paket_klasifikasi = $validated['kode'] . $validated['klasifikasi_paket'];
                $data->paket_nama = $validated['nama_paket'];
                $data->save();
                return redirect('/paket')->with('success', 'Paket Berhasil Ditambahkan');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_detail(Request $request)
    {
        //
        $validated = $request->validate([
            'id_paket' => 'required',
            'produk' => 'required',
            'detail_produk' => 'required',
            'harga' => 'required',
            'grade' => 'required',
        ]);

        if ($validated) {
            # code...
            $grade_cek = Paket_detail::where('id_paket', $validated['id_paket'])
                ->where('grade', $validated['grade'])->count();
            if ($grade_cek == 1) {
                return back()->withInput()
                    ->with('error', 'Produk Sudah Tersedia');
            } else {
                $data = new Paket_detail();
                $data->id_paket = $validated['id_paket'];
                $data->detail_nama = $validated['produk'];
                $data->detail_paket = $validated['detail_produk'];
                $data->harga =  str_replace('.', '', $validated['harga']);
                $data->grade = $validated['grade'];
                $data->save();
            }

            return redirect('/paket/detail/' . $validated['id_paket']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $data = Paket::orderByDesc('jenis_media')->get();
        return DataTables()->of($data)
            ->addColumn('aksi', function ($data) {
                $button = '<a class="editBudget btn btn-info" href="/paket/detail/' . $data->id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003 6.97 2.789ZM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461L10.404 2Z"/>
                </svg></a>';
                $group = '<div class="btn-group m-2" role="group">' . $button . '</div>';
                return $group;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function show_detail($id)
    {
        //
        $data = Paket_detail::where('id_paket', $id)->get();
        return DataTables()->of($data)
            ->addColumn('price', function ($data) {
                $price = $data->harga;
                $format = number_format($price);
                return $format;
            })
            ->addColumn('aksi', function ($data) {
                $button = '<button class="destroyed btn btn-danger" data-id="' . $data->id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash2-fill" viewBox="0 0 16 16">
                <path d="M2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225zm9.89-.69C10.966 2.214 9.578 2 8 2c-1.58 0-2.968.215-3.926.534-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466-.18-.14-.498-.307-.975-.466z"/>
              </svg></button>';
                $group = '<div class="btn-group m-2" role="group">' . $button . '</div>';
                return $group;
            })
            ->rawColumns(['aksi', 'price'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function edit(Paket $paket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paket $paket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paket $paket)
    {
        //
    }

    public function destroy_detail(Request $request)
    {
        //
        $data = Paket_detail::find($request->id);
        if ($data) {
            $res = $data->delete();
        } else {
            $res = 'data tidak ditemukan';
        }
    }
}
