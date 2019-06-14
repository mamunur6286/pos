@extends('layouts.master')
@section('title', 'Category create form')
@section('content-head', 'Create Category')

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


    {!! Form::open(['route'=>'categories.store', 'files'=>true,'class'=>'form-horizontal']) !!}




    <div class="form-group">
        {{Form::label('name', 'Category Name',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::text('name', '', array('class'=>'form-control', 'placeholder'=>'Enter category name' ) )}}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('description', 'Description',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::text('description', '', array('class'=>'form-control', 'placeholder'=>'Enter description') )}}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('photo', 'Item photo',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::file('photo', array('class'=>'form-control') )}}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('comments', 'Item comments',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::text('comments', '', array('class'=>'form-control', 'placeholder'=>'Enter comments') )}}
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
