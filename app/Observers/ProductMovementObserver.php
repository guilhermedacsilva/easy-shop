<?php

namespace EasyShop\Observers;

use EasyShop\Model\ProductMovement;

class ProductMovementObserver
{
    public function created($movement)
    {
        $this->calculateNewProductMovement($movement);
    }

    public function updating($movement)
    {
        $oldMovement = ProductMovement::find($movement->id);
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
