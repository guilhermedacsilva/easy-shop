<table class="table table-bordered">
@if ($records->isEmpty())
    <tr>
        <td class="text-center">
            No records found!
        </td>
    </tr>
@else
    <tr>
        <th width="70px"></th>
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
            <td>{{ $record->product->name }}</td>
            <td>{{ $record->quantity }}</td>
            <td>{{ $record->total_value }}</td>
        </tr>
    @endforeach
@endif
</table>
