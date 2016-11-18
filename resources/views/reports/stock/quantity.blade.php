<table class="table table-bordered table-condensed">
    <tr>
        <th class="text-center">Name</th>
        <th width="200px" class="text-center">Quantity</th>
    </tr>
@foreach ($records as $record)
    <tr>
        <td>{{ $record->name }}</td>
        <td class="text-right">{{ $record->quantity }}</td>
    </tr>
@endforeach
</table>
