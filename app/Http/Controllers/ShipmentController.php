<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Sales\app\Models\Shipping;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;

class ShipmentController extends Controller
{

    /**
     * Instantiate a new SalesController instance.
     */
    public function __construct()
    {
        $this->middleware('permission:report-shipment', ['only' => ['index', 'store', 'show']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data_trans = Shipping::with('sales')->latest()->get();
            return DataTables::of($data_trans)
                ->addIndexColumn()
                ->editColumn('code_transaction', function ($row) {
                    return '<a href="' . route('sales.show', $row->id_transaction) . '" class="edit text-info me-2">' . $row->sales?->code_transaction . '</a>';
                })
                ->editColumn('name', function ($row) {
                    return $row?->first_name . ' ' . $row?->last_name;
                })
                ->editColumn('number_tracking', function ($row) {
                    return empty($row->number_tracking) ? '-' : $row->number_tracking;
                })
                ->editColumn('note', function ($row) {
                    return empty($row->note) ? 'Data  number tracking shipping expedition  has not been entered' : $row->note;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:;" class="edit btn btn-warning btn-sm me-2" data-id="' . $row->id . '" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_tracking">Edit</a>';
                    return $btn;
                })->rawColumns(['action', 'code_transaction'])->make();
        }

        return view('shipment');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Shipping::find($request->id_shipment)->update([
            'number_tracking' => $request->number_tracking_input,
            'note' => $request->note_tracking
        ]);
        Session::flash('success', 'Number Tracking has been added successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
