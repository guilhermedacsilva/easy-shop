<?php

namespace Gym\Http\Traits;

use App;
use Illuminate\Http\Request;

trait CrudTrait {

    protected $crudModelName;
    protected $crudRoutePrefix;
    protected $crudTitle;
    protected $crudFullClassName;
    protected $crudIndexOrderBy = 'name';
    protected $crudIndexPaginate = 10;

    public function index(Request $request)
    {
        $records = $this->getCrudFullClassName()
                                ::orderBy($this->crudIndexOrderBy)
                                ->paginate($this->crudIndexPaginate);
        return $this->createListView([
            'request' => $request,
            'records' => $records,
        ]);
    }

    public function create()
    {
        return $this->createFormView();
    }

    public function edit($id)
    {
        return $this->createFormView([
            'action' => 'edit',
            'record' => $this->findById($id),
        ]);
    }

    public function show($id)
    {
        return $this->createShowView([
            'record' => $this->findById($id),
        ]);
    }

    public function destroy($id)
    {
        $this->getCrudFullClassName()::destroy($id);
        return redirect()->route($this->getCrudRoute('index'))
                        ->with('success',$this->crudModelName.' deleted successfully');
    }

    protected function createView($data) {
        return view($data['layout'], $this->createViewData($data));
    }

    protected function createListView($data = []) {
        $data = array_merge([
            'action' => 'index',
            'includeView' => $this->getCrudRoute('_list'),
        ], $data);
        return view('layouts.simple_page_pagination', $this->createViewData($data));
    }

    protected function createFormView($data = []) {
        $data = array_merge([
            'action' => 'create',
            'includeView' => $this->getCrudRoute('_form'),
        ], $data);
        return view('layouts.simple_page', $this->createViewData($data));
    }

    protected function createShowView($data = []) {
        $data = array_merge([
            'action' => 'show',
            'includeView' => $this->getCrudRoute('_show'),
        ], $data);
        return view('layouts.simple_page', $this->createViewData($data));
    }

    /* Available
    action => 'index' or 'create' or 'edit' or 'show'
    */
    protected function createViewData($data = []) {
        $data['action'] = isset($data['action']) ? $data['action'] : 'index';
        $data['routePrefix'] = $this->getCrudRoutePrefix();

        if ($data['action'] == 'index') {
            $data['topButtonRoute'] = $this->getCrudRoute('create');
            $data['topButtonText'] = 'Create New';
            $data['i'] = isset($data['request']) ?
                ($data['request']->input('page', 1) - 1) * $this->crudIndexPaginate : null;
        } else {
            $data['topButtonRoute'] = $this->getCrudRoute('index');
            $data['topButtonText'] = 'Back';
        }

        if (!isset($data['title'])) {
            if ($data['action'] == 'index') {
                $data['title'] = $this->getCrudTitle();

            } elseif ($data['action'] == 'create') {
                $data['title'] = 'Create New ' . $this->crudModelName;

            } elseif ($data['action'] == 'edit') {
                $data['title'] = 'Edit ' . $this->crudModelName;

            } else {
                $data['title'] = $this->crudModelName;
            }
        }

        return $data;
    }

    protected function getCrudTitle()
    {
        if (!$this->crudTitle)
        {
            $this->crudTitle = str_plural($this->crudModelName);
        }
        return $this->crudTitle;
    }

    protected function getCrudRoutePrefix()
    {
        if (!$this->crudRoutePrefix)
        {
            $this->crudRoutePrefix = str_plural(strtolower($this->crudModelName));
        }
        return $this->crudRoutePrefix;
    }

    protected function findById($id) {
        return $this->getCrudFullClassName()::find($id);
    }

    protected function getCrudFullClassName()
    {
        if (!$this->crudFullClassName)
        {
            $this->crudFullClassName = config('app.name').'\\Model\\'.$this->crudModelName;
        }
        return $this->crudFullClassName;
    }

    protected function getCrudRoute($suffix) {
        return $this->getCrudRoutePrefix() . '.' . $suffix;
    }

}
