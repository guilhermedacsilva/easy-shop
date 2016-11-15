<div class="row">

    <div class="col-xs-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $record->name }}
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
            <strong>Quantity:</strong>
            {{ $record->quantity }}
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
            <strong>Created by:</strong>
            {{ $record->created_by_user->name }}
            <strong> at: </strong>
            {{ $record->created_at->format(trans('misc.timestamp_format')) }}
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
            <strong>Updated by:</strong>
            {{ $record->updated_by_user->name }}
            <strong> at: </strong>
            {{ $record->updated_at->format(trans('misc.timestamp_format')) }}
        </div>
    </div>

</div>
