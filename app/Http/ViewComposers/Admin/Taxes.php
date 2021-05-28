<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Tax as DBTax;

class Taxes
{
    static $composed;

    public function __construct(DBTax $taxes)
    {
        $this->taxes = $taxes;
    }

    public function compose(View $view)
    {
        if(static::$composed)
        {
            return $view->with('taxes', static::$composed);
        }

        static::$composed = $this->taxes->orderBy('taxes', 'asc')->get();

        $view->with('taxes', static::$composed);
    }
}

