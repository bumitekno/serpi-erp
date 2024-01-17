<?php

namespace Modules\Stock\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Stock\app\Models\Stock;
use Modules\Warehouse\app\Models\Warehouse;
use Modules\Location\app\Models\Location;

class StockController extends Controller
{

    /**
     * Instantiate a new ProductController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-stock|edit-stock|delete-stock', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-stock', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-stock', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-stock', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!empty($request->search)) {

            $stock_product = Stock::with(['products', 'location', 'warehouse', 'units'])->whereHas('products', function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%')->orwhere('code_product', 'like', '%' . $request->search . '%');
            })->latest()->paginate(10);

        } else if (!empty($request->filter_location)) {
            $stock_product = Stock::with(['products', 'location', 'warehouse', 'units'])->whereHas('location', function ($query) use ($request) {
                return $query->where('id', '=', $request->filter_location);
            })->latest()->paginate(10);

        } else if (!empty($request->filter_warehouse)) {
            $stock_product = Stock::with(['products', 'location', 'warehouse', 'units'])->whereHas('warehouse', function ($query) use ($request) {
                return $query->where('id', '=', $request->filter_warehouse);
            })->latest()->paginate(10);

        } else {
            $stock_product = Stock::with(['products', 'location', 'warehouse', 'units'])->latest()->paginate(10);
        }

        $location = Location::query()->get();
        $warehouse = Warehouse::query()->get();

        return view('stock::index')->with([
            'stock' => $stock_product,
            'location' => $location,
            'warehouse' => $warehouse,
            'keyword' => $request->search,
            'filter_location' => $request->filter_location,
            'filter_warehouse' => $request->filter_warehouse
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stock::create');
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
        return view('stock::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('stock::edit');
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
