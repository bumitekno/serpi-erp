<?php

namespace Modules\Customer\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Modules\Sales\app\Models\TransactionSales;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!empty($request->search)) {
            $customer = Customer::where('name', 'like', '%' . $request->search . '%')->latest()->paginate(10);
        } else {
            $customer = Customer::latest()->paginate(10);
        }
        return view('customer::index')->with(['customer' => $customer, 'keyword' => $request->search]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer::create');
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

        Customer::create([
            'code' => Str::random(5),
            'name' => $request->name_input,
            'email' => $request->email_input,
            'contact' => $request->contact_input,
            'address' => $request->address_input
        ]);
        Session::flash('success', ' Customer ' . $request->name . 'is  add successfuly.');
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return view('customer::show')->with(['customer' => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customer::edit')->with(['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
        $request->validate([
            'name_input' => 'required',
            'email_input' => 'required|unique:customer,email,' . $id,
            'contact_input' => 'required',
            'address_input' => 'required',
        ]);

        $customer = Customer::find($id);

        $customer->update([
            'name' => $request->name_input,
            'email' => $request->email_input,
            'contact' => $request->contact_input,
            'address' => $request->address_input
        ]);
        Session::flash('success', ' Customer ' . $request->name_input . 'is  Change successfuly.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $customer = Customer::find($id);
        $check_transaction = TransactionSales::where('id_customer', $id)->first();
        if (!empty($check_transaction)) {
            Session::flash('error', ' Customer ' . $customer->name . 'is can`t delete , because referense transaction sales .');
            return redirect()->back();
        } else {
            Session::flash('success', ' Customer ' . $customer->name . 'has been delete it .');
            $customer->delete();
            return redirect()->back();
        }
    }
}
