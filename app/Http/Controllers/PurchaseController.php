<?php

namespace EasyShop\Http\Controllers;

use Illuminate\Http\Request;
use EasyShop\Traits\CrudActions;
use EasyShop\Model\Trade;
use EasyShop\Model\Person;
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
        $records = Trade::purchasesIndex();

        return $this->createListView([
            'request' => $request,
            'records' => $records,
        ]);
    }

    protected function changeViewData($data)
    {
        $suppliers = Person::supplier()
                            ->orderBy('name')
                            ->get()
                            ->pluck('name', 'id')
                            ->prepend('---', 0);


        return array_merge($data, [
            'suppliers' => $suppliers,
        ]);
    }

    protected function createStoreData($request, $fields)
    {
        $data = [
            'type' => Trade::TYPE_PURCHASE,

        ];
    }
}
