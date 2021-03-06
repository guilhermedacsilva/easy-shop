<?php

namespace EasyShop\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'quantity', 'created_by', 'updated_by'
    ];

    public function addMovement(ProductMovement $movement)
    {
        $this->quantity += $movement->getSignedQuantity();
    }

    public function subMovement(ProductMovement $movement)
    {
        $this->quantity -= $movement->getSignedQuantity();
    }

    public function created_by_user()
    {
        return $this->belongsTo('EasyShop\Model\User', 'created_by');
    }

    public function updated_by_user()
    {
        return $this->belongsTo('EasyShop\Model\User', 'updated_by');
    }

    public function movements()
    {
        return $this->hasMany('EasyShop\Model\ProductMovement');
    }

}
