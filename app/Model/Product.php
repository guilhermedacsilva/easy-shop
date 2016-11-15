<?php

namespace EasyShop\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'quantity', 'created_by', 'updated_by'
    ];

    public function created_by_user()
    {
        return $this->belongsTo('EasyShop\Model\User', 'created_by');
    }

    public function updated_by_user()
    {
        return $this->belongsTo('EasyShop\Model\User', 'updated_by');
    }

}
