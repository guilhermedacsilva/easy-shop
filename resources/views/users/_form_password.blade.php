{!! Form::model($record, ['method' => 'PATCH','route' => ['users.password.update', $record->id]]) !!}
<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $record->name }}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>E-mail:</strong>
            {{ $record->email }}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', ['placeholder' => 'Password','class' => 'form-control','required' => '','autofocus'=>'']) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Password confirmation:</strong>
            {!! Form::password('password_confirmation', ['placeholder' => 'Password confirmation','class' => 'form-control','required' => '']) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</div>
{!! Form::close() !!}
