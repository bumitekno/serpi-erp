<?php

namespace Modules\ProductPos\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\CategoryProduct\app\Models\CategoryProduct;
use Modules\ProductPos\app\Models\ProductPos;
use Modules\ProductPos\app\Http\Requests\EditProductRequest;
use Modules\ProductPos\app\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Storage;

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
        $this->middleware('permission:import-product', ['only' => ['import']]);
        $this->middleware('permission:export-product', ['only' => ['export']]);
        $this->middleware('permission:download-product', ['only' => ['download']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('productpos::index')->with(['products' => ProductPos::with('category_product')->latest()->paginate(10)]);
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

    /** import product */
    public function import()
    {

    }

    /** export */
    public function export()
    {

    }

    /** download */

    public function download()
    {

    }
}
