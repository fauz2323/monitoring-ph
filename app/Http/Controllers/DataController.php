<?php

namespace App\Http\Controllers;

use App\Exports\DataExport;
use App\Models\DataAlat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class DataController extends Controller
{
    function index()
    {
        $dataAlat = DataAlat::latest()->first();
        $recentData = DataAlat::latest()->take(10)->get();
        return view('data.index', compact('dataAlat', 'recentData'));
    }

    function fetchData()
    {
        $response = Http::get('https://blynk.cloud/external/api/getAll?token=4F1jFxEVdlZm2-wh8oG8z2z3q-bt5GcP');

        $data = $response->json();
        $tds = $data['v0'];
        $ph = $data['v3'];
        $turbidity = $data['v1'];

        if ($ph < 6.5 || $tds > 500 || $turbidity > 5000) {
            $keterangan = 'Air Tidak Layak';
        } else {
            $keterangan = 'Air Layak';
        }

        $dataAlat = DataAlat::create([
            'ph' => $ph,
            'tds' => $tds,
            'turbidity' => $turbidity,
            'keterangan' => $keterangan
        ]);

        $recentData = DataAlat::latest()->take(10)->get();

        return response()->json($recentData);
    }

    function getLatestData()
    {
        $latestData = DataAlat::latest()->first();
        return response()->json($latestData);
    }

    function exportData()
    {
        return Excel::download(new DataExport(), 'data_alat.xlsx');
    }
}
