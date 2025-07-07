<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;

Route::get('/', function () {
    return view('welcome');
});

// Data monitoring routes
Route::get('/data', [DataController::class, 'index'])->name('data.index');
Route::get('/data/fetch', [DataController::class, 'fetchData'])->name('data.fetch');
Route::get('/data/fetch-latest', [DataController::class, 'getLatestData'])->name('data.latest');
Route::get('/data/export', [DataController::class, 'exportData'])->name('data.export');
