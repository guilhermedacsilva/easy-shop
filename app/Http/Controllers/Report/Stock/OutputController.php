<?php

namespace EasyShop\Http\Controllers\Report\Stock;

use EasyShop\Http\Controllers\Controller;
use Illuminate\Http\Request;
use EasyShop\Model\Product;
use DB;
use Carbon\Carbon;
use EasyShop\Helper\MyDB;

class OutputController extends Controller
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

    protected function generateReport($queryParams)
    {
        $query = <<<'EOD'
    select name, sum(m.quantity) as quantity, sum(m.total_value) as total_value
    from products p
    join products_movements m on (m.product_id = p.id)
    where m.type = 1 and m.created_at between ? and ?
    group by p.id, p.name
    order by p.name
EOD;
        $records = DB::select($query, MyDB::filterDateToQueryParams($queryParams));
        $params = [
            'topButtonRoute' => 'reports.stock',
            'topButtonText' => 'Back',
            'includeView' => 'reports.stock.output',
            'title' => 'Reports / Stock / Output of Products',
            'records' => $records,
            'filter' => $queryParams,
        ];
        return view('layouts.simple_page')->with($params);
    }
}
