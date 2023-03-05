<div style="display: flex">
    <a class="btn" data-id="{{$data->id}}" href="{{route('admin.position.edit', ['position' => $data->id])}}">
        <i class="material-symbols-outlined">edit</i>
    </a>
    <button class="btn employee-delete" data-id="{{$data->id}}" data-name="{{$data->name}}" onclick="deletePositionHandle(this)">
        <i class='material-symbols-outlined '>delete</i>
    </button>
</div>
