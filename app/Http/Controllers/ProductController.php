<?php

namespace EasyShop\Http\Controllers;

use Illuminate\Http\Request;
use EasyShop\Http\Traits\CrudActions;
use EasyShop\Model\Product;
use Auth;

class ProductController extends Controller
{
    use CrudActions;

    public function __construct() {
        $this->initCrud('Product');
    }

    protected function getDefaultValidationArray($request)
    {
        return [
            'name' => 'required|between:1,255',
            'quantity' => 'required|numeric',
        ];
    }

    protected function createStoreData($request, $fields)
    {
        return array_merge($request->only($fields), [
            'created_by' => Auth::user()->id,
        ]);
    }

    protected function createUpdateData($request, $fields, $record)
    {
        return array_merge($request->only($fields), [
            'updated_by' => Auth::user()->id,
        ]);
    }

}
