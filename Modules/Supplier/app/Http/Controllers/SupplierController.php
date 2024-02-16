<?php

namespace Modules\Supplier\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Modules\Purchase\app\Models\TransactionPurchase;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class SupplierController extends Controller
{

    /**
     * Instantiate a new SupplierController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-supplier|edit-supplier|delete-supplier', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-supplier', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-supplier', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-supplier', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!empty($request->search)) {
            $supplier = Supplier::where('name', 'like', '%' . $request->search . '%')->latest()->paginate(10);
        } else {
            $supplier = Supplier::latest()->paginate(10);
        }
        return view('supplier::index')->with(['suppliers' => $supplier, 'keyword' => $request->search]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        $request->validate([
            'name_input' => 'required',
            'email_input' => 'required|unique:customer,email',
            'contact_input' => 'required',
            'address_input' => 'required',
        ]);

        Supplier::create([
            'code' => Str::random(5),
            'name' => $request->name_input,
            'email' => $request->email_input,
            'contact' => $request->contact_input,
            'address' => $request->address_input
        ]);
        Session::flash('success', ' Supplier ' . $request->name . 'is  add successfuly.');
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     */
    public function show($id, Request $request)
    {
        $supplier = Supplier::find($id);

        if ($request->ajax()) {
            $transaction = TransactionPurchase::with(['departement', 'methodpayment', 'operator'])->where('id_supplier', $supplier->id)->get();
            return DataTables::of($transaction)
                ->addIndexColumn()

                ->editColumn('amount', function ($row) {
                    return empty($row->amount) ? 0 : number_format($row->amount, 0, ',', '.');
                })
                ->editColumn('date_transaction', function ($row) {
                    return empty($row->date_purchase) ? '-' : Carbon::parse($row->date_purchase)->translatedFormat('d F Y');
                })
                ->editColumn('departement', function ($row) {
                    return empty($row->departement) ? '-' : $row->departement->name;
                })
                ->editColumn('methodpayment', function ($row) {
                    return empty($row->methodpayment) ? '-' : $row->methodpayment->name;
                })
                ->addColumn('code_transaction', function ($row) {
                    $btn = '<a href="' . route('purchase.show', $row->id) . '">' . $row->code_transaction . '</a>';
                    return $btn;
                })->rawColumns(['code_transaction'])->make();
        }

        $total_transaction = TransactionPurchase::where('id_supplier', $supplier->id)->sum('amount');

        return view('supplier::show')->with(['supplier' => $supplier, 'total_transaction' => $total_transaction]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('supplier::edit')->with(['supplier' => $supplier]);
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
        $request->validate([
            'name_input' => 'required',
            'email_input' => 'required|unique:supplier,email,' . $id,
            'contact_input' => 'required',
            'address_input' => 'required',
        ]);

        $supplier = Supplier::find($id);

        $supplier->update([
            'name' => $request->name_input,
            'email' => $request->email_input,
            'contact' => $request->contact_input,
            'address' => $request->address_input
        ]);
        Session::flash('success', ' Supplier ' . $request->name_input . 'is  Change successfuly.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $supplier = Supplier::find($id);
        $check_transaction = TransactionPurchase::where('id_supplier', $id)->first();
        if (!empty($check_transaction)) {
            Session::flash('error', ' Supplier ' . $supplier->name . 'is can`t delete , because referense transaction purchase .');
            return redirect()->back();
        } else {
            Session::flash('success', ' Supplier ' . $supplier->name . 'has been delete it .');
            $supplier->delete();
            return redirect()->back();
        }
    }
}
