<?php
namespace Modules\Stock\app\Http\Controllers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StockOpnameExport implements FromView
{

    public $report;

    public function __construct($report)
    {
        $this->report = $report;
    }

    public function view(): View
    {
        return view('stock::stockopname', ['report' => $this->report]);
    }

}
