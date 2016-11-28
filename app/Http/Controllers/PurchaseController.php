<?php

namespace EasyShop\Http\Controllers;

use Illuminate\Http\Request;
use EasyShop\Http\Traits\CrudActions;
use EasyShop\Model\Trade;
use Auth;

class PurchaseController extends Controller
{
    use CrudActions;

    public function __construct()
    {
        $this->initCrud([
            'model' => 'Trade',
            'routePrefix' => 'purchases',
            'titleCreate' => 'Purchase',
        ]);
    }

    public function index(Request $request)
    {
        $records = Trade::with('customer')
                        ->orderBy('created_at','desc')
                        ->paginate(10);

        return $this->createListView([
            'request' => $request,
            'records' => $records,
        ]);
    }
/*
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
*/
}
