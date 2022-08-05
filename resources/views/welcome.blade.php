<table border="1">
@foreach ($projects as $item)
<tr>
    <td>
        {{$item->project_id}}
        {{$item->name}}
    </td>
</tr>
@endforeach
</table>