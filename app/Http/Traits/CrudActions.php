<?php

namespace EasyShop\Http\Traits;

use App;
use Illuminate\Http\Request;

trait CrudActions {

    /* CAN BE EDITED
    Used: config('app.name') . "\\{$modelPath}{$model}"
    */
    private $modelPath = 'Model\\';

    /* KEYS
    required: model
    optionals (calculated): fullClassName (model), routePrefix, viewFolder,
        titleIndex, titleCreate
        indexOrderBy, indexOrderByAsc, indexPaginate
    */
    private $params;

    /* array('model' => '...') or 'model...' */
    protected function initCrud($params) {
        if (is_string($params)) $params = ['model'=>$params];
        elseif (!isset($params['model'])) throw new Exception("CrudActions: Invalid model", 1);

        $model = $params['model'];
        $params = array_add($params, 'routePrefix', str_plural(strtolower($model)));
        $params = array_add($params, 'viewFolder', $params['routePrefix']);
        $params = array_add($params, 'titleCreate', $model);
        $params = array_add($params, 'titleIndex', str_plural($params['titleCreate']));
        $params = array_add($params, 'fullClassName', config('app.name') . "\\{$this->modelPath}{$model}");
        $params = array_add($params, 'indexOrderBy', 'name');
        $params = array_add($params, 'indexOrderByAsc', 'asc');
        $params = array_add($params, 'indexPaginate', 10);
        $this->params = $params;
    }

    public function index(Request $request)
    {
        $records = $this->params['fullClassName']
                                ::orderBy($this->params['indexOrderBy'], $this->params['indexOrderByAsc'])
                                ->paginate($this->params['indexPaginate']);
        return $this->createListView([
            'request' => $request,
            'records' => $records,
        ]);
    }

    public function create()
    {
        return $this->createFormView();
    }

    public function store(Request $request)
    {
        $validationArray = $this->getStoreValidationArray($request);
        $this->validate($request, $validationArray);

        $fields = array_keys($validationArray);
        $data = $this->createStoreData($request, $fields);

        $this->beforeStore($request, $data);
        $newRecord = ($this->params['fullClassName'])::create($data);
        $this->afterStore($request, $newRecord);

        return redirect()->route($this->getCrudRoute('index'))
                        ->with('success', $this->params['model'].' created successfully');
    }

    public function edit($id)
    {
        return $this->createFormView([
            'action' => 'edit',
            'record' => $this->findById($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $record = $this->findById($id);
        $validationArray = $this->getUpdateValidationArray($request, $record);
        $this->validate($request, $validationArray);

        $fields = array_keys($validationArray);
        $data = $this->createUpdateData($request, $fields, $record);

        $this->beforeUpdate($request, $record, $data);
        $record->update($data);
        $this->afterStore($request, $record);

        return redirect()->route($this->getCrudRoute('index'))
                        ->with('success', $this->params['model'].' updated successfully');
    }

    public function show($id)
    {
        return $this->createShowView([
            'record' => $this->findById($id),
        ]);
    }

    public function destroy($id)
    {
        $this->beforeDestroy($id);
        ($this->params['fullClassName'])::destroy($id);
        $this->afterDestroy($id);
        return redirect()->route($this->getCrudRoute('index'))
                        ->with('success',$this->params['model'].' deleted successfully');
    }


    /*
    The array will be passed to $this->validate(...)
    The keys will be passed to $request->only(...)
    */
    protected function getStoreValidationArray($request)
    {
        return $this->getDefaultValidationArray($request);
    }
    protected function getUpdateValidationArray($request, $record)
    {
        return $this->getDefaultValidationArray($request);
    }
    protected function getDefaultValidationArray($request)
    {
        return [
            'name' => 'required|between:1,255',
        ];
    }

    protected function createStoreData($request, $fields)
    {
        return $request->only($fields);
    }
    protected function createUpdateData($request, $fields, $record)
    {
        return $request->only($fields);
    }
    protected function beforeStore($request, $data) {}
    protected function afterStore($request, $record) {}

    protected function beforeUpdate($request, $oldRecord, $newData) {}
    protected function afterUpdate($request, $newRecord) {}

    protected function beforeDestroy($id) {}
    protected function afterDestroy($id) {}

    protected function createView($data) {
        return view($data['layout'], $this->createViewData($data));
    }

    protected function createListView($data = []) {
        $data = array_merge([
            'action' => 'index',
            'includeView' => $this->getCrudView('_list'),
        ], $data);
        return view('layouts.simple_page_pagination', $this->createViewData($data));
    }

    protected function createFormView($data = []) {
        $data = array_merge([
            'action' => 'create',
            'includeView' => $this->getCrudView('_form'),
        ], $data);
        return view('layouts.simple_page', $this->createViewData($data));
    }

    protected function createShowView($data = []) {
        $data = array_merge([
            'action' => 'show',
            'includeView' => $this->getCrudView('_show'),
        ], $data);
        return view('layouts.simple_page', $this->createViewData($data));
    }

    /* Available
    action => 'index' or 'create' or 'edit' or 'show'
    */
    protected function createViewData($data = []) {
        $data['action'] = isset($data['action']) ? $data['action'] : 'index';
        $data['routePrefix'] = $this->params['routePrefix'];

        if ($data['action'] == 'index') {
            $data['topButtonRoute'] = $this->getCrudRoute('create');
            $data['topButtonText'] = 'Create New';
            $data['i'] = isset($data['request']) ?
                ($data['request']->input('page', 1) - 1) * $this->params['indexPaginate'] : null;
        } else {
            $data['topButtonRoute'] = $this->getCrudRoute('index');
            $data['topButtonText'] = 'Back';
        }

        if (!isset($data['title'])) {
            if ($data['action'] == 'index') {
                $data['title'] = $this->params['titleIndex'];

            } elseif ($data['action'] == 'create') {
                $data['title'] = 'Create New ' . $this->params['titleCreate'];

            } elseif ($data['action'] == 'edit') {
                $data['title'] = 'Edit ' . $this->params['titleCreate'];

            } else {
                $data['title'] = $this->params['model'];
            }
        }

        return $this->changeViewData($data);
    }

    protected function changeViewData($data)
    {
        return $data;
    }

    protected function getCrudRoute($suffix) {
        return $this->params['routePrefix'] . '.' . $suffix;
    }

    protected function getCrudView($suffix) {
        return $this->params['viewFolder'] . '.' . $suffix;
    }

    protected function findById($id) {
        return ($this->params['fullClassName'])::find($id);
    }

}
