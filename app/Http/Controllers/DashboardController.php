<?php

namespace App\Http\Controllers;

use App\Models\media_pengajuan;
use App\Models\tahun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
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
        $pengajuan_cek = media_pengajuan::where('id_user', Auth::user()->id)->where('tahun_pengajuan', $tahun_buka)->count();

        return view('dashboard', ['pengajuan_buka' => $tahun_hitung, 'pengajuan_data' => $pengajuan_cek]);
    }

    public function show()
    {
        $n = Auth::user();
        // dd($n);
        $data = User::where('id', $n->id)->first();

        return view('dashtest', ['data' => $n]);
    }

    public function edit()
    {
        $n = Auth::user();
        $data = User::where('id', $n->id)->first();
        return view('dashtest', ['data' => $n]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $username = $request->username;
        $role = $request->role;
        $data = [
            'name' => $username,
            'role' => $role,
        ];
        if ($id) {
            # code...
            $user = User::where('id', Auth::user()->id)->update($data);
        } else {
            $user = User::where('id', $id)->update($data);
        }
    }
}
