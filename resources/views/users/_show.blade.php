<div class="row">

    <div class="col-xs-12">
        <div class="form-group">
            <strong>Type:</strong>
            {{ $record->getTypeString() }}
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $record->name }}
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
            <strong>E-mail:</strong>
            {{ $record->email }}
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
            <strong>Note:</strong>
            {{ $record->note }}
        </div>
    </div>

</div>
