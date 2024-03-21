<?php

namespace App\Addons\Accounting\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Addons\Accounting\Models\res_company;
use App\Addons\Accounting\Models\res_currency;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


class AccountCompanyController extends Controller
{

    /**
     * The above function is a PHP constructor that adds a custom view location for an accounting addon
     * in a Laravel application.
     */
    public function __construct()
    {
        $this->middleware('auth');
        View::addLocation(app_path() . '/Addons/Accounting/Views');
    }



    /**
     * This PHP function retrieves and paginates company data based on search query and sorting
     * criteria.
     * 
     * @param Request request The `index` function in the code snippet is a controller method that
     * handles the logic for displaying a list of companies. Let me explain the parameters used in this
     * function:
     * 
     * @return ` function `index` is returning a view called 'company.index' with an array of data
     * containing the paginated list of companies based on the search query and sorting criteria. The
     * data being passed to the view includes the paginated list of companies (``), the search
     * query (``), and the sorting order (``).
     */

    public function index(Request $request)
    {
        $sortby = empty ($request->sortby) ? 'asc' : $request->sortby;

        if (!empty ($request->q)) {
            $company = res_company::where('company_name', 'like', '%' . $request->q . '%')->orderBy('code', $sortby)->paginate(25)->appends(['sortby' => Str::lower($sortby)]);
        } else {
            $company = res_company::orderBy('code', $sortby)->paginate(25)->appends(['sortby' => Str::lower($sortby)]);
        }
        return view('company.index')->with(['company' => $company, 'q' => $request->q, 'sort' => Str::lower($sortby)]);
    }

    /** 
     *  * Display a listing of the resource.
     */
    public function create()
    {
        $res_currency = res_currency::orderBy('id', 'ASC')->get();
        return view('company.create')->with(['res_currency' => $res_currency]);
    }
}
