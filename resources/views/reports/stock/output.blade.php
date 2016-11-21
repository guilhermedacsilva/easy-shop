{!! Form::open(['route'=>'reports.stock.output', 'method'=>'POST', 'class'=>'form-inline pull-left margin-bottom']) !!}

<div class="form-group">
    <label for="start_at">{{ ucfirst(trans('common.start_at')) }}</label>
    {!! Form::date('start_at', $filter['start_at'], ['class'=>'form-control', 'autofocus'=>'']) !!}
</div>

<div class="form-group">
    <label for="end_at">{{ ucfirst(trans('common.end_at')) }}</label>
    {!! Form::date('end_at', $filter['end_at'], ['class'=>'form-control']) !!}
</div>

<button type="submit" class="btn btn-default margin-left hidden-print" title="Filter">
    <span class="glyphicon glyphicon-filter" aria-hidden="true"></span>
</button>

{!! Form::close() !!}

<a href="{{ route('reports.stock.output') }}" class="btn btn-default margin-left hidden-print" title="Reset">
    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
</a>

<table class="table table-bordered table-condensed">
    <tr>
        <th class="text-center">Name</th>
        <th width="200px" class="text-center">Output Quantity</th>
        <th width="200px" class="text-center">Total Value</th>
    </tr>
@foreach ($records as $record)
    <tr>
        <td>{{ $record->name }}</td>
        <td class="text-right">{{ $record->quantity }}</td>
        <td class="text-right">@lang('misc.currency') {{ $record->total_value }}</td>
    </tr>
@endforeach
</table>
