@extends('adminlte::page')

@section('title', 'Positions')

@section('content_header')
    <h1>Positions</h1>
@stop

@section('content')
    <form class="create-form" enctype="multipart/form-data" action="{{url('admin/positions', ['position' => $position->id])}}" method="POST">
        @csrf
        @method('PATCH')
        <h3>Edit position</h3>
        <div class="form-group">
            <label for="formGroupExampleInput">Name</label>
            <input type="text" class="form-control" id="name" name="name" maxlength="256"value="{{ old('name') ?? $position->name }}">
            @error('name')
            <div class="alert alert-danger"> {{$message}} </div>
            @enderror
            <small id="nameDescription" class="form-text text-muted justify-content-end text-right">
                {{strlen(old('name') ?? $position->name)}}/256
            </small>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6">
                <b>Created at:</b> {{$position->created_at->format('d.m.Y')}}
            </div>
            <div class="col-sm-6">
                <b>Admin created ID:</b> {{$position->admin_created_id}}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6">
                <b>Updated at:</b> {{$position->updated_at->format('d.m.Y')}}
            </div>
            <div class="col-sm-6">
                <b>Admin updated ID:</b> {{$position->admin_updated_id}}
            </div>
        </div>
        <div class="d-flex flex-row-reverse p-2">
            <input type="submit" class="btn btn-secondary ml-2" value="Save">
            <a class="btn btn-outline-secondary " href="{{ url('admin/positions') }}">Cancel</a>
        </div>
    </form>

@stop

@section('css')
    <style>
        .create-form {
            border: 1px solid gray;
            padding: 20px;
            max-width: 600px;
        }
    </style>
@stop

@section('js')
    <script>

        $('#name').on('input', function () {
            $('#nameDescription').text($(this).val().length + '/256');
        })
    </script>
@stop
