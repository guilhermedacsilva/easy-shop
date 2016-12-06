<?php

namespace EasyShop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use EasyShop\Traits\CrudActions;
use EasyShop\Model\Trade;
use EasyShop\Model\Person;
use EasyShop\Helper\ViewFormHelper;
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
                            ->get();

        return array_merge($data, [
            'suppliers' => ViewFormHelper::createSelectList($suppliers),
        ]);
    }

    protected function getStoreValidationArray($request)
    {
        return [
            'supplier' => 'exists:people,id'
        ];
    }

    protected function createStoreData($request, $fields)
    {
        $supplier = $request->input('supplier') ? $request->input('supplier') : null;
        $data = [
            'type' => Trade::TYPE_PURCHASE,
            'person_id' => $supplier,
        ];
        return $data;
    }
}
