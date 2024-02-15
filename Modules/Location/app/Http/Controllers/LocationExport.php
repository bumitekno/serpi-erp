<?php

namespace Modules\Location\app\Http\Controllers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\Location\app\Models\Location;

class LocationExport implements FromView
{
    public function view(): View
    {
        return view('location::export', [
            'location' => Location::all()
        ]);
    }
}
