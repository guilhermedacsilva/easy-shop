<?php

namespace EasyShop\Observers;

use EasyShop\Model\Product;
use EasyShop\Model\ProductsMovement;
use Auth;

class ProductsMovementObserver
{
    public function creating($movement)
    {
        $movement->created_by = Auth::user()->id;
    }

    public function created($movement)
    {
        $this->calculateNewProductMovement($movement);
    }

    public function updating($movement)
    {
        $movement->updated_by = Auth::user()->id;

        $oldMovement = ProductsMovement::find($movement->id);
        $this->cancelProductMovement($oldMovement);
    }

    public function updated($movement)
    {

        $this->calculateNewProductMovement($movement);
    }

    public function deleting($movement)
    {
        $this->cancelProductMovement($movement);
    }

    protected function calculateNewProductMovement($movement)
    {
        $product = $movement->product->fresh();
        $product->addMovement($movement);
        $product->save();
    }

    protected function cancelProductMovement($movement)
    {
        $product = $movement->product->fresh();
        $product->subMovement($movement);
        $product->save();
    }
}
