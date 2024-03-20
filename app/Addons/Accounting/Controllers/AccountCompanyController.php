<?php

namespace App\Addons\Accounting\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Addons\Accounting\Models\res_company;
use App\Addons\Accounting\Models\res_currency;
use Illuminate\Support\Facades\View;


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
     * Display a listing of the resource.
     *
     */

    public function index()
    {
        $company = res_company::orderBy('code', 'ASC')->paginate(25);
        return view('company.index')->with(['company' => $company]);
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
