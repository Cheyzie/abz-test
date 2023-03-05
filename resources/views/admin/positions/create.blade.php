@extends('adminlte::page')

@section('title', 'Positions')

@section('content_header')
    <h1>Positions</h1>
@stop

@section('content')
    <form class="create-form" enctype="multipart/form-data" action="{{url('admin/positions')}}" method="POST">
        @csrf
        <h3>Add position</h3>
        <div class="form-group">
            <label for="formGroupExampleInput">Name</label>
            <input type="text" class="form-control" id="name" name="name" maxlength="256"value="{{ old('name') }}">
            @error('name')
            <div class="alert alert-danger"> {{$message}} </div>
            @enderror
            <small id="nameDescription" class="form-text text-muted justify-content-end text-right">
                {{strlen(old('name') ?? '')}}/256
            </small>
        </div>

        <input type="submit" class="btn btn-secondary" value="Save">
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
