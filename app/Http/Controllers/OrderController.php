<?php

namespace App\Http\Controllers;

use App\Mail\OrderMailPbj;
use App\Models\budget;
use App\Models\BuktiTayang;
use App\Models\media_pengajuan;
use App\Models\Order;
use App\Models\Paket;
use App\Models\Pejabat;
use App\Models\tahun;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $tahun = $request->segment(2);
        return view('admin.order.order', ['tahun' => $tahun]);
    }

    public function index_tahun()
    {
        //
        return view('admin.order.order_tahun');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $order_tahun = tahun::where('order', 1)->get();
        $get_tahun = json_decode(json_encode($order_tahun));

        if ($get_tahun == null) {
            $tahun = null;
        } else {
            $tahun = $get_tahun[0]->tahun;
        }
        $data_media = media_pengajuan::select('pengajuan_no', 'nama_media')
            ->join('users', 'users.id', '=', 'media_pengajuans.id_user')
            ->where('tahun_pengajuan', $tahun)
            ->get();
        if (Auth::user()->role == 'admin') {
            # code...
            return view('admin.order.order_form', [
                'data_media' => $data_media,
                'tahun' => $tahun
            ]);
        } else {
            return redirect('/order/daftar');
        }
    }

    public function get_data_media(Request $request)
    {
        $no_media = $request->noPengajuan;
        $param = $request->param;
        if ($param == 'nama') {
            # code...
            $data_media = media_pengajuan::where('pengajuan_no', $no_media)->get();
            $get_media = json_decode(json_encode($data_media));
            $data_user = User::where('id', $get_media[0]->id_user)->get();
            // dd($data_user[0]['email']);
            $res_data = [
                'id_user' => $get_media[0]->id_user,
                'media' => $get_media[0]->nama_media,
                'perusahaan' => $get_media[0]->nama_perusahaan,
                'jenis' => $get_media[0]->jenis_media,
                'nilai' => $get_media[0]->nilai,
                'email' => $data_user[0]['email'],
            ];
        }

        return response()->json([
            'no' => $no_media,
            'data' => $res_data
        ]);
    }

    public function get_data_paket(Request $request)
    {
        $search = $request->search;
        $param = $request->param;
        $grade = $request->grade;

        if ($search == '') {
            $data = Paket::select('paket_details.id as idp', 'paket_nama', 'jenis_media', 'paket_klasifikasi', 'detail_nama', 'detail_paket', 'harga', 'grade')
                ->leftJoin('paket_details', 'pakets.id', '=', 'paket_details.id_paket')
                ->where('jenis_media', $param)
                ->where('grade', $grade)
                ->groupBy('paket_details.id')
                ->get();
        } else {
            $data = Paket::select('paket_details.id as idp', 'paket_nama', 'jenis_media', 'paket_klasifikasi', 'detail_nama', 'detail_paket', 'harga', 'grade')
                ->leftJoin('paket_details', 'pakets.id', '=', 'paket_details.id_paket')
                ->where('jenis_media', $param)
                ->where('grade', $grade)
                ->where('paket_nama', 'like', '%' . $search . '%')
                ->groupBy('paket_details.id')
                ->get();
        }

        $i = 0;
        foreach ($data as $key) {
            $response[] = [
                'id' => $key->idp,
                'text' => $i++,
                'namaPaket' => $key->paket_nama,
                'detailPaket' => $key->detail_paket,
                'paketKlasifikasi' => $key->paket_klasifikasi,
                'harga' => $key->harga,
                'grade' => $key->grade
            ];
        }

        return response()->json($response);
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
            'tahun' => 'required',
            'id_user' => 'required',
            'no_pengajuan' => 'required',
            'jenis_media' => 'required',
            'nama_media' => 'required',
            'email' => 'required',
            'nama_perusahaan' => 'required',
            'jenis_media' => 'required',
            'grade' => 'required',
            'paket' => 'required',
            'paket_klasifikasi' => 'required',
            'nama_paket' => 'required',
            'detail_paket' => 'required',
            'jumlah_paket' => 'required',
            'harga' => 'required',
            'total_harga_paket' => 'required',
            'keterangan' => 'required',
        ], [
            'tahun' => 'Belum Ada Tahun Order'
        ]);

        $order = Order::where('tahun', $validated['tahun'])
            ->where('status', 'setuju')
            ->orWhere('status', 'proses')
            ->orWhere('status', 'terkirim')
            ->orWhere('status', 'nego')
            ->get();
        $budgets = budget::where('tahun', $validated['tahun'])->get();

        if ($order[0] ?? null) {
            # code...
            foreach ($order as $orders) {
                $total_order[] = $orders->total_nilai_order;
            }
            $total_order_sum = array_sum($total_order);
        } else {
            $total_order_sum = 0;
        }

        $total_budget = $budgets[0]->nominal + $budgets[0]->penyesuaian;
        $sum = $total_order_sum + (str_replace('.', '',  $validated['total_harga_paket']));

        // dd($total_budget, $sum);

        if ($sum > $total_budget) {
            # code...
            return back()->withInput()->with('error', 'Budget Tahun ' . $validated['tahun'] . ' Sudah Tidak Mencukupi');
        } else {
            $data_media = media_pengajuan::where('pengajuan_no', $validated['no_pengajuan'])->get();
            $nama_biro = $data_media[0]->nama_biro_perwakilan;
            $nama_pimred = $data_media[0]->nama_pimred;

            $pejabat = Pejabat::get();
            foreach ($pejabat as $p) {
                # code...
                $data_pejabat[$p->jabatan] = [
                    'nama' => $p->nama,
                    'nip' => $p->nip
                ];
            }

            $now = Carbon::now();
            $month = $now->month;
            $urut = Order::where('deleted_at', null)->where('tahun', $validated['tahun'])->count();
            $data = new Order();
            $data->id_user = $validated['id_user'];
            $data->no_pengajuan = $validated['no_pengajuan'];
            $data->id_paket = $validated['paket'];
            $data->tahun = $validated['tahun'];
            $data->no_order = $validated['paket_klasifikasi'] . $validated['grade'] . '.' . $data->getNextId() . '.' . 'N' .  $urut . '.' . $month . '-' . $validated['tahun'];
            $data->email = $validated['email'];
            $data->jenis_media = $validated['jenis_media'];
            $data->nama_media = $validated['nama_media'];
            $data->nama_biro = $nama_biro;
            $data->nama_pimred = $nama_pimred;
            $data->nama_perusahaan = $validated['nama_perusahaan'];
            $data->kepala_dinas = $data_pejabat['kepala']['nama'];
            $data->kepala_dinas_nip = $data_pejabat['kepala']['nip'];
            $data->nama_paket = $validated['nama_paket'];
            $data->detail_paket = $validated['detail_paket'];
            $data->jumlah_paket = $validated['jumlah_paket'];
            $data->nilai_order = str_replace('.', '',  $validated['harga']);
            $data->total_nilai_order = str_replace('.', '',  $validated['total_harga_paket']);
            $data->status = 'tunggu';
            $data->pesan = 'belum';
            $data->keterangan = $validated['keterangan'];
            $data->save();


            $keterangan = [
                'Grade' => 'Grade : ' . $validated['grade'],
                'Paket' => 'Paket : ' . $data->detail_paket,
                'jumlahPaket' => 'Jumlah Paket : ' . $validated['jumlah_paket'] . ' Paket',
                'Harga' => 'Harga : Rp.' . $validated['harga'],
                'HargaTotal' => 'Harga Total : Rp.' . $validated['total_harga_paket'],
                'keterangan' => 'Keterangan Paket : ' . $validated['keterangan'],
                'URL' => 'Silahkan klik Link <a href="' . env('APP_URL') . '/order/daftar" class="badge text-bg-primary"> Disini </a> Untuk Ke E-Media',
            ];

            $ket = implode(', <br>', $keterangan);

            $mailDatas = [
                'user' => 'PBJ',
                'nama' => $data->nama_media . ' | ' . 'Grade : ' . $validated['grade'],
                'perusahaan' =>  $data->nama_perusahaan,
                'no' => $data->no_order,
                'jenis' => $data->jenis_media,
                'keterangan' => $ket
            ];

            Mail::to('kafuremail@gmail.com')->send(new OrderMailPbj($mailDatas));
            // Mail::to('andreperiozaherpa@gmail.com')->send(new OrderMailPbj($mailDatas));

            return redirect('/order/daftar');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $tahun = $request->segment(2);
        $data = Order::where('tahun', $tahun)->orderByDesc('id')->get();

        return DataTables()->of($data)
            ->addColumn('aksi', function ($data) {
                $status = $data->status;
                $button = '';
                if ($status == 'setuju') {
                    # code...
                    $button .= '<button class="suratPesanan btn btn-info" data-id="' . $data->no_order . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-richtext-fill" viewBox="0 0 16 16">
                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM7 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0zm-.861 1.542 1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V9.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V9s1.54-1.274 1.639-1.208zM5 11h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1z"/>
                    </svg></button>';
                }
                if (Auth::user()->role == 'operator') {
                    # code...
                    if ($status == 'tunggu') {
                        # code...
                        $button .= '<button class="pickup btn btn-tertiary" data-status="proses" data-id="' . $data->no_order . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg></button>';
                    }
                    if ($status == 'proses') {
                        # code...
                        $button .= '<button class="kirim btn btn-quaternary" data-status="terkirim" data-id="' . $data->no_order . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                        <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                        </svg></button>';
                    }

                    if ($status == 'terkirim') {
                        # code...
                        $button .= '<button class="nego btn btn-secondary" data-status="nego" data-id="' . $data->no_order . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                        <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                        <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                        <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                        </svg></button>';

                        $button .= '<button class="cancels btn btn-danger" data-status="cancels" data-id="' . $data->no_order . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg></button>';
                    }

                    if ($status == 'nego') {
                        # code...
                        $button .= '<button class="modal_Input btn btn-warning" data-status="setuju" data-id="' . $data->no_order . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-input-cursor" viewBox="0 0 16 16">
                        <path d="M10 5h4a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1h-4v1h4a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-4v1zM6 5V4H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v-1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h4z"/>
                        <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v13a.5.5 0 0 1-1 0v-13A.5.5 0 0 1 8 1z"/>
                      </svg></button>';
                    }
                }

                // if (Auth::user()->role == 'admin') {
                //     # code...
                //     if ($status == 'nego') {
                //         # code...
                //         $button .= '<button class="setuju btn btn-success" data-status="setuju" data-id="' . $data->no_order . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                //         <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                //         </svg></button>';
                //     }
                // }

                return '<div class="my-2 btn-group btn-group-sm" role="group" aria-label="Basic example">' . $button . '</div>';
            })
            ->addColumn('status', function ($data) {
                $status = $data->status;
                if ($status == 'tunggu') {
                    $bg = 'warning';
                } elseif ($status == 'proses') {
                    $bg = 'primary';
                    $status = 'Sedang Diproses';
                } elseif ($status == 'terkirim') {
                    $bg = 'quaternary';
                } elseif ($status == 'setuju') {
                    $bg = 'success';
                    $status = 'Order Telah Disetujui Oleh PPATK';
                } elseif ($status == 'nego') {
                    $bg = 'secondary';
                    $status = 'Negosiasi Selesai';
                } else {
                    $bg = 'danger';
                    $status = 'Pesanan Dibatalkan';
                }
                return '<span class="badge rounded-pill bg-' . $bg . '">' . $status . '</span>';
            })
            ->addColumn('nilai_order', function ($data) {
                $nilai = number_format($data->nilai_order);
                return 'Rp. ' . $nilai;
            })
            ->addColumn('total_nilai_order', function ($data) {
                $nilai = number_format($data->total_nilai_order);
                return 'Rp. ' . $nilai;
            })
            ->rawColumns(['aksi', 'status', 'total_nilai_order'])
            ->make(true);
    }

    public function show_tahun()
    {
        //
        // dd('ok');
        $data = tahun::orderByDesc('tahun')->get();
        return DataTables()->of($data)
            ->addColumn('aksi', function ($data) {
                if (Auth::user()->role == 'admin' || Auth::user()->role == 'operator') {

                    $button = '<a href="/order/' . $data->tahun . '" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-database-fill" viewBox="0 0 16 16">
                    <path d="M3.904 1.777C4.978 1.289 6.427 1 8 1s3.022.289 4.096.777C13.125 2.245 14 2.993 14 4s-.875 1.755-1.904 2.223C11.022 6.711 9.573 7 8 7s-3.022-.289-4.096-.777C2.875 5.755 2 5.007 2 4s.875-1.755 1.904-2.223Z"/>
                    <path d="M2 6.161V7c0 1.007.875 1.755 1.904 2.223C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777C13.125 8.755 14 8.007 14 7v-.839c-.457.432-1.004.751-1.49.972C11.278 7.693 9.682 8 8 8s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972Z"/>
                    <path d="M2 9.161V10c0 1.007.875 1.755 1.904 2.223C4.978 12.711 6.427 13 8 13s3.022-.289 4.096-.777C13.125 11.755 14 11.007 14 10v-.839c-.457.432-1.004.751-1.49.972-1.232.56-2.828.867-4.51.867s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972Z"/>
                    <path d="M2 12.161V13c0 1.007.875 1.755 1.904 2.223C4.978 15.711 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13v-.839c-.457.432-1.004.751-1.49.972-1.232.56-2.828.867-4.51.867s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972Z"/>
                  </svg></a>';
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $no_order = $request->id;
        $status = $request->param;
        $id_ekatalog = $request->data;

        // cek data order
        $data_order = Order::where('no_order', $no_order)->get();
        // cek budget
        $order = Order::where('tahun', $data_order[0]->tahun)
            ->where('status', 'setuju')
            ->orWhere('status', 'proses')
            ->orWhere('status', 'terkirim')
            ->orWhere('status', 'nego')
            ->get();
        $budgets = budget::where('tahun', $data_order[0]->tahun)->get();
        if ($order[0] ?? null) {
            # code...
            foreach ($order as $orders) {
                $total_order[] = $orders->total_nilai_order;
            }
            $total_order_sum = array_sum($total_order);
        } else {
            $total_order_sum = 0;
        }

        $total_budget = $budgets[0]->nominal + $budgets[0]->penyesuaian;
        $sum = $total_order_sum + (str_replace('.', '',  $data_order[0]->total_nilai_order));
        // dd($total_order_sum);
        // dd($sum - (str_replace('.', '',  $data_order[0]->total_nilai_order)));

        if ($status == 'proses') {
            # code...
            if ($sum > $total_budget) {
                # code...
                $data = null;
                $icon = 'error';
                $title  = 'Batas Budget';
                $text = 'Batas Nilai Budget Limit';
            } else {

                $data = [
                    'status' => 'proses'
                ];

                $icon = 'success';
                $title  = 'Data Berhasil Diambil';
                $text = 'Data Masuk Ke Dalam Tahap Proses';
            }
        } elseif ($status == 'terkirim') {
            if ($sum - (str_replace('.', '',  $data_order[0]->total_nilai_order)) > $total_budget) {
                # code...
                $data = null;
                $icon = 'error';
                $title  = 'Batas Budget';
                $text = 'Batas Nilai Budget Limit';
            } else {
                $data = [
                    'status' => 'terkirim',
                    'pesan' => 'kirim'
                ];

                // kirim email ke user media
                $keterangan = [
                    'Grade' => 'Tahun : ' . $data_order[0]->tahun,
                    'Paket' => 'Paket : ' . $data_order[0]->detail_paket,
                    'jumlah_paket' => 'Jumlah Paket : ' . $data_order[0]->jumlah_paket,
                    'Harga' => 'Harga : Rp. ' . number_format($data_order[0]->nilai_order, 0, ",", "."),
                    'harga_total' => 'Total Harga : Rp. ' . number_format($data_order[0]->total_nilai_order, 0, ",", "."),
                    'keterangan' => 'Keterangan Paket : ' . $data_order[0]->keterangan,
                    'URL' => 'Silahkan klik Link <a href="https://e-katalog.lkpp.go.id/" class="badge text-bg-primary"> Disini </a> Untuk Ke E-Media',
                ];
                $ket = implode(', <br>', $keterangan);
                $mailDatas = [
                    'user' => $data_order[0]->nama_media,
                    'nama' => $data_order[0]->nama_media,
                    'perusahaan' => $data_order[0]->nama_perusahaan,
                    'no' => $data_order[0]->no_order,
                    'jenis' => $data_order[0]->jenis_media,
                    'keterangan' => $ket
                ];
                if ($data_order[0]->pesan == 'kirim') {
                    # code...
                    $icon = 'error';
                    $title  = 'Email Sudah Dikirim';
                    $text = 'Email Tidak Dikirimkan Ke Media';
                } else {
                    $icon = 'success';
                    $title  = 'Email Terkirim';
                    $text = 'Email Berhasil Di kirimkan Ke Media';
                    Mail::to($data_order[0]->email)->send(new OrderMailPbj($mailDatas));
                }
            }
        } elseif ($status == 'nego') {
            if ($sum - (str_replace('.', '',  $data_order[0]->total_nilai_order)) > $total_budget) {
                # code...
                $data = null;
                $icon = 'error';
                $title  = 'Batas Budget';
                $text = 'Batas Nilai Budget Limit';
            } else {
                $data = [
                    'status' => 'nego',
                ];
                $icon = 'success';
                $title  = 'Negosiasi Berhasil';
                $text = 'Negosiasi Akan Diteruskan Ke Kominfo';
            }
        } elseif ($status == 'cancels') {
            $data = [
                'status' => 'cancel',
            ];
            $icon = 'success';
            $title  = 'Pesanan Batal';
            $text = 'Pesanan Dibatalkan Sisa Anggaran Akan Dikembalikan';
        } elseif ($status == 'setuju') {
            if ($sum - (str_replace('.', '',  $data_order[0]->total_nilai_order)) > $total_budget) {
                # code...
                $data = null;
                $icon = 'error';
                $title  = 'Batas Budget';
                $text = 'Batas Nilai Budget Limit';
            } else {
                $data = [
                    'status' => 'setuju',
                    'id_ekatalog' => $id_ekatalog
                ];
                $icon = 'success';
                $title  = 'Pesanan Disetujui';
                $text = 'Silahkan Melanjutkan Tahapan Proses Ke E-Katalog Untuk Input RUP Dll';

                $pejabat = Pejabat::get();
                foreach ($pejabat as $p) {
                    # code...
                    $data_pejabat[$p->jabatan] = [
                        'nama' => $p->nama,
                        'nip' => $p->nip
                    ];
                }

                $datas = new BuktiTayang();
                $datas->tahun = $data_order[0]->tahun;
                $datas->no_order = $data_order[0]->no_order;
                $datas->pbj = $data_pejabat['pbj']['nama'];
                $datas->pbj_nip = $data_pejabat['pbj']['nip'];
                $datas->kpa = $data_pejabat['kpa']['nama'];
                $datas->kpa_nip = $data_pejabat['kpa']['nip'];
                $datas->pptk = $data_pejabat['pptk']['nama'];
                $datas->pptk_nip = $data_pejabat['pptk']['nip'];
                $datas->pengelola_barang = $data_pejabat['pengelola barang']['nama'];
                $datas->pengelola_barang_nip = $data_pejabat['pengelola barang']['nip'];
                $datas->bendahara = $data_pejabat['bendahara']['nama'];
                $datas->bendahara_nip = $data_pejabat['bendahara']['nip'];
                $datas->status = 'tunggu';
                $datas->keterangan = $data_order[0]->keterangan;
                $datas->save();
            }
        } else {
            $data = null;
            $icon = 'error';
            $title  = 'Error';
            $text = 'Nomor Pesanan/Order Tidak Ada';
        }

        if ($data == null) {
            # code...
        } else {
            Order::where('no_order', $no_order)->update($data);
        }

        return response()->json([
            'title' => $title,
            'icon' => $icon,
            'text' => $text,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function print($no_order)
    {
        $data = Order::leftJoin('bukti_tayangs', 'orders.no_order', '=', 'bukti_tayangs.no_order')
            ->join('media_pengajuans', 'orders.no_pengajuan', '=', 'media_pengajuans.pengajuan_no')
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
                'media_pengajuans.alamat_perusahaan',
                'media_pengajuans.nama_bank as bank',
                'media_pengajuans.pemilik_rekening as pemilik_rekening',
                'media_pengajuans.no_rekening as no_rek',
                'orders.updated_at as updated_at',
                'orders.created_at as created_at',
            )
            ->where('orders.no_order', $no_order)
            ->get();

        return  view('admin.order.suratemedia', [
            'data' => $data,
        ]);
    }
}
