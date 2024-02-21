<?php

namespace Modules\Purchase\app\Http\Controllers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class PurchaseExportController implements FromView
{

    public $transaction;

    public function __construct($trans)
    {
        $this->transaction = $trans;
    }

    public function view(): View
    {
        return view('purchase::export', [
            'transaction' => $this->transaction
        ]);
    }
}
