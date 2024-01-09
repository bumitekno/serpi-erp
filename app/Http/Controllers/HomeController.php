<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class HomeController extends Controller
{
    //
    /**
     * Instantiate a new HomeController instance.
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('home')->with([
            'modules' => Permission::select('module')->distinct()->orderBy('module')->get()->toArray(),
        ]);
    }

}
