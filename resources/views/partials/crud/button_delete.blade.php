{!! Form::open(['method' => 'DELETE','route' => [$routePrefix.'.destroy', $record->id],'style'=>'display:inline','confirm'=>'true']) !!}
    <button type="submit" class="btn btn-danger btn-xs" title="Delete">
        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
    </button>
{!! Form::close() !!}
