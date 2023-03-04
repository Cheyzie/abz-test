@extends('adminlte::page')

@section('title', 'Employees')

@section('content_header')
    <div class="header">
        <h1>Employees</h1>
        <a href="#" class="btn bg-dark add-employee">Add employee</a>
    </div>
@stop

@section('content')
    {{ $dataTable->table(['class' => 'table table-striped']) }}
@stop

@section('css')
    <style>
        .header {
            display: flex;
            justify-content: space-between;
        }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@stop

@section('js')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@stop
