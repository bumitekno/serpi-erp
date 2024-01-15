<?php

namespace Modules\UnitProduct\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\UnitProduct\app\Models\UnitProduct;


class UnitProductController extends Controller
{


    /**
     * Instantiate a new ProductController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-unit-product|edit-unit-product|delete-category-product', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-unit-product', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-unit-product', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-unit-product', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!empty($request->search)) {
            $unitproduct = UnitProduct::where('name', 'like', '%' . $request->search . '%')->latest()->paginate(10);
        } else {
            $unitproduct = UnitProduct::latest()->paginate(10);
        }

        return view('unitproduct::index')->with(['unit' => $unitproduct]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('unitproduct::create');
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
        return view('unitproduct::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('unitproduct::edit');
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
