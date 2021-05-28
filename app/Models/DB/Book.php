<?php

namespace App\Models\DB;
use App\Vendor\Product\Models\Product;

class Book extends DBModel
{
    protected $table = 't_books';

    public function products()
    {
        return $this->hasOne(Product::class, 'product_id');
    }

    public function taxes()
    {
        return $this->belongsTo(Tax::class);
    }
}