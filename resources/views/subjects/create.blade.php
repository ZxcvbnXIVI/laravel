<!-- resources/views/subjects/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Subject</div>

                    <div class="card-body">
                    {!! Form::open(['route' => 'subjects.store', 'method' => 'post']) !!}
    <div class="form-group">
        {!! Form::label('SubjectName', 'Subject Name') !!}
        {!! Form::text('SubjectName', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Description', 'Description') !!}
        {!! Form::textarea('Description', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('PlaylistLink', 'YouTube Playlist URL') !!}
        {!! Form::text('PlaylistLink', null, ['class' => 'form-control', 'required', 'id' => 'playlistUrl']) !!}
    </div>



    <div class="form-group">
        {!! Form::submit('Create Subject', ['class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* สไตล์สำหรับโมดัล */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
     <script>
        // เพิ่ม JavaScript เพื่อเปิดปิดโมดัล
        function openCreateDialog() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'block';
        }

        function closeCreateDialog() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'none';
        }
    </script>
@endsection
