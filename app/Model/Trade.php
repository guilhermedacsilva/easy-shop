<?php

namespace EasyShop\Model;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    const TYPE_PURCHASE = 0;
    const TYPE_SALE = 1;

    protected $fillable = [
        'type', 'total_value', 'discount', 'final_value', 'person_id', 'created_by', 'updated_by'
    ];

    public function getType()
    {
        return $this->type == self::TYPE_PURCHASE ? 'Purchase' : 'Sale';
    }

    public function person()
    {
        return $this->belongsTo('\EasyShop\Model\Person');
    }

    public function movements()
    {
        return $this->hasMany('\EasyShop\Model\ProductMovement');
    }

    public function productsNames()
    {
        $productNames = collect();
        $this->movements->each(function($movement) use ($productNames) {
            $productNames->push($movement->product->name);
        });
        return $productNames->unique()->implode(', ');
    }

}
