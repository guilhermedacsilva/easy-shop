<?php

namespace EasyShop\Http\Controllers;

use Illuminate\Http\Request;
use EasyShop\Traits\CrudActions;
use EasyShop\Model\ProductMovement;
use EasyShop\Model\Product;
use Auth;

class ProductMovementController extends Controller
{
    use CrudActions;

    public function __construct() {
        $this->initCrud([
            'model' => 'ProductMovement',
            'routePrefix' => 'movements',
            'viewFolder' => 'product_movements',
            'titleCreate' => 'Movement',
            'indexOrderBy' => 'created_at',
            'indexOrderByAsc' => 'desc',
        ]);
    }

    protected function getDefaultValidationArray($request)
    {
        return [
            'type' => 'required|in:0,1',
            'product_id' => 'required|id:Product',
            'quantity' => 'required|numeric',
            'total_value' => 'required|numeric|min:0',
        ];
    }

    protected function changeViewData($data)
    {
        return array_merge($data, [
            'typeInput' => ProductMovement::TYPE_INPUT,
            'typeOutput' => ProductMovement::TYPE_OUTPUT,
            'products' => Product::all()->pluck('name', 'id')->prepend('---', '0'),
        ]);
    }

}
