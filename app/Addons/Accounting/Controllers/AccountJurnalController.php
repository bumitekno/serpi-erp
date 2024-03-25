<?php

namespace App\Addons\Accounting\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Addons\Accounting\Models\account_account;
use App\Addons\Accounting\Models\res_currency;
use App\Addons\Accounting\Models\account_account_type;
use App\Addons\Accounting\Models\account_journal;
use App\Addons\Accounting\Models\res_company;
use App\Addons\Accounting\Models\res_bank;
use App\Addons\Accounting\Models\res_Company_bank;

class AccountJurnalController extends Controller
{

    /**
     * The above function is a constructor in a PHP class that adds a custom view location for
     * accounting views.
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
        $journal = account_journal::with('company')->orderBy('name', 'ASC')->paginate(25);
        return view('journal.index')->with(['journal' => $journal]);
    }

    /**
     * This PHP function searches for account journals based on a specified key and value, handling
     * exceptions and displaying results in a paginated view.
     * 
     * @param Request request The `search` function in the code snippet you provided is used to search
     * for account journals based on a key and value provided in the request. Here's a breakdown of the
     * parameters used in the function:
     * 
     * @return  `search` function returns a view named 'accounting.journal.index' with the data from
     * the `journal` variable passed as compact data. If an exception occurs during the search process,
     * it will flash an error message with the exception message appended with 'Something Wrong' and
     * redirect back to the previous page.
     */
    public function search(Request $request)
    {
        $key = $request->filter;
        try {
            if ($key != "") {
                $journal = account_journal::orderBy('code', 'ASC')
                    ->where('name', 'like', "%" . $key . "%")
                    ->paginate(25);
                $journal->appends(['filter' => $key, 'submit' => 'Submit'])->links();
            } else {
                $journal = account_journal::orderBy('code', 'ASC')
                    ->paginate(25);
            }
            return view('journal.index')->with(['journal' => $journal]);
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage() . 'Something Wrong');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $company = res_company::orderBy('id', 'asc')->get();
        $account = account_account::orderBy('code', 'asc')->get();
        $bank_account = res_Company_bank::orderBy('company_bank_name', 'asc')->get();
        $bank = res_bank::orderBy('bank_name', 'asc')->get();
        $currency = res_currency::orderBy('currency_name', 'ASC')->get();
        $account_type = account_account_type::orderBy('id', 'ASC')->get();
        return view('journal.create')->with([
            'company' => $company,
            'account' => $account,
            'bank_account' => $bank_account,
            'bank' => $bank,
            'currency' => $currency,
            'account_type' => $account_type
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required|string|max:50',
            'type' => 'required',
            'currency_id' => 'required',
            'company_id' => 'required',
        ]);

        try {
            account_journal::create([
                'name' => $request->name,
                'code' => $request->code,
                'active' => True,
                'type' => $request->type,
                'currency_id' => $request->currency_id,
                'company_id' => $request->company_id,
                'default_credit_account_id' => $request->default_credit_account_id,
                'default_debit_account_id' => $request->default_debit_account_id,
                'profit_account_id' => $request->profit_account_id,
                'loss_account_id' => $request->loss_account_id,
                'post_at' => $request->post_at,
                'account_type_allowed' => $request->account_type_allowed,
                'account_allowed' => $request->account_allowed,
                'bank_account_id' => $request->bank_account_id,
                'bank' => $request->bank,
            ]);

            Session::flash('success', 'Journal Creation Successfully');
            return redirect()->back();
        } catch (\Exception $e) {

            Session::flash('error', $e->getMessage() . 'Something Wrong');

            return redirect()->back();
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
        $bank_account = res_Company_bank::orderBy('company_bank_name', 'asc')->get();
        $bank = res_bank::orderBy('bank_name', 'asc')->get();
        $journal = account_journal::findOrFail($id);
        $company = res_company::orderBy('id', 'asc')->get();
        $account = account_account::orderBy('code', 'asc')->get();
        $currency = res_currency::orderBy('currency_name', 'ASC')->get();
        $account_type = account_account_type::orderBy('id', 'ASC')->get();
        return view('journal.edit')->with([
            'company' => $company,
            'account' => $account,
            'bank_account' => $bank_account,
            'bank' => $bank,
            'currency' => $currency,
            'account_type' => $account_type,
            'journal' => $journal
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required|string|max:50',
            'type' => 'required',
            'currency_id' => 'required',
            'company_id' => 'required',
        ]);

        try {
            account_journal::where('id', $id)->update([
                'name' => $request->name,
                'code' => $request->code,
                'active' => True,
                'type' => $request->type,
                'currency_id' => $request->currency_id,
                'company_id' => $request->company_id,
                'default_credit_account_id' => $request->default_credit_account_id,
                'default_debit_account_id' => $request->default_debit_account_id,
                'profit_account_id' => $request->profit_account_id,
                'loss_account_id' => $request->loss_account_id,
                'post_at' => $request->post_at,
                'account_type_allowed' => $request->account_type_allowed,
                'account_allowed' => $request->account_allowed,
                'bank_account_id' => $request->bank_account_id,
                'bank' => $request->bank,
            ]);

            Session::flash('success', 'Journal Update Successfully');
            return redirect()->back();
        } catch (\Exception $e) {

            Session::flash('error', $e->getMessage() . 'Something Wrong');

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $account = account_journal::find($id);
        $account->delete();
        Session::flash('success', 'Journal ' . $account->name . ' |  ' . $account->code . ' Deleted Successfully');
        return redirect()->route('account.journal');
    }
}
