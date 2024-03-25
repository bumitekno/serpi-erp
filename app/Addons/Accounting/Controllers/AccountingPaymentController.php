<?php

namespace App\Addons\Accounting\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Addons\Accounting\Models\account_payment;
use App\Addons\Accounting\Models\account_journal;
use App\Addons\Accounting\Models\res_company;
use App\Addons\Accounting\Models\res_customer;
use App\Addons\Accounting\Models\res_partner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountingPaymentController extends Controller
{
    /**
     * The above PHP function is a constructor that adds a custom view location for an accounting addon in
     * a Laravel application.
     */

    public function __construct()
    {
        $this->middleware('auth');
        View::addLocation(app_path() . '/Addons/Accounting/Views');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = account_payment::with('company', 'partner', 'journal')->where('partner_type', 'customer')->orderBy('name', 'DESC')->paginate(25);
        return view('payment.invoice.index')->with(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $journal = account_journal::where('type', 'Cash')->orWhere('type', 'Bank')->orderBy('name', 'asc')->get();
        $company = res_company::orderBy('id', 'asc')->get();
        $partner_customer = res_customer::orderBy('name', 'ASC')->get();
        $partner_vendor = res_partner::orderBy('name', 'ASC')->get();
        return view('payment.invoice.create')->with([
            'journal' => $journal,
            'company' => $company,
            'partner_customer' => $partner_customer,
            'partner_vendor' => $partner_vendor
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $year = date("Y");
            if ($request->partner_type == "customer") {
                $prefixcode = "CUST.IN/$year/";
                $partner = res_customer::find($request->partner_id);
            } else if ($request->partner_type == "vendor") {
                $prefixcode = "SUPP.OUT/$year/";
                $partner = res_partner::find($request->partner_id);
            }
            $count = account_payment::where('name', 'like', "%" . $prefixcode . "%")->count();
            if ($count == 0) {
                $payment_no = "$prefixcode" . "000001";
            } else {
                $payment_no = $prefixcode . str_pad($count + 1, 6, "0", STR_PAD_LEFT);
            }
            $code_journal = account_journal::find($request->journal_id);
            $prefixcode = "$code_journal->code/$year/";
            $sum = account_payment::where('move_name', 'like', "%" . $code_journal->code . "%")->count();
            if ($sum == 0) {
                $move_name = "$prefixcode" . "000001";
            } else {
                $move_name = $prefixcode . str_pad($sum + 1, 6, "0", STR_PAD_LEFT);
            }
            $payment = account_payment::create([
                'name' => $payment_no,
                'move_name' => $move_name,
                'company_id' => $request->company_id,
                'state' => "draft",
                'payment_type' => $request->payment_type,
                'payment_method_id' => $request->payment_method,
                'partner_type' => $request->partner_type,
                'partner_id' => $request->partner_type == 'customer' ? $request->partner_id_cust : $request->partner_id_sup,
                'amount' => $request->amount,
                'currency_id' => res_company::where('id', $request->company_id)->first()?->id,
                'payment_date' => $request->payment_date,
                'journal_id' => $request->journal_id,
                'payment_difference_handling' => "open",
                'bank_reference' => $request->bank_reference,
                'cheque_reference' => $request->cheque_reference,
                'communication' => $request->communication,
                'create_uid' => Auth::id(),
            ]);
            session::flash('Register Payment Successfully', 'Success');
            return redirect()->route('account.payment.view', $payment->id);
        } catch (\Exception $e) {
            session::flash('Register Payment Failed ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    /**
     * The function retrieves payment details based on the partner type (customer or vendor) and
     * displays the corresponding invoice or bill view.
     * 
     * @param $id The `view` function in the code snippet is used to display payment details based on
     * the `id` provided as a parameter. The function first retrieves the payment record using the `id`
     * provided.
     * 
     * @return   view for viewing a customer payment invoice or a view for viewing a vendor
     * payment bill, depending on the partner type of the payment being viewed.
     */
    public function view($id)
    {
        $payment = account_payment::find($id);
        if ($payment->partner_type == "customer") {
            $data = account_payment::with('company', 'partner', 'journal')->findOrFail($id);
            return view('payment.invoice.view')->with(['data' => $data]);
        } else {
            $data = account_payment::with('company', 'vendor', 'journal')->findOrFail($id);
            return view('payment.bill.view')->with(['data' => $data]);
        }
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
        $payment = account_payment::find($id);
        $journal = account_journal::where('type', 'Cash')->orWhere('type', 'Bank')->orderBy('name', 'asc')->get();
        $partner_customer = res_customer::orderBy('name', 'ASC')->get();
        $partner_supplier = res_partner::orderBy('name', 'ASC')->get();
        $company = res_company::orderBy('id', 'asc')->get();
        if ($payment->partner_type == "customer") {
            $data = account_payment::with('company', 'partner', 'journal')->findOrFail($id);
            return view('payment.invoice.edit')->with([
                'data' => $data,
                'partner_customer' => $partner_customer,
                'partner_vendor' => $partner_supplier,
                'company' => $company,
                'journal' => $journal,
            ]);
        } else {
            $data = account_payment::with('company', 'vendor', 'journal')->findOrFail($id);
            return view('payment.bill.edit')->with([
                'data' => $data,
                'partner_vendor' => $partner_supplier,
                'partner_customer' => $partner_customer,
                'company' => $company,
                'journal' => $journal,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            if ($request->partner_type == "customer") {
                $partner = res_customer::find($request->partner_id);
            } else if ($request->partner_type == "vendor") {
                $partner = res_partner::find($request->partner_id);
            }
            $payment = account_payment::findOrFail($id);
            $payment->update([
                'company_id' => $request->company_id,
                'payment_type' => $request->payment_type,
                'payment_method_id' => $request->payment_method,
                'partner_type' => $request->partner_type,
                'partner_id' => $request->partner_type == 'customer' ? $request->partner_id_cust : $request->partner_id_sup,
                'amount' => $request->amount,
                'currency_id' => res_company::where('id', $request->company_id)->first()?->id,
                'payment_date' => $request->payment_date,
                'journal_id' => $request->journal_id,
                'bank_reference' => $request->bank_reference,
                'cheque_reference' => $request->cheque_reference,
                'communication' => $request->communication,
            ]);
            if ($request->partner_type == "customer") {
                session::flash('success', 'Payment Update Successfully');
                return redirect()->route('account.payment.view', $payment->id);
            } else if ($request->partner_type == "vendor") {
                session::flash('success', 'Payment Update Successfully');
                return redirect()->route('account.payment.view', $payment->id);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /** post jurnal */

    public function posted($id)
    {
        try {
            $payment = account_payment::find($id);
            if ($payment->partner_type == "customer") {
                $partner = res_customer::find($payment->partner_id);
                $credit = $partner->credit + $payment->amount;
                $partner->update([
                    'credit' => $credit,
                ]);
                $payment->update([
                    'state' => "posted"
                ]);
            } else {
                $partner = res_partner::find($payment->partner_id);
                $credit = $partner->credit + $payment->amount;
                $partner->update([
                    'credit' => $credit,
                ]);
                $payment->update([
                    'state' => "posted"
                ]);
            }
            return redirect(route('accountmove.payment', $id));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
