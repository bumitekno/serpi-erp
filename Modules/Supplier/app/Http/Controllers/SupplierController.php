<?php

namespace Modules\Supplier\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Modules\Purchase\app\Models\TransactionPurchase;

class SupplierController extends Controller
{
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
    public function show($id)
    {
        $supplier = Supplier::find($id);
        return view('supplier::show')->with(['supplier' => $supplier]);
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
