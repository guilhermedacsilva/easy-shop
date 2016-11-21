<?php

namespace EasyShop\Http\Controllers;

use Illuminate\Http\Request;
use EasyShop\Http\Traits\CrudActions;
use EasyShop\Model\ProductsMovement;
use EasyShop\Model\Product;
use Auth;

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

    protected function getDefaultValidationArray($request)
    {
        return [
            'type' => 'required|in:0,1',
            'product_id' => 'required|id:Product',
            'quantity' => 'required|numeric',
            'total_value' => 'required|numeric|min:0',
        ];
    }

    protected function createStoreData($request, $fields)
    {
        return array_merge($request->only($fields), [
            'created_by' => Auth::user()->id,
        ]);
    }

    protected function afterStore($request, $record)
    {
        $product = Product::find($request->input('product_id'));
        $product->addMovement($record);
        $product->save();
    }

    protected function createUpdateData($request, $fields, $record)
    {
        return array_merge($request->only($fields), [
            'updated_by' => Auth::user()->id,
        ]);
    }

    protected function beforeUpdate($request, $oldMovement, $data)
    {
        $product = $oldMovement->product;
        $product->subMovement($oldMovement);
        $product->save();
    }

    protected function afterUpdate($request, $newMovement)
    {
        $product = $newMovement->product;
        $product->addMovement($newMovement);
        $product->save();
    }

    protected function beforeDestroy($id)
    {
        $movement = ProductsMovement::find($id);
        $product = $movement->product;
        $product->subMovement($movement);
        $product->save();
    }

    protected function changeViewData($data)
    {
        return array_merge($data, [
            'typeInput' => ProductsMovement::TYPE_INPUT,
            'typeOutput' => ProductsMovement::TYPE_OUTPUT,
            'products' => Product::all()->pluck('name', 'id'),
        ]);
    }

}
