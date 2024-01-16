<?php

namespace Modules\Warehouse\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Warehouse\app\Models\Warehouse;
use Modules\Warehouse\app\Http\Requests\StoreWarehouseRequest;
use Modules\Warehouse\app\Http\Requests\EditWarehouseRequest;

class WarehouseController extends Controller
{

    /**
     * Instantiate a new ProductController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-warehouset|edit-warehouse|delete-warehouse', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-warehouse', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-warehouse', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-warehouse', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!empty($request->search)) {
            $warehouse = Warehouse::where('name', 'like', '%' . $request->search . '%')->latest()->paginate(10);
        } else {
            $warehouse = Warehouse::latest()->paginate(10);
        }

        return view('warehouse::index')->with(['warehouse' => $warehouse, 'keyword' => $request->search]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('warehouse::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWarehouseRequest $request): RedirectResponse
    {
        //
        $input = $request->all();
        $data_send = [
            'name' => $input['name'],
            'code' => $input['code']
        ];
        Warehouse::create($data_send);
        return redirect()->route('warehouse.index')
            ->withSuccess('New Warehouse is added successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('warehouse::show')->with(['warehouse' => Warehouse::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('warehouse::edit')->with(['warehouse' => Warehouse::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditWarehouseRequest $request, $id): RedirectResponse
    {
        //
        $input = $request->all();
        $data_send = [
            'name' => $input['name'],
            'code' => $input['code']
        ];
        Warehouse::find($id)->update($data_send);
        return redirect()->route('warehouse.index')
            ->withSuccess('New Warehouse is change successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        $destory = Warehouse::find($id);
        $destory->delete();

        return redirect()->route('warehouse.index')
            ->withSuccess('New Warehouse is delete successfully.');
    }
}
