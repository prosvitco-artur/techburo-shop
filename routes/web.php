<?php

use Illuminate\Support\Facades\Route;
use League\Csv\Reader;
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

    $new_products = [];


    foreach ($records as $record) {
        $price = round((int) $record['Цена'] * 1.3);

        $title = strip_tags($record['Наименование']);
        $new_products[] = [
            'Код_товара' => $record['Код'],
            'Название_позиции' => $title,
            'Цена' =>  $price,
            'Валюта' => 'UAH',
            'Единица_измерения' => 'шт',
        ];
    }

    // create a new file
    $fp = fopen(storage_path('app/public/new.csv'), 'w');
    // save the column headers
    fputcsv($fp, ['Код_товара', 'Название_позиции', 'Цена', 'Валюта', 'Единица_измерения']);
    // save each row of the data
    foreach ($new_products as $row) {
        fputcsv($fp, $row);
    }
    dd($new_products);
});
