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

    public function create()
    {
        return $this->createFormView([
            'includeView' => $this->getCrudView('form_create'),
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'supplier' => 'exists:people,id',
        ]);

        $supplier = $request->input('supplier') ? $request->input('supplier') : null;
        $record = Trade::create([
            'type' => Trade::TYPE_PURCHASE,
            'person_id' => $supplier,
        ]);

        return redirect()->route('purchases.edit', ['id' => $record->id]);
    }

    public function edit($id)
    {
        $record = $this->findById($id);

        return $this->createFormView([
            'action' => 'edit',
            'record' => $record,
        ]);
    }
}
