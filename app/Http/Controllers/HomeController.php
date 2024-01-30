<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;


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
            if (count($route) > 1) {
                return view('module_list')->with(['nav_route' => $route, 'group_module' => $module]);
            } else {
                $text_route = strtolower(Str::replace('_', '', $route[0]->module));
                return redirect()->route($text_route . '.index');
            }

        } else {
            return abort(403, 'Module' . $module . ' not found !');
        }
    }

}
