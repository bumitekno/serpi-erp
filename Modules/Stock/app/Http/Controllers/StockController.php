<?php

namespace Modules\Stock\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Stock\app\Models\Stock;
use Modules\Warehouse\app\Models\Warehouse;
use Modules\Location\app\Models\Location;
use Modules\UnitProduct\app\Models\UnitProduct;
use Modules\ProductPos\app\Models\ProductPos;

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
        return view('stock::create')->with([
            'unit' => UnitProduct::query()->get(),
            'product' => ProductPos::query()->get(),
            'warehouse' => Warehouse::query()->get(),
            'location' => Location::query()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        $request->validate([
            'addmore' => 'required|array',
            'addmore.product.*' => 'sometimes|required',
            'addmore.qty_convert.*' => 'sometimes|required',
            'location' => 'required',
            'warehouse' => 'required'
        ]);

        $exits = false;

        foreach ($request->addmore['product'] as $key => $val) {

            $check_product_stock = Stock::where(
                [
                    'id_product' => $val,
                    'id_unit' => $request->addmore['units'][$key],
                    'id_location' => $request->location,
                    'id_warehouse' => $request->warehouse
                ]
            )->first();

            if (!empty($check_product_stock)) {
                $exits = true;
            }

            $post_created = [
                'id_product' => $val,
                'id_unit' => $request->addmore['units'][$key],
                'qty_convert' => $request->addmore['qty_convert'][$key],
                'id_location' => $request->location,
                'id_warehouse' => $request->warehouse
            ];


            if ($exits == false)
                Stock::create($post_created);
        }

        if ($exits == false) {
            return redirect()->route('stock.index')
                ->withSuccess('New Stock is added successfully.');
        } else {
            return redirect()->back()
                ->with(['error' => 'New Stock is added failed.']);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $stock_product = Stock::with(['products', 'location', 'warehouse', 'units'])->find($id);
        return view('stock::show')->with(['stock' => $stock_product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $stock_product = Stock::with(['products', 'location', 'warehouse', 'units'])->find($id);
        return view('stock::edit')->with([
            'stock' => $stock_product,
            'warehouse' => Warehouse::query()->get(),
            'location' => Location::query()->get(),
            'unit' => UnitProduct::query()->get(),
            'product' => ProductPos::query()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
        $request->validate([
            'location' => 'required',
            'warehouse' => 'required',
            'product' => 'required',
            'qty_convert' => 'required'
        ]);

        $data_send = [
            'id_product' => $request->product,
            'id_unit' => $request->unit,
            'id_location' => $request->location,
            'id_warehouse' => $request->warehouse,
            'qty_convert' => $request->qty_convert
        ];

        Stock::find($id)->update($data_send);

        return redirect()->route('stock.index')
            ->withSuccess('New Stock is change successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        Stock::find($id)->delete();

        return redirect()->route('stock.index')
            ->withSuccess('New Stock is delete successfully.');
    }
}
