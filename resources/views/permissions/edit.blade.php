@extends('layouts.master')
@section('title', 'Edit create form')
@section('content-head', 'Edit Permission')

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
    {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT','class'=>'form-horizontal ')) }}{{-- Form model binding to automatically populate our fields with permission data --}}

    <div class="form-group">
        {{ Form::label('name', 'Permission Name',['class'=>' col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::text('name', null, array('class' => 'form-control','placeholder'=>'Enter permission name')) }}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('', '',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::submit('Save', ['class'=>'btn btn-primary'])}}
        </div>
    </div>


    {!! Form::close() !!}


    <br>
    <br>
    <br>
    <br>
    <br>
@endsection

