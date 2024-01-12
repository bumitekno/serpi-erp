<?php

namespace Modules\ProductPos\app\Http\Controllers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\ProductPos\app\Models\ProductPos;

class ProductPosExportController implements FromView
{
    public function view(): View
    {
        return view('productpos::export', [
            'product' => ProductPos::with('category_product')->get()
        ]);
    }
}
