<?php

namespace App\Addons\Accounting\Controllers;

use Illuminate\Http\Request;
use App\Addons\Accounting\Models\account_account;
use App\Addons\Accounting\Models\res_currency;
use App\Addons\Accounting\Models\res_company;
use App\Addons\Accounting\Models\account_account_type;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;



class AccountAccountController extends Controller
{

    /**
     * Instantiate a new AccountAccountController  instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        View::addLocation(app_path() . '/Addons/Accounting/Views');
    }


    /**
     * This PHP function retrieves and paginates account data based on search query and sorting criteria.
     * 
     * @param Request request The `index` function in the code snippet is a controller method that handles
     * the logic for displaying a list of accounts. Let me explain the parameters used in this function:
     * 
     * @return  `index` function is returning a view named 'account.index' with an array of data
     * containing the 'account' variable which holds the paginated results of the query based on the
     * search term ('q') and sorting order ('sortby'). The 'q' variable holds the search term, and the
     * 'sort' variable holds the sorting order.
     */

    public function index(Request $request)
    {
        $sortby = empty ($request->sortby) ? 'asc' : $request->sortby;

        if (!empty ($request->q)) {
            $account = account_account::with('company', 'account_type')->where('name', 'like', '%' . $request->q . '%')->orderBy('code', $sortby)->paginate(10)->appends(['sortby' => Str::lower($sortby)]);
        } else {
            $account = account_account::with('company', 'account_type')->orderBy('code', $sortby)->paginate(10)->appends(['sortby' => Str::lower($sortby)]);
        }

        return view('account.index')->with(['account' => $account, 'q' => $request->q, 'sort' => Str::lower($sortby)]);
    }

    /**
     * The `create` function retrieves and passes account types, companies, and currencies to the view for
     * creating a new account.
     * 
     * @return  `create()` function is returning a view called 'account.create' along with three
     * variables: `account_type`, `company`, and `currency`. These variables contain data fetched from the
     * `account_account_type`, `res_company`, and `res_currency` models respectively, ordered in ascending
     * order.
     */

    public function create()
    {
        $account_type = account_account_type::orderBy('id', 'ASC')->get();
        $company = res_company::orderBy('id', 'asc')->get();
        $currency = res_currency::orderBy('currency_name', 'ASC')->get();
        return view('account.create')->with(['account_type' => $account_type, 'company' => $company, 'currency' => $currency]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:account_accounts',
            'name' => 'required|string|max:50',
            'type' => 'required',
            'currency_id' => 'required',
            'company_id' => 'required',
        ]);

        try {
            account_account::create([
                'name' => $request->name,
                'currency_id' => $request->currency_id,
                'code' => $request->code,
                'deprecated' => $request->deprecated,
                'type' => $request->type,
                'internal_type' => $request->internal_type,
                'internal_group' => $request->internal_group,
                'reconcile' => $request->reconcile,
                'company_id' => $request->company_id,
            ]);
            Session::flash('success', 'Chart Of Account Creation Successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage() . 'Something Wrong');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $account = account_account::findOrFail($id);
        $account_type = account_account_type::orderBy('id', 'ASC')->get();
        $company = res_company::orderBy('id', 'asc')->get();
        $currency = res_currency::orderBy('currency_name', 'ASC')->get();
        return view('account.edit')->with(['account_type' => $account_type, 'company' => $company, 'currency' => $currency, 'account' => $account]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'code' => 'required|unique:account_accounts,code,' . $id . '',
            'name' => 'required|string|max:50',
            'type' => 'required',
            'currency_id' => 'required',
            'company_id' => 'required',
        ]);

        try {
            account_account::where('code', $request->code)->update([
                'name' => $request->name,
                'currency_id' => $request->currency_id,
                'deprecated' => $request->deprecated,
                'type' => $request->type,
                'internal_type' => $request->internal_type,
                'internal_group' => $request->internal_group,
                'reconcile' => $request->reconcile,
                'company_id' => $request->company_id,
            ]);
            Session::flash('success', 'Chart Of Account Updated Successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage() . 'Something Wrong');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = account_account::find($id);
        $account->delete();
        Session::flash('success', 'Chart Of Account ' . $account->name . ' |  ' . $account->code . ' Deleted Successfully');
        return redirect()->route('account.index');
    }

}