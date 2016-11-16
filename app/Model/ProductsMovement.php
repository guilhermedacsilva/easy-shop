<?php

namespace EasyShop\Model;

use Illuminate\Database\Eloquent\Model;

class ProductsMovement extends Model
{
    protected $fillable = [
        'quantity', 'total_value', 'type', 'product_id',
    ];

    public function product()
    {
        return $this->belongsTo('EasyShop\Model\Product');
    }

    // public function getType()
    // {
    //     return $this->type == 0 ? 'Buy' : 'Sell';
    // }

}
