<?php

namespace Gym\Http\Controllers;

use Illuminate\Http\Request;
use Gym\Model\Session;
use Gym\Http\Traits\CrudTrait;
use Gym\Helper\MyDate;
use Gym\Helper\Timetable;

class SessionController extends Controller
{
    use CrudTrait;

    public function __construct() {
        $this->crudModelName = 'Session';
    }

    public function index(Request $request)
    {
        $records = Session::whereBetween('start_at_date', [
            MyDate::monday()->toDateString(), MyDate::sunday()->toDateString()
        ])->orderBy('start_at_time','desc')->get();

        $timetable = new Timetable();
        $timetable->createColumns($records);

        return $this->createView([
            'layout' => 'layouts.simple_page',
            'includeView' => $this->getCrudRoute('_list'),
            'ttDays' => $timetable->days,
            'ttHeaders' => $timetable->headers,
            'ttHours' => $timetable->hours,
            'ttColumnHeight' => $timetable->columnHeight,
            'title' => 'Schedule',
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|between:2,255',
            'capacity' => 'required|integer|min:1',
            'start_at_date' => 'required|date',
            'start_at_time' => 'required|time',
            'end_at_time' => 'required|time',
        ]);

        Session::create($request->only('name','capacity','start_at_date','start_at_time','end_at_time','note'));

        return redirect()->route('sessions.index')
                        ->with('success','Session created successfully');
    }

    public function edit($id)
    {
        $record = $this->findById($id);
        $record['start_at_time'] = substr($record['start_at_time'], 0, -3);
        $record['end_at_time'] = substr($record['end_at_time'], 0, -3);
        return $this->createFormView([
            'action' => 'edit',
            'record' => $record,
        ]);
    }

    public function show($id)
    {
        return redirect()->route('sessions.edit', ['id'=>$id]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|between:2,255',
            'capacity' => 'required|integer|min:1',
            'start_at_date' => 'required|date',
            'start_at_time' => 'required|time',
            'end_at_time' => 'required|time',
        ]);

        $record = Session::find($id);
        $record->update($request->only('name','capacity','start_at_date','start_at_time','end_at_time','note'));

        return redirect()->route('sessions.index')
                        ->with('success','Session updated successfully');
    }

}
