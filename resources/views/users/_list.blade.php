<table class="table table-bordered">
    <tr>
        <th width="130px"></th>
        <th>Name</th>
        <th>E-mail</th>
    </tr>
@foreach ($records as $key => $record)
    <tr>
        <td>
            @include('partials.crud.button_show')
            @include('partials.crud.button_edit')
            @include('partials.crud.button_custom', ['route'=>route('users.password.edit',$record->id), 'attrTitle'=>'Password','icon'=>'cog'])
            @include('partials.crud.button_delete')
        </td>
        <td>{{ $record->name }}</td>
        <td>{{ $record->email }}</td>
    </tr>
@endforeach
</table>
