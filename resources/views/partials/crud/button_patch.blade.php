{!! Form::open(['method' => 'PATCH','route' => [$routePrefix.'.'.$routeSuffix, $record->id],'style'=>'display:inline']) !!}
    <button type="submit" class="btn {{ isset($btnClass) ? $btnClass : 'btn-primary' }} btn-xs" title="{{ $attrTitle }}">
        <span class="glyphicon glyphicon-{{ $icon }}" aria-hidden="true"></span>
    </button>
{!! Form::close() !!}
