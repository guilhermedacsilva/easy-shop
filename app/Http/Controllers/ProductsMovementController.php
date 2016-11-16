<?php

namespace EasyShop\Http\Controllers;

use Illuminate\Http\Request;
use EasyShop\Http\Traits\CrudTrait;
use EasyShop\Model\ProductsMovement;

class ProductsMovementController extends Controller
{
    use CrudTrait;

    public function __construct() {
        $this->crudModelName = 'ProductsMovement';
        $this->crudRoutePrefix = 'movements';
        $this->crudViewFolder = 'products_movements';
        $this->crudTitle = 'Products Movements';
        $this->crudIndexOrderBy = 'created_at';
        $this->crudIndexOrderByAsc = 'desc';
    }

}
