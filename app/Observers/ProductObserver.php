<?php

namespace EasyShop\Observers;

use EasyShop\Model\Product;
use Auth;

class ProductObserver
{
    public function creating($product)
    {
        $product->created_by = Auth::user()->id;
    }

    public function updating($product)
    {
        $product->updated_by = Auth::user()->id;
    }
}
