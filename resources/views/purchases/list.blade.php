<table class="table table-bordered table-condensed table-th-center">
@if ($records->isEmpty())
    <tr>
        <td class="text-center">
            No records found!
        </td>
    </tr>
@else
    <tr>
        <th width="100px"></th>
        <th width="135px">Created at</th>
        <th>Supplier</th>
        <th width="135px">Total Value</th>
        <th width="135px">Discount</th>
        <th width="135px">Final Value</th>
        <th>Products</th>
    </tr>
    @foreach ($records as $key => $record)
        <tr>
            <td>
                @include('partials.crud.button_show')
                @include('partials.crud.button_edit')
                @include('partials.crud.button_delete')
            </td>
            <td>{{ $record->created_at->format(trans('misc.timestamp_format')) }}</td>
            <td>{{ $record->person ? $record->person->name : '' }}</td>
            <td class="text-right">{{ $record->total_value }}</td>
            <td class="text-right">{{ $record->discount }}</td>
            <td class="text-right">{{ $record->final_value }}</td>
            <td>{{ $record->productsNames() }}</td>
        </tr>
    @endforeach
@endif
</table>
