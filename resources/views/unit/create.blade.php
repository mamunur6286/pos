@extends('layouts.master')
@section('title', 'Unit create form')
@section('content-head', 'Create Unit')

@section('content')


    @if (count($errors) > 0)
        <div class = "alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::open(['route'=>'units.store', 'files'=>true,'class'=>'form-horizontal']) !!}

    <div class="form-group">
        {{Form::label('name', 'Unit Name',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::text('name', '', array('class'=>'form-control', 'placeholder'=>'Enter category name' ) )}}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('', '',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::submit('Save', ['class'=>'btn btn-primary'])}}
        </div>
    </div>


    {!! Form::close() !!}

    @if(Session::has('success'))
        <script>
            Swal.fire(
                'Good job!',
                '{{Session::get("success")}}',
                'success'
            )
        </script>
    @endif

    @if(Session::has('error'))
        <script>
            Swal.fire(
                'Good job!',
                '{{Session::get("error")}}',
                'error'
            )
        </script>
    @endif

@endsection
