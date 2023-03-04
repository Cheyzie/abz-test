<div style="display: flex">
    <a class="btn" data-id="{{$data->id}}" href="{{route('admin.employees.edit', ['employee' => $data->id])}}">
        <i class="material-symbols-outlined">edit</i>
    </a>
    <a class="btn employee-delete" data-id="{{$data->id}}" data-name="{{$data->full_name}}" onclick="deleteHandle(this)" href="#">
        <i class='material-symbols-outlined '>delete</i>
    </a>
</div>
