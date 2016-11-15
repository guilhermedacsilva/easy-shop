@if (isset($record))
{!! Form::model($record, ['method' => 'PATCH','route' => [$routePrefix.'.update', $record->id]]) !!}
@else
{!! Form::open(array('route' => $routePrefix.'.store','method'=>'POST')) !!}
@endif
<div class="row">

    <div class="col-xs-12">
        <div class="form-group">
            <strong>Type:</strong>
            <div class="checkbox">
                <label>
                    {!! Form::radio('type', 0, null, ['required'=>'']) !!} Administrator
                </label>
            </div>
            <div class="checkbox">
                <label>
                    {!! Form::radio('type', 1, true, ['required'=>'']) !!} Gym client
                </label>
            </div>
        </div>
    </div>

        <div class="col-xs-12">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, ['placeholder' => 'Name','class' => 'form-control','required' => '', 'autofocus' => '']) !!}
            </div>
        </div>

    <div class="col-xs-12">
        <div class="form-group">
            <strong>E-mail:</strong>
            {!! Form::text('email', null, ['placeholder' => 'E-mail','class' => 'form-control','required' => '']) !!}
        </div>
    </div>

    @if (!isset($record))
    <div class="col-xs-12">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', ['placeholder' => 'Password','class' => 'form-control','required' => '']) !!}
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
            <strong>Password confirmation:</strong>
            {!! Form::password('password_confirmation', ['placeholder' => 'Password confirmation','class' => 'form-control','required' => '']) !!}
        </div>
    </div>
    @endif

    <div class="col-xs-12">
        <div class="form-group">
            <strong>Note:</strong>
            {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-xs-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</div>
{!! Form::close() !!}
