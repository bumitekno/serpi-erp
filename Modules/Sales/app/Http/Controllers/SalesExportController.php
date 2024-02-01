<?php

namespace Modules\Sales\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class SalesExportController implements FromView
{

    public $transaction;

    public function __construct($trans)
    {
        $this->transaction = $trans;
    }

    public function view(): View
    {
        return view('sales::export', [
            'transaction' => $this->transaction
        ]);
    }
}
