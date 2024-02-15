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

        $data_send = [
            'name' => $row['name'],
            'code_product' => $row['code'],
            'category' => $row['id_category'],
            'description' => $row['description'],
            'enabled' => 1,
            'id_warehouse' => $row['id_warehouse'],
            'id_location' => $row['id_location']
        ];

        if (!empty($row['expired_date']))
            $data_send['date_expired'] = \Carbon\Carbon::parse($row['expired_date'])->format('Y-m-d');

        if (!empty($row['stock_min']))
            $data_send['stock_min'] = $row['stock_min'];

        if (!empty($row['stock_max']))
            $data_send['stock_max'] = $row['stock_max'];

        return ProductPos::create($data_send);
    }
}