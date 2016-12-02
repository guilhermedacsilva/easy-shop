<?php

namespace EasyShop\Http\Controllers;

use Illuminate\Http\Request;
use EasyShop\Traits\CrudActions;
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
        $records = Trade::with('person', 'movements.product')
                        ->where('type', '=', Trade::TYPE_PURCHASE)
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return $this->createListView([
            'request' => $request,
            'records' => $records,
        ]);
    }
}
