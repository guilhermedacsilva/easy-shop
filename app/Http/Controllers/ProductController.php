<?php

namespace EasyShop\Http\Controllers;

use Illuminate\Http\Request;
use EasyShop\Http\Traits\CrudTrait;
use EasyShop\Model\Product;
use Auth;

class ProductController extends Controller
{
    use CrudTrait;

    public function __construct() {
        $this->crudModelName = 'Product';
    }

    protected function getDefaultValidationArray($request)
    {
        return [
            'name' => 'required|between:1,255',
            'quantity' => 'required|numeric',
        ];
    }

    protected function createStoreData($data)
    {
        return array_merge($data, [
            'created_by' => Auth::user()->id,
        ]);
    }

    protected function createUpdateData($data, $record)
    {
        return array_merge($data, [
            'updated_by' => Auth::user()->id,
        ]);
    }

}
