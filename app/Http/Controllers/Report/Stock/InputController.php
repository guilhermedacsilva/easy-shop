<?php

namespace EasyShop\Http\Controllers\Report\Stock;

use EasyShop\Http\Controllers\Controller;
use Illuminate\Http\Request;
use EasyShop\Model\Product;
use DB;

class InputController extends Controller
{
    public function index()
    {
        $query = <<<'EOD'
    select name, sum(m.quantity) as quantity
    from products p
    join products_movements m on (m.product_id = p.id)
    where m.type = 0
    group by p.id, p.name
EOD;
        $records = DB::select($query);
        $params = [
            'topButtonRoute' => 'reports.stock',
            'topButtonText' => 'Back',
            'includeView' => 'reports.stock.input',
            'title' => 'Reports / Stock / Input of Products',
            'records' => $records,
        ];
        return view('layouts.simple_page')->with($params);
    }
}
