<div class="row">

    {!! Form::open(array('route' => $routePrefix.'.store','method'=>'POST')) !!}

    <div class="col-xs-12">
        <div class="form-group">
            <strong>Supplier:</strong>
            {!! Form::select('supplier', $suppliers, null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-xs-6">
        <button type="submit" class="btn btn-primary">Open purchase</button>
    </div>

    {!! Form::close() !!}

</div>
