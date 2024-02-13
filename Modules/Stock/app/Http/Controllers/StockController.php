<?php

namespace Modules\Stock\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Stock\app\Models\Stock;
use Modules\Stock\app\Models\StockOpname;
use Modules\Warehouse\app\Models\Warehouse;
use Modules\Location\app\Models\Location;
use Modules\UnitProduct\app\Models\UnitProduct;
use Modules\ProductPos\app\Models\ProductPos;
use Modules\Purchase\app\Models\TransactionPurchase;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Stock\app\Http\Controllers\StockOpnameExport;


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
     * Show the form for creating a new resource.
     */

    public function createstokP(Request $request)
    {
        if ($request->ajax()) {
            $data_trans = TransactionPurchase::where('status', '=', '1')->latest()->get();
            return DataTables::of($data_trans)
                ->addIndexColumn()
                ->editColumn('date_purchase', function ($row) {
                    return empty($row->date_purchase) ? '-' : Carbon::parse($row->date_purchase)->translatedFormat('d F Y');
                })
                ->editColumn('transfer_stock', function ($row) {
                    return $row->transfer_stock == 1 ? 'N' : 'Y';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('purchase.show', $row->id) . '?import=true&transfer=stock" class="edit btn btn-info btn-sm me-2"> <i class="bi bi-eye"></i> detail</a>';
                    return $btn;
                })->rawColumns(['action'])->make();
        }
        return view('stock::create_stock_purchase');
    }

    /** ajax product  */
    public function ajaxproduct(Request $request)
    {
        $product = ProductPos::where(['id' => $request->id, 'id_warehouse' => $request->id_warehouse, 'id_location' => $request->id_location])->first()->toArray();
        return response()->json(['data' => $product], 200);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function createopname(Request $request)
    {
        if ($request->ajax()) {
            $data_trans = StockOpname::with('products', 'units', 'location', 'warehouse')->latest()->get();
            return DataTables::of($data_trans)
                ->addIndexColumn()
                ->editColumn('date_opname', function ($row) {
                    return empty($row->date_opname) ? '-' : Carbon::parse($row->date_opname)->translatedFormat('d F Y');
                })
                ->editColumn('warehouse', function ($row) {
                    return $row->warehouse?->name;
                })
                ->editColumn('location', function ($row) {
                    return $row->location?->name_location;
                })
                ->editColumn('product', function ($row) {
                    return $row->products?->name;
                })
                ->editColumn('code_product', function ($row) {
                    return $row->products?->code_product;
                })
                ->editColumn('unit', function ($row) {
                    return $row->units?->name;
                })
                ->make();
        }

        return view('stock::createopname')->with([
            'unit' => UnitProduct::query()->get(),
            'product' => ProductPos::query()->get(),
            'warehouse' => Warehouse::query()->get(),
            'location' => Location::query()->get()
        ]);
    }

    /** export excel stockopname */

    public function download_stockopname()
    {
        $report = StockOpname::with('products', 'units', 'location', 'warehouse')->latest()->get();
        return Excel::download(new StockOpnameExport($report), 'stock_opname.xls');
    }

    public function storeopname(Request $request)
    {

        foreach ($request->addmore['product'] as $key => $val) {
            $checkProduct = ProductPos::where([
                'id' => $val,
                'id_warehouse' => $request->warehouse,
                'id_location' => $request->location,
            ])->first();

            if (empty($checkProduct)) {
                $check = true;
            } else {
                $check = false;
                $items = [
                    'id_product' => $val,
                    'id_unit' => $request->addmore['units'][$key],
                    'stock_before' => $request->addmore['qty_before'][$key],
                    'stock_after' => $request->addmore['qty_after'][$key],
                    'difference' => $request->addmore['qty_difference'][$key],
                    'id_warehouse' => $request->warehouse,
                    'id_location' => $request->location,
                    'date_opname' => Carbon::now()->format('Y-m-d')
                ];
                $create_opname = StockOpname::create($items);
                if (!empty($create_opname)) {
                    ProductPos::where([
                        'id' => $create_opname->id_product,
                        'id_warehouse' => $create_opname->id_warehouse,
                        'id_location' => $create_opname->id_location
                    ])->update(['stock_last' => $create_opname->stock_after]);
                }
            }
        }

        if ($check == false) {
            Session::flash('success', 'Transaction  Stock Opname is successfully !');
        } else {
            Session::flash('error', 'Transaction  Stock Opname is failed, Product Not Found !');
        }

        return redirect()->back();
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
