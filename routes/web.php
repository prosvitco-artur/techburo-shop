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

    $keywords = [
        "Гбо 4 покоління",
        "Комплектуючі до ГБО",
        "Lpg гбо",
        "Lpg газ",
        "Гбо балон",
        "Мультиклапан",
        "Газовий редуктор ГБО 4 покоління",
        "Газовий редуктор ГБО 2 покоління",
        "Балон"
    ];

    foreach ($records as $record) {
        $price = round((int) $record['Цена'] * 1.3);
        $count = substr_count(strip_tags($record['Остаток']), "*") * 4;
        if ($record['Ед. изм.'] == 'к-т') {
            $unit = 'комплект';
        } elseif ($record['Ед. изм.'] == 'шт.') {
            $unit = 'шт.';
        } else {
            $unit = $record['Ед. изм.'];
        }

        $title = strip_tags($record['Наименование']);
        $new_products[] = [
            'Код_товара' => $record['Код'],
            'Название_позиции' => $title,
            'Название_позиции_укр' => $title,
            'Поисковые_запросы_укр' => implode('; ', $keywords),
            'Поисковые_запросы' => implode('; ', $keywords),
            'Цена' =>  $price,
            'Валюта' => 'UAH',
            'Единица_измерения' => "шт.",
            "Номер_группы" => 117838808,
            'Название_группы' => 'ГБО',
            'Наличие' => $count > 0 ? '+' : '-',
            'Количество' => $count,
            'Где_находится_товар' => 'Винница',
            'Название_Характеристики' => 'Состояние',
            'Измерение_Характеристики' => '',
            'Значение_Характеристики' => 'Новый',


        ];
    }

    // create a new file
    $fp = fopen(storage_path('app/public/new.csv'), 'w');
    // save the column headers
    fputcsv($fp, array_keys($new_products[0]));
    // save each row of the data
    foreach ($new_products as $row) {
        fputcsv($fp, $row);
    }
    dd($new_products);
});
