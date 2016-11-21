<?php

namespace EasyShop\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function stock()
    {
        $params = [
            'includeView' => 'reports.stock.index',
            'notIncludeTopButton' => true,
            'title' => 'Reports / Stock',
        ];
        return view('layouts.simple_page')->with($params);
    }
}
