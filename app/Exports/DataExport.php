<?php

namespace App\Exports;

use App\Models\DataAlat;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class DataExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('data.export', [
            'data' => DataAlat::all()
        ]);
    }
}
