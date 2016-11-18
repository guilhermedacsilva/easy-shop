<?php

namespace EasyShop\Http\Controllers\Report\Stock;

use EasyShop\Http\Controllers\Controller;
use Illuminate\Http\Request;
use EasyShop\Model\Product;

class QuantityController extends Controller
{
    public function index()
    {
        $records = Product::orderBy('name')->get();
        $params = [
            'topButtonRoute' => 'reports.stock',
            'topButtonText' => 'Back',
            'includeView' => 'reports.stock.quantity',
            'title' => 'Reports / Stock / Quantity of Products',
            'records' => $records,
        ];
        return view('layouts.simple_page')->with($params);
    }
}
