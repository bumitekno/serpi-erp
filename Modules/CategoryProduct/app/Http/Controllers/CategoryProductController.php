<?php

namespace Modules\CategoryProduct\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\CategoryProduct\app\Models\CategoryProduct;
use Modules\CategoryProduct\app\Http\Requests\StoreCategoryProduct;

class CategoryProductController extends Controller
{

    /**
     * Instantiate a new ProductController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-category-product|edit-category-product|delete-category-product', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-category-product', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-category-product', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-category-product', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!empty($request->search)) {
            $category = CategoryProduct::where('name', 'like', '%' . $request->search . '%')->latest()->paginate(10);
        } else {
            $category = CategoryProduct::latest()->paginate(10);
        }
        return view('categoryproduct::index')->with(['category' => $category, 'keyword' => $request->search]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categoryproduct::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryProduct $request): RedirectResponse
    {
        //
        $input = $request->all();
        $data_send = [
            'name' => $input['name'],
        ];
        if ($request->hasFile('image_category')) {
            $imageName = time() . '.' . $request->image_product->extension();
            $path = $request->file('image_category')->storeAs('/upload/category/images', $imageName, 'public');
            $data_send['image_category'] = $path;
        }

        CategoryProduct::create($data_send);
        return redirect()->route('categoryproduct.index')
            ->withSuccess('New category is added successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('categoryproduct::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('categoryproduct::edit');
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
