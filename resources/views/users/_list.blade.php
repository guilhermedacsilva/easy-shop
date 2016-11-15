<table class="table table-bordered">
    <tr>
        <th width="160px"></th>
        <th width="130px">Type</th>
        <th>Name</th>
        <th>E-mail</th>
    </tr>
@foreach ($records as $key => $record)
    <tr class="{{ $record->disabled_at ? 'danger' : '' }}">
        <td>
            @include('partials.crud.button_show')
            @include('partials.crud.button_edit')
            @include('partials.crud.button_custom', ['route'=>route('users.password.edit',$record->id), 'attrTitle'=>'Password','icon'=>'cog'])
            @include('partials.crud.button_patch', ['routeSuffix'=>'disable', 'attrTitle'=>'Enable/Disable', 'icon'=>'eye-open'])
            @include('partials.crud.button_delete')
        </td>
        <td>{{ $record->getTypeString() }}</td>
        <td>{{ $record->name }}</td>
        <td>{{ $record->email }}</td>
    </tr>
@endforeach
</table>
