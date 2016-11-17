<div class="row">

    @if (isset($record))
    {!! Form::model($record, ['method' => 'PATCH','route' => [$routePrefix.'.update', $record->id]]) !!}
    @else
    {!! Form::open(array('route' => $routePrefix.'.store','method'=>'POST')) !!}
    @endif

    <div class="col-xs-12">
        <div class="form-group">
            <strong>Type:</strong>
            <label class="checkbox-inline">
                {!! Form::radio('type', \EasyShop\Model\ProductsMovement::TYPE_INPUT, null, ['required'=>'']) !!} Input
            </label>
            <label class="checkbox-inline">
                {!! Form::radio('type', \EasyShop\Model\ProductsMovement::TYPE_OUTPUT, null, ['required'=>'']) !!} Output
            </label>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
            <strong>Product:</strong>
            {!! Form::select('product_id', $products, null, ['class' => 'form-control','required' => '']) !!}
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
            <strong>Quantity:</strong>
            {!! Form::text('quantity', null, ['placeholder' => 'Quantity','class' => 'form-control','required' => '']) !!}
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
            <strong>Total value:</strong>
            {!! Form::text('total_value', null, ['placeholder' => 'Total value','class' => 'form-control','required' => '']) !!}
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
