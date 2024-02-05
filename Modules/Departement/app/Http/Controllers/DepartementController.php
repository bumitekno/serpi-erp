<?php

namespace Modules\Departement\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Departement;
use Modules\Location\app\Models\Location;
use Modules\Warehouse\app\Models\Warehouse;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!empty($request->search)) {
            $departement = Departement::with(['warehouse', 'location'])->where('name', 'like', '%' . $request->search . '%')->latest()->paginate(10);
        } else {
            $departement = Departement::with(['warehouse', 'location'])->latest()->paginate(10);
        }

        $warehouse = Warehouse::query()->get();
        $location = Location::query()->get();

        return view('departement::index')->with(['departement' => $departement, 'keyword' => $request->search, 'warehouse' => $warehouse, 'location' => $location]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departement::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('departement::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('departement::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
