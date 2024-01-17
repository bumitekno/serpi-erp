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
        return view('home')->with([]);
    }

    public function checkroute($module)
    {
        $group_modules = Permission::select('group_modules')->distinct()->orderBy('group_modules')->where('group_modules', '=', $module)->first();
        if (!empty($group_modules)) {
            $route = Permission::select('module', 'group_modules')->distinct()->where('group_modules', $module)->orderBy('module')->get();
            return view('module_list')->with(['nav_route' => $route, 'group_module' => $module]);
        } else {
            return abort(403, 'Module' . $module . ' not found !');
        }
    }

}
