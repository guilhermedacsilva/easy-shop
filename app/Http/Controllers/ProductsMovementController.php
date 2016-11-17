<?php

namespace EasyShop\Http\Controllers;

use Illuminate\Http\Request;
use EasyShop\Http\Traits\CrudActions;
use EasyShop\Model\ProductsMovement;

class ProductsMovementController extends Controller
{
    use CrudActions;

    public function __construct() {
        $this->initCrud([
            'model' => 'ProductsMovement',
            'routePrefix' => 'movements',
            'viewFolder' => 'products_movements',
            'titleCreate' => 'Movement',
            'indexOrderBy' => 'created_at',
            'indexOrderByAsc' => 'desc',
        ]);
    }

}
