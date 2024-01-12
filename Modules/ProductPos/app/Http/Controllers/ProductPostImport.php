<?php

namespace Modules\ProductPos\app\Http\Controllers;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Modules\ProductPos\app\Models\ProductPos;

class ProductPostImport implements ToModel, WithStartRow, WithHeadingRow
{
    use Importable;

    public function startRow(): int
    {
        return 10;
    }

    public function model(array $row)
    {
        if (!array_filter($row)) {
            return null;
        }

        return ProductPos::create([
            'name' => $row['name'],
            'code_product' => $row['code'],
            'category' => $row['id_category'],
            'description' => $row['description']
        ]);
    }
}