<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code');
            $table->string('position_name')->nullable();
            $table->string('position_name_ukr')->nullable();
            $table->longText('search_queries_ukr')->nullable();
            $table->longText('search_queries')->nullable();
            $table->longText('description')->nullable();
            $table->longText('description_ukr')->nullable();
            $table->integer('price')->nullable();
            $table->string('measurement_unit')->nullable();
            $table->boolean('availability')->nullable();
            $table->integer('quantity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
