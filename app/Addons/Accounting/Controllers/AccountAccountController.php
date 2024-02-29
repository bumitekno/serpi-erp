<?php

namespace App\Addons\Accounting\Controllers;

use Illuminate\Http\Request;
use App\Addons\Accounting\Models\account_account;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;


class AccountAccountController extends Controller
{

    /**
     * Instantiate a new AccountAccountController  instance.
     */
    public function __construct()
    {
        View::addLocation(app_path() . '/Addons/Accounting/Views');
    }

    /**
     * Display a listing of the resource.
     *
     */

    public function index()
    {
        $account = account_account::orderBy('code', 'ASC')->paginate(25);
        return view('accounting')->with(['account' => $account]);
    }

}