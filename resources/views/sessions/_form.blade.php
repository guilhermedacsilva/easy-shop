<div class="row">

    @if (isset($record))
    {!! Form::model($record, ['method' => 'PATCH','route' => [$routePrefix.'.update', $record->id]]) !!}
    @else
    {!! Form::open(array('route' => $routePrefix.'.store','method'=>'POST')) !!}
    @endif

    <div class="col-xs-6">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, ['placeholder' => 'Name','class' => 'form-control','required' => '', 'autofocus' => '','maxlength' => '255']) !!}
        </div>
    </div>

    <div class="col-xs-6">
        <div class="form-group">
            <strong>Capacity:</strong>
            {!! Form::number('capacity', null, ['placeholder' => 'Capacity','class' => 'form-control','required' => '']) !!}
        </div>
    </div>

    <div class="col-xs-4">
        <div class="form-group">
            <strong>Starting date:</strong>
            {!! Form::date('start_at_date', null, ['class' => 'form-control','required' => '']) !!}
        </div>
    </div>

    <div class="col-xs-4">
        <div class="form-group">
            <strong>Starting time:</strong>
            {!! Form::text('start_at_time', null, ['class' => 'form-control','placeholder' => '18:00','required' => '','maxlength' => '5']) !!}
        </div>
    </div>

    <div class="col-xs-4">
        <div class="form-group">
            <strong>Ending time:</strong>
            {!! Form::text('end_at_time', null, ['class' => 'form-control','placeholder' => '18:30','required' => '','maxlength' => '5']) !!}
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
            <strong>Note:</strong>
            {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-xs-6">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

    {!! Form::close() !!}

    @if (isset($record))
        {!! Form::open(['method' => 'DELETE','route' => [$routePrefix.'.destroy', $record->id],'style'=>'display:inline','confirm'=>'true']) !!}
        <div class="col-xs-6 text-right">
            <button type="submit" class="btn btn-danger">Delete</button>
        </div>
        {!! Form::close() !!}
    @endif

</div>
