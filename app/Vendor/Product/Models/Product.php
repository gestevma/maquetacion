<?php

namespace App\Vendor\Product\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 't_products';

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function taxes()
    {
        return $this->belongsTo(Tax::class);
    }
}