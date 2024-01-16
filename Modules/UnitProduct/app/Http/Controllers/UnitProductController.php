<?php

namespace Modules\UnitProduct\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\UnitProduct\app\Models\UnitProduct;
use Modules\UnitProduct\app\Http\Requests\StoreUnitProductRequest;
use Modules\UnitProduct\app\Http\Requests\EditUnitProductRequest;


class UnitProductController extends Controller
{


    /**
     * Instantiate a new ProductController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-unit-product|edit-unit-product|delete-unit-product', ['only' => ['index', 'show']]);
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

        return view('unitproduct::index')->with(['unit' => $unitproduct, 'keyword' => $request->search]);
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
    public function store(StoreUnitProductRequest $request): RedirectResponse
    {
        //
        $input = $request->all();
        $data_send = [
            'name' => $input['name'],
        ];
        UnitProduct::create($data_send);
        return redirect()->route('unitproduct.index')
            ->withSuccess('New Unit is added successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('unitproduct::show')->with(['unit' => UnitProduct::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('unitproduct::edit')->with(['unit' => UnitProduct::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditUnitProductRequest $request, $id): RedirectResponse
    {
        //
        $edit = UnitProduct::find($id);
        $data_send = [
            'name' => $request->name,
        ];
        $edit->update($data_send);
        return redirect()->route('unitproduct.index')
            ->withSuccess('New Unit is change successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $destory = UnitProduct::find($id);
        $destory->delete();

        return redirect()->route('unitproduct.index')
            ->withSuccess('New Unit is delete successfully.');

    }
}
