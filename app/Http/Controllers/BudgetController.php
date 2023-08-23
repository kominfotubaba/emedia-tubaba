<?php

namespace App\Http\Controllers;

use App\Models\budget;
use App\Models\Order;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.budget.budget');
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
     * @param  \App\Models\budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //

        $data = budget::select('budgets.*', 'tahuns.order as orders')
            ->join('tahuns', 'budgets.tahun', '=', 'tahuns.tahun')
            ->groupBy('budgets.tahun')
            ->orderByDesc('tahun')
            ->get();

        return DataTables()->of($data)
            ->addColumn('murni', function ($data) {
                $murni = $data->nominal;
                $format = number_format($murni);
                return $format;
            })
            ->addColumn('perubahan', function ($data) {
                $perubahan = $data->penyesuaian;
                $format = number_format($perubahan);
                return $format;
            })
            ->addColumn('total', function ($data) {
                $total = $data->nominal + $data->penyesuaian;
                $format = number_format($total);
                return $format;
            })
            ->addColumn('status', function ($data) {
                $status = $data->orders;
                if ($status == 1) {
                    $value = '<span class="badge bg-success text-uppercase">Aktif</span>';
                } else {
                    $value = '<span class="badge bg-danger text-uppercase">Tidak Aktif</span>';
                }
                return $value;
            })
            ->addColumn('sisa', function ($data) {
                setlocale(LC_MONETARY, "id_ID");
                $order = Order::where('tahun', $data->tahun)
                    ->where(function ($query) {
                        $query->where('status', 'setuju')
                            ->orWhere('status', 'proses')
                            ->orWhere('status', 'terkirim')
                            ->orWhere('status', 'nego');
                    })
                    ->get();

                if ($order[0] ?? null) {
                    # code...
                    foreach ($order as $orders) {
                        $total_order[] = $orders->total_nilai_order;
                    }
                    $total_order_sum = array_sum($total_order);
                    unset($total_order);
                } else {
                    $total_order_sum = 0;
                }

                $sisa = $data->nominal + $data->penyesuaian - $total_order_sum;
                $format = number_format($sisa);
                return $format;
            })
            ->addColumn('aksi', function ($data) {
                $button = '<a class="editBudget btn btn-info" href="/budget/edit/' . $data->id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                 </svg></a>';
                $group = '<div class="btn-group m-2" role="group">' . $button . '</div>';
                return $group;
            })
            ->rawColumns(['status', 'total', 'sisa', 'aksi', 'murni', 'perubahan'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function edit(budget $budget)
    {
        //
        return view('admin.budget.budget_form', [
            'rup' => $budget->no_rup,
            'murni' => $budget->nominal,
            'penyesuaian' => $budget->penyesuaian
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        // $rup = $request->no_rup;
        // $nominal_murni = $request->nominal_murni;
        // $nominal_perubahan = $request->nominal_perubahan;

        $validated = $request->validate([
            'no_id' => 'required',
            'no_rup' => 'required',
            'nominal_murni' => 'required',
            'nominal_perubahan' => 'required',
        ]);


        if ($validated) {
            # code...
            budget::where('id', $validated['no_id'])->update([
                'no_rup' => $validated['no_rup'],
                'nominal' => str_replace('.', '', $validated['nominal_murni']),
                'penyesuaian' => str_replace('.', '', $validated['nominal_perubahan']),
            ]);

            return redirect('/budget');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function destroy(budget $budget)
    {
        //
    }
}
