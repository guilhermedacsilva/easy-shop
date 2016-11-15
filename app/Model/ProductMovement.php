<?php

namespace EasyShop\Model;

use Illuminate\Database\Eloquent\Model;

class ProductMovement extends Model
{
    protected $fillable = [
        'quantity', 'total_value', 'type', 'product_id', 'client_id'
    ];

    public function getType()
    {
        return $this->type == 0 ? 'Buy' : 'Sell';
    }

}
