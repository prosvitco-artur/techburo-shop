<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // fillable
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id",
        "product_code",
        "position_name",
        "position_name_ukr",
        "search_queries_ukr",
        "search_queries",
        "price",
        "measurement_unit",
        "availability",
        "quantity",
    ];
}
