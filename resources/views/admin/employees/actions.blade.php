<div style="display: flex">
    <a class="btn" data-value="{{$data->id}}" href="{{route('admin.employees.edit', ['employee' => $data->id])}}">
        <i class="material-symbols-outlined">edit</i>
    </a>
    <a class="btn employee-delete" data-value="{{$data->id}}" href="#">
        <i class='material-symbols-outlined '>delete</i>
    </a>
</div>
