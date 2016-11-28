<?php

namespace EasyShop\Model;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    const TYPE_PURCHASE = 0;
    const TYPE_SALE = 1;

    protected $fillable = [
        'type', 'total_value', 'discount', 'final_value', 'customer_id', 'created_by', 'updated_by'
    ];

    public function getType()
    {
        return $this->type == self::TYPE_PURCHASE ? 'Purchase' : 'Sale';
    }

    public function customer()
    {
        return $this->belongsTo('\EasyShop\Model\Customer');
    }

}
