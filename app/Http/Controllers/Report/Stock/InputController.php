<?php

namespace EasyShop\Http\Controllers\Report\Stock;

use EasyShop\Http\Controllers\Controller;
use Illuminate\Http\Request;
use EasyShop\Model\Product;
use DB;
use Carbon\Carbon;

class InputController extends Controller
{
    public function index()
    {
        return $this->generateReport([
            'start_at' => '2000-01-01',
            'end_at' => Carbon::now()->addYear()->toDateString(),
        ]);
    }

    public function filter(Request $request)
    {
        $this->validate($request, [
            'start_at' => 'date',
            'end_at' => 'date',
        ]);

        return $this->generateReport([
            'start_at' => $request->input('start_at'),
            'end_at' => $request->input('end_at'),
        ]);
    }

    /* $queryParams = collection */
    protected function generateReport($queryParams)
    {
        $query = <<<'EOD'
    select name, sum(m.quantity) as quantity, sum(m.total_value) as total_value
    from products p
    join products_movements m on (m.product_id = p.id)
    where m.type = 0 and m.created_at between ? and ?
    group by p.id, p.name
EOD;
        $records = DB::select($query, array_values($queryParams));
        $params = [
            'topButtonRoute' => 'reports.stock',
            'topButtonText' => 'Back',
            'includeView' => 'reports.stock.input',
            'title' => 'Reports / Stock / Input of Products',
            'records' => $records,
            'filter' => $queryParams,
        ];
        return view('layouts.simple_page')->with($params);
    }
}
