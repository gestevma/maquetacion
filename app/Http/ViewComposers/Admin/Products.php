<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Vendor\Product\Models\Product;

class Products 
{
    public $product;

    public function __construct()
    {
        $this->product = Product::orderBy('id', 'asc')->get();
    }

    public function compose(View $view)
    {
        $view->with('product', $this->product);
    }
}