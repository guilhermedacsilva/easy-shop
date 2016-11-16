<div class="row">

    @if (isset($record))
    {!! Form::model($record, ['method' => 'PATCH','route' => [$routePrefix.'.update', $record->id]]) !!}
    @else
    {!! Form::open(array('route' => $routePrefix.'.store','method'=>'POST')) !!}
    @endif

    <div class="col-xs-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, ['placeholder' => 'Name','class' => 'form-control','required' => '', 'autofocus' => '','maxlength' => '255']) !!}
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
