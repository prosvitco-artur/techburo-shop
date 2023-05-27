<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use League\Csv\Reader;

class CreateImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-import {--file=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create import from json file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = $this->option('file');
        $csv = Reader::createFromPath(storage_path('app/public/' . $file), 'r');
        $csv->setHeaderOffset(0);
        $products = $csv->getRecords();

        foreach ($products as $key => $product) {

            $price = round((int) $product['Цена'] * 1.3);
            $count = substr_count(strip_tags($product['Остаток']), "*") * 4;
            $title = strip_tags($product['Наименование']);
            $product_code = $product['Код'];

            if ($product['Ед. изм.'] == 'к-т') {
                $unit = 'комплект';
            } elseif ($product['Ед. изм.'] == 'шт.') {
                $unit = 'шт.';
            } else {
                $unit = $product['Ед. изм.'];
            }
            $products_array = [
                "product_code" => $product_code,
                "position_name" => $title,
                "position_name_ukr" => $title,
                "price" => $price,
                "measurement_unit" => $unit,
                "availability" => $count > 0 ? true : false,
                "quantity" => $count,
            ];
            $product = \App\Models\Product::updateOrCreate(
                ['product_code' => $product_code],
                $products_array
            );
        }

        $this->info('Products have been created or updated successfully.');
    }
}
