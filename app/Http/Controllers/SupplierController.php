<?php

namespace EasyShop\Http\Controllers;

use Illuminate\Http\Request;
use EasyShop\Traits\CrudActions;
use EasyShop\Model\Person;

class SupplierController extends Controller
{
    use CrudActions;

    public function __construct()
    {
        $this->initCrud([
            'model' => 'Person',
            'routePrefix' => 'suppliers',
            'titleCreate' => 'Supplier',
        ]);
    }

    public function index(Request $request)
    {
        $records = Person::supplier()->index();

        return $this->createListView([
            'request' => $request,
            'records' => $records,
        ]);
    }

    protected function beforeStore($request, $data)
    {
        $data['type'] = Person::TYPE_SUPPLIER;
        return $data;
    }
}
