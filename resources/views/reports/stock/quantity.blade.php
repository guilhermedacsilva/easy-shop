<table class="table table-bordered table-condensed table-th-center">
    <tr>
        <th>Name</th>
        <th width="200px">Quantity</th>
    </tr>
@foreach ($records as $record)
    <tr>
        <td>{{ $record->name }}</td>
        <td class="text-right">{{ $record->quantity }}</td>
    </tr>
@endforeach
</table>
