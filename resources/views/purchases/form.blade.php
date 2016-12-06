<div class="row">

    @if (isset($record))
    {!! Form::model($record, ['method' => 'PATCH','route' => [$routePrefix.'.update', $record->id]]) !!}
    @else
    {!! Form::open(array('route' => $routePrefix.'.store','method'=>'POST')) !!}
    @endif

    <div class="col-xs-12">
        <div class="form-group">
            <strong>Customer:</strong>
            {!! Form::select('person_id', $suppliers, null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-xs-6">
        <button type="submit" class="btn btn-primary">Open purchase</button>
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
