@extends('layouts.master')
@section('title', 'Purchase Import form')
@section('content-head', 'Import Purchase')

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
    <br>
    <br>
    <br>
    {!! Form::open(['url'=>'purchase/excel/store', 'files'=>true,'class'=>'form-horizontal ']) !!}
    <div class="form-group">
        {{Form::label('import', 'Import File',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::file('excel', array('class'=>'form-control') )}}
        </div>
    </div>

    <div class="form-group">
        {{Form::label('', '',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::submit('Import', ['class'=>'btn btn-primary'])}}
        </div>
    </div>


    {!! Form::close() !!}
    <br>
    <br>
    <br>
    <br>


@endsection
