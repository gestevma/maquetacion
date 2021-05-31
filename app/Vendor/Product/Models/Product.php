<?php

namespace App\Vendor\Product\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 't_products';
    protected $guarded = [];

    public function scopeGetValues($query, $rel_parent, $product_id){

        return $query->where('product_id', $product_id)
            ->where('rel_parent', $rel_parent);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function taxes()
    {
        return $this->belongsTo(Tax::class);
    }
}