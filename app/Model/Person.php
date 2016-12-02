<?php

namespace EasyShop\Model;

use Illuminate\Database\Eloquent\Model;
use EasyShop\Traits\Model\RestIndex;

class Person extends Model
{
    use RestIndex;
    
    const TYPE_CUSTOMER = 0;
    const TYPE_SUPPLIER = 1;

    protected $fillable = [
        'name', 'type'
    ];

    public function scopeCustomer($query)
    {
        return $query->where('type', '=', self::TYPE_CUSTOMER);
    }

    public function scopeSupplier($query)
    {
        return $query->where('type', '=', self::TYPE_SUPPLIER);
    }
}
