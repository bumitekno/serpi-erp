<?php

namespace Modules\ProductPos\app\Http\Controllers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class ProductPostTemplate implements FromView, ShouldAutoSize, WithStyles, WithColumnWidths
{
    public function view(): View
    {
        return view('productpos::template');
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 20,
            'D' => 10,
            'E' => 30,
            'F' => 20,
            'G' => 20,
            'H' => 20,
            'I' => 20,
            'J' => 20,
            'K' => 50,
            'L' => 20,
            'M' => 20,
            'N' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // merge cells
        $sheet->mergeCells('A2:n2');
        $sheet->mergeCells('A3:n3')->setCellValue('A3', "1. Semua cell diwajibkan menggunakan format text");
        $sheet->mergeCells('A4:n4')->setCellValue('A4', "2. Kode Product Harus Unique ");
        $sheet->mergeCells('A5:n5')->setCellValue('A5', "3. Isi ID Category bisa lihat sheet Data Category ");
        $sheet->mergeCells('A6:n6');
        $sheet->mergeCells('A7:n7');
        $sheet->mergeCells('A8:n8');
        $sheet->getStyle('A9:N9')->getFont()->setBold(true);

        // style cells
        $sheet->getStyle('A9:N72')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000']
                ],
            ],
        ]);

        $sheet->getRowDimension(1)->setVisible(false);
        $sheet->getStyle('A2:N8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFFFF00');
    }
}