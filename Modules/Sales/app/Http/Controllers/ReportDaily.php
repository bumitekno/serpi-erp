<?php
namespace Modules\Sales\app\Http\Controllers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportDaily implements FromView
{

    public $report;

    public function __construct($report)
    {
        $this->report = $report;
    }

    public function view(): View
    {
        return view('sales::dailyreport', ['report' => $this->report]);
    }

}