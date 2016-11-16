<table class="table table-bordered">
@if ($records->isEmpty())
    <tr>
        <td class="text-center">
            No records found!
        </td>
    </tr>
@else
    <tr>
        <th width="100px"></th>
        <th>Name</th>
    </tr>
    @foreach ($records as $key => $record)
        <tr>
            <td>
                @include('partials.crud.button_show')
                @include('partials.crud.button_edit')
                @include('partials.crud.button_delete')
            </td>
            <td>{{ $record->name }}</td>
        </tr>
    @endforeach
@endif
</table>
