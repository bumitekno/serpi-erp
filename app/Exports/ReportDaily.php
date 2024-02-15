<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportDaily implements FromView
{
    public $transaction;

    public function __construct($trans)
    {
        $this->transaction = $trans;
    }

    public function view(): View
    {
        return view('report_export_daily_pos', [
            'report' => $this->transaction
        ]);
    }
}
