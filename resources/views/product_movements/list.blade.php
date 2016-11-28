<table class="table table-bordered table-condensed table-th-center">
@if ($records->isEmpty())
    <tr>
        <td class="text-center">
            No records found!
        </td>
    </tr>
@else
    <tr>
        <th width="70px"></th>
        <th width="130px">Created at</th>
        <th width="70px">Type</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Total value</th>
    </tr>
    @foreach ($records as $key => $record)
        <tr>
            <td>
                @include('partials.crud.button_edit')
                @include('partials.crud.button_delete')
            </td>
            <td>{{ $record->created_at->format(trans('misc.timestamp_format')) }}</td>
            <td>{{ $record->getType() }}</td>
            <td>{{ $record->product->name }}</td>
            <td class="text-right">{{ $record->quantity }}</td>
            <td class="text-right">{{ $record->total_value }}</td>
        </tr>
    @endforeach
@endif
</table>
