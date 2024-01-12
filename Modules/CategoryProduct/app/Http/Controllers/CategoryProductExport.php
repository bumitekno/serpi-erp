<?php
namespace Modules\CategoryProduct\app\Http\Controllers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\CategoryProduct\app\Models\CategoryProduct;

class CategoryProductExport implements FromView
{
    public function view(): View
    {
        return view('categoryproduct::export', [
            'category' => CategoryProduct::all()
        ]);
    }
}