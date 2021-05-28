<?php

namespace App\Vendor\Product;

use App\Vendor\Product\Models\Product as DBProduct;

class Product
{
    protected $rel_parent;

    function __construct(DBProduct $product)
    {
        $this->product = $product;
    }

    public function setParent($rel_parent)
    {
        $this->rel_parent = $rel_parent;
    }

    public function getParent()
    {
        return $this->rel_parent;
    }
    

    public function store($product_id)
    {  

        $product = $this->product->updateOrCreate([

            'product_id' => $product_id,
            'rel_parent' => $this->rel_parent,],[
            'rel_parent' => $this->rel_parent,
            'origina_price' => request("original_price"),
            'taxes' => request("taxes"),
            'discount' => request("discount"),
            // "final_price"=> //Es una suma pero no se como hacerla 
        ]);

        return $locale;
    }

    public function show($key)
    {
        return DBLocale::getValues($this->rel_parent, $key)->pluck('value','rel_anchor')->all();   
    }

    public function delete($key)
    {
        if (DBLocale::getValues($this->rel_parent, $key)->count() > 0) {

            DBLocale::getValues($this->rel_parent, $key)->delete();   
        }
    }

    public function getIdByLanguage($key){ 
        return DBLocale::getIdByLanguage($this->rel_parent, $this->language, $key)->pluck('value','tag')->all();
    }

    public function getAllByLanguage(){ 

        $items = DBLocale::getAllByLanguage($this->rel_parent, $this->language)->get()->groupBy('key');

        $items =  $items->map(function ($item) {
            return $item->pluck('value','tag');
        });

        return $items;
    }
}
    


