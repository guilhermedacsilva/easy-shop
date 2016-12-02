<?php

namespace EasyShop\Http\Controllers;

use Illuminate\Http\Request;
use EasyShop\Traits\CrudActions;
use EasyShop\Model\Product;
use EasyShop\Model\ProductMovement;
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

    protected function beforeDestroyRedirect($id)
    {
        $product = Product::find($id);
        $movements = $product->movements()->get();

        if ($movements->isEmpty()) {
            return false;
        }
        return redirect()->route('products.index')
                        ->with('danger', trans('validation.delete_referenced'));
    }
}
