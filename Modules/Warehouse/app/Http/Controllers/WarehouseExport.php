<?php

namespace Modules\Warehouse\app\Http\Controllers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\Warehouse\app\Models\Warehouse;

class WarehouseExport implements FromView
{
    public function view(): View
    {
        return view('warehouse::export', [
            'warehouse' => Warehouse::all()
        ]);
    }
}


