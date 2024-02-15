<?php

namespace Modules\ProductPos\app\Http\Controllers;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Modules\ProductPos\app\Http\Controllers\ProductPostTemplate;
use Modules\CategoryProduct\app\Http\Controllers\CategoryProductExport;
use Modules\Location\app\Http\Controllers\LocationExport;
use Modules\Warehouse\app\Http\Controllers\WarehouseExport;

class ProductPostSheetController implements WithMultipleSheets
{

    use Exportable;

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [
            new ProductPostTemplate(),
            new CategoryProductExport(),
            new LocationExport(),
            new WarehouseExport()
        ];

        return $sheets;
    }

}