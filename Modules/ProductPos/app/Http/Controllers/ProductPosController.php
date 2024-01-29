<?php

namespace Modules\ProductPos\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Modules\CategoryProduct\app\Models\CategoryProduct;
use Modules\ProductPos\app\Models\ProductPos;
use Modules\ProductPos\app\Http\Requests\EditProductRequest;
use Modules\ProductPos\app\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Modules\ProductPos\app\Http\Controllers\ProductPosExportController;
use Modules\ProductPos\app\Http\Controllers\ProductPostSheetController;
use Modules\ProductPos\app\Http\Controllers\ProductPostImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductPosController extends Controller
{

    /**
     * Instantiate a new ProductController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-product|edit-product|delete-product|import-product|export-product|download-product', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-product', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-product', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-product', ['only' => ['destroy']]);
        $this->middleware('permission:import-product', ['only' => ['importview']]);
        $this->middleware('permission:export-product', ['only' => ['export']]);
        $this->middleware('permission:download-product', ['only' => ['download']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!empty($request->search)) {
            $product = ProductPos::with('category_product')->where('name', 'like', '%' . $request->search . '%')->latest()->paginate(10);
        } else {
            $product = ProductPos::with('category_product')->latest()->paginate(10);
        }

        return view('productpos::index')->with(['products' => $product, 'keyword' => $request->search]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productpos::create', ['category_product' => CategoryProduct::query()->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        //

        $input = $request->all();

        $data_send = [
            'name' => $input['name'],
            'code_product' => $input['code_product'],
            'category' => $input['category'],
            'description' => $input['description']
        ];

        if ($request->hasFile('image_product')) {
            $imageName = time() . '.' . $request->image_product->extension();
            $path = $request->file('image_product')->storeAs('/upload/product/images', $imageName, 'public');
            $data_send['image_product'] = $path;
        }

        if (!empty($request->stockmin))
            $data_send['stock_min'] = $request->stockmin;

        if (!empty($request->stockmax))
            $data_send['stock_max'] = $request->stockmax;

        if (!empty($expired))
            $data_send['date_expired'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->expired)->format('Y-m-d');

        ProductPos::create($data_send);
        return redirect()->route('productpos.index')
            ->withSuccess('New product is added successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $product = ProductPos::with('category_product')->find($id);
        return view('productpos::show')->with([
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('productpos::edit')->with([
            'product' => ProductPos::with('category_product')->find($id),
            'category_product' => CategoryProduct::query()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditProductRequest $request, $id): RedirectResponse
    {
        //

        $product = ProductPos::find($id);

        $input = $request->all();

        $data_send = [
            'name' => $input['name'],
            'code_product' => $input['code_product'],
            'category' => $input['category'],
            'description' => $input['description']
        ];

        if ($request->hasFile('image_product')) {

            if (!empty($product->image_product)) {
                if (Storage::disk('public')->exists($product->image_product))
                    Storage::disk('public')->delete($product->image_product);
            }

            $imageName = time() . '.' . $request->image_product->extension();
            $path = $request->file('image_product')->storeAs('/upload/product/images', $imageName, 'public');
            $data_send['image_product'] = $path;
        }

        if (!empty($request->stockmin))
            $data_send['stock_min'] = $request->stockmin;

        if (!empty($request->stockmax))
            $data_send['stock_max'] = $request->stockmax;

        if (!empty($expired))
            $data_send['date_expired'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->expired)->format('Y-m-d');

        $product->update($data_send);

        return redirect()->back()
            ->withSuccess('Product is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $product = ProductPos::find($id);
        if (!empty($product->image_product)) {
            if (Storage::disk('public')->exists($product->image_product))
                Storage::disk('public')->delete($product->image_product);
        }
        $product->delete();
        return redirect()->route('productpos.index')
            ->withSuccess('Product is deleted successfully.');
    }

    /**
     * Display a listing of the resource.
     */

    public function importview()
    {
        return view('productpos::import');
    }


    /** import product */
    public function import(Request $request)
    {
        $file = $request->file('file');

        try {

            (new ProductPostImport)->import($file, null, \Maatwebsite\Excel\Excel::XLSX);

            return response()->json([
                'message' => 'Data Product berhasil diimport',
                'status' => true,
            ], 200);

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
                $error_tampil = '' . $failure->errors()[0] . 'pada baris ke-' . $failure->row() . '';
            }

            return response()->json([
                'message' => $error_tampil
            ], 302);
        }
    }


    /** export */
    public function export()
    {
        return Excel::download(new ProductPosExportController, 'product-export.xlsx');
    }

    /** download */

    public function download()
    {
        return Excel::download(new ProductPostSheetController, 'product-template.xlsx');
    }
}
