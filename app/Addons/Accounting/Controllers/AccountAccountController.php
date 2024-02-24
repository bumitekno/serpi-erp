<?php

namespace App\Addons\Accounting\Controllers;

use Illuminate\Http\Request;
use App\Addons\Accounting\Models\account_account;
use App\Http\Controllers\Controller;


class AccountAccountController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $account = account_account::orderBy('code', 'ASC')->paginate(25);
        return view('accounting.account.index')->with(['account' => $account]);
    }

}