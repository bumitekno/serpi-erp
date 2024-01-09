<?php

namespace Modules\ProductPos\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\ProductPos\app\Models\ProductPos;
use Modules\ProductPos\app\Http\Requests\EditProductRequest;
use Modules\ProductPos\app\Http\Requests\StoreProductRequest;

class ProductPosController extends Controller
{

    /**
     * Instantiate a new ProductController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-product|edit-product|delete-product', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-product', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-product', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-product', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('productpos::index')->with(['products' => ProductPos::latest()->paginate(3)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productpos::create');
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
    public function show(ProductPos $product)
    {
        return view('productpos::show')->with([
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductPos $product)
    {
        return view('productpos::edit')->with([
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditProductRequest $request, ProductPos $product): RedirectResponse
    {
        //
        $product->update($request->all());
        return redirect()->back()
            ->withSuccess('Product is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        ProductPos::find($id)->delete();
        return redirect()->route('productpos.index')
            ->withSuccess('Product is deleted successfully.');
    }
}
