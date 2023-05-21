<?php

use Illuminate\Support\Facades\Route;
use League\Csv\Reader;
use League\Csv\CharsetConverter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $csv = Reader::createFromPath(storage_path('app/public/test.csv'), 'r');
    $csv->setHeaderOffset(0);
    $records = $csv->getRecords();

    foreach ($records as $record) {
        dd($record);
    }
});
