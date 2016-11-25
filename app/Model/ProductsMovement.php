<?php

namespace EasyShop\Model;

use Illuminate\Database\Eloquent\Model;

class ProductsMovement extends Model
{
    const TYPE_INPUT = 0;
    const TYPE_OUTPUT = 1;

    protected $fillable = [
        'quantity', 'total_value', 'type', 'product_id', 'created_by', 'updated_by',
    ];

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public function product()
    {
        return $this->belongsTo('EasyShop\Model\Product');
    }

    public function getType()
    {
        return self::getStringType($this->type);
    }

    public static function getStringType($typeInt)
    {
        return $typeInt == self::TYPE_INPUT ? 'Input' : 'Output';
    }

    public function isInput()
    {
        return $this->type == self::TYPE_INPUT;
    }

    public function getSignedQuantity()
    {
        return $this->isInput() ? $this->quantity : -$this->quantity;
    }

}
