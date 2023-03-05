@extends('adminlte::page')

@section('title', 'Positions')

@section('content_header')
    <div class="header">
        <h1>Positions</h1>
        <a href="{{url('/admin/positions/create')}}" class="btn bg-dark add-employee">Add position</a>
    </div>
@stop

@section('content')
    <div id="deleteModal" class="modal">

        <div class="modal-content">
            <div class="modal-content__header modal-header">
                <div class="modal-header__title">Remove position</div>
                <div class="modal-header__close">&times;</div>
            </div>
            <p class="modal-content__text">Some text in the Modal..</p>
            <div class="modal-content__buttons modal-buttons">
                <div class="modal-buttons__cancel btn btn-outline-secondary">Cancel</div>
                <div class="modal-buttons__delete btn btn-secondary">Delete</div>
            </div>
        </div>

    </div>

    {{ $dataTable->table(['class' => 'table table-striped']) }}
@stop

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .header {
            display: flex;
            justify-content: space-between;
        }
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1999; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;/* Could be more or less, depending on screen size */
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }

        .modal-header__title {
            font-size: 24px;
        }

        .modal-header__close {
            font-size: 28px;
            cursor: pointer;
        }

        .modal-content__text {
            font-size: 18px;
            padding: 20px;
        }
        /* The Close Button */
        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            padding: 10px;
        }
        .modal-buttons__cancel {
            padding: 5px 10px;
            margin: 0 10px;
        }

        .modal-buttons__delete {
            padding: 5px 10px;
        }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@stop

@section('js')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        function deletePositionHandle(e) {
            let modal = document.getElementById("deleteModal");

            let spans = [
                document.getElementsByClassName("modal-header__close")[0],
                document.getElementsByClassName("modal-buttons__cancel")[0]
            ];
            spans.forEach((el) => el.onclick = function() {
                modal.style.display = "none";
            });

            let deleteBtn = document.getElementsByClassName('modal-buttons__delete')[0];
            let url = '{{url('/admin/positions')}}'+'/'+e.getAttribute('data-id');
            deleteBtn.onclick = () => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    method: 'delete',
                    success: (result) => {
                        if(result.deleted ) {
                            modal.style.display = "none";
                            $('#positions-table').DataTable().ajax.reload();
                        }
                    }
                })
            };

            let content = document.getElementsByClassName("modal-content__text")[0];
            content.innerHTML = 'Are you sure you want to remove position ' + e.getAttribute('data-name');
            modal.style.display = "block";
        }
    </script>
@stop
