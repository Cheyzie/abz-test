@extends('adminlte::page')

@section('title', 'Employees')

@section('content_header')
    <h1>Employees</h1>
@stop

@section('content')
    <form class="crete-form" enctype="multipart/form-data" action="{{url('admin/employees')}}" method="POST">
        @csrf
        <h3>Add employee</h3>
        <div class="form-group">
            <div class="mb-5">
                <label for="Image" class="form-label d-block">Photo</label>
                <img id="frame" class="img-fluid center-cropped" src="https://dummyimage.com/300x300/272d31/fff.png&text=Photo+placeholder"/>
                <input class="form-control-file" type="file" id="photo" name="photo" onchange="preview(this)" value="{{ old('photo') }}">
                @error('photo')
                <div class="alert alert-danger"> {{$message}} </div>
                @enderror
            </div>
        </div>

        <script>
            function preview(el) {
                frame.src = URL.createObjectURL(el.files[0]);
            }
        </script>
        <div class="form-group">
            <label for="formGroupExampleInput">Name</label>
            <input type="text" class="form-control" id="name" name="full_name" maxlength="256"value="{{ old('full_name') }}">
            @error('name')
            <div class="alert alert-danger"> {{$message}} </div>
            @enderror
            <small id="nameDescription" class="form-text text-muted justify-content-end text-right">
                {{strlen(old('full_name') ?? '')}}/256
            </small>
        </div>

        <div class="form-group">
            <label for="formGroupExampleInput">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone_number" value="{{ old('phone_number') }}">
            @error('phone')
            <div class="alert alert-danger"> {{$message}} </div>
            @enderror
            <small class="form-text text-muted text-right">
                Required format +380 (xx) XXX XX XX
            </small>
        </div>

        <div class="form-group">
            <label for="formGroupExampleInput">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
            @error('email')
            <div class="alert alert-danger"> {{$message}} </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="position">Position</label>
            <select id="position" name="position_id" class="form-control">
                <option disabled selected value="">Choose...</option>
                @foreach($positions as $position)
                <option value="{{$position->id}}" @selected(old('position_id') == $position->id)>{{$position->name}}</option>
                @endforeach
            </select>
            @error('position_id')
            <div class="alert alert-danger"> {{$message}} </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="salary">Salary, $</label>
            <input type="number" class="form-control" id="salary" name="salary" step="0.01" value="{{ old('salary') }}">
            @error('salary')
            <div class="alert alert-danger"> {{$message}} </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="head">Head</label>
            <input type="text" class="form-control" id="head" name="head" value="{{ old('head') }}">
            @error('head')
            <div class="alert alert-danger"> {{$message}} </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="hire_date">Date of employment</label>
            <input type="date" class="form-control" id="hire_date" name="hire_date" value="{{ old('hire_date') }}">
            @error('hire_date')
            <div class="alert alert-danger"> {{$message}} </div>
            @enderror
        </div>

        <input type="submit" class="btn btn-secondary" value="Add employee">
    </form>

@stop

@section('css')
    <style>
        .crete-form {
            border: 1px solid gray;
            padding: 20px;
            max-width: 600px;
        }
        .center-cropped {
            object-fit: none; /* Do not scale the image */
            object-position: center; /* Center the image within the element */
            height: 300px;
            width: 300px;
        }

    </style>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script>
        let path = "{{ route('autocomplete.employees') }}";

        $('#head').typeahead({
            source:  function (query, process) {
                return $.get(path, { query: query }, function (data) {
                    return process(data);
                });
            }
        });

        $('#name').on('input', function () {
            $('#nameDescription').text($(this).val().length + '/256');
        })
    </script>
@stop
