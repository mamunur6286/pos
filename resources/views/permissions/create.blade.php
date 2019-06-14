@extends('layouts.master')
@section('title', 'Permission create form')
@section('content-head', 'Create Permission')

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
    {!! Form::open(['url'=>'permissions', 'files'=>true,'class'=>'form-horizontal ']) !!}

    <div class="form-group">
        {{ Form::label('name', 'Permission Name',['class'=>' col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::text('name', null, array('class' => 'form-control','placeholder'=>'Enter permission name')) }}
        </div>
    </div>
    @if(!$roles->isEmpty())

    <div class="form-group">
        {{Form::label('Permissions', 'Assign Permission to Roles',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            @foreach ($roles as $role)
                {{ Form::checkbox('roles[]',  $role->id ) }}
                {{ Form::label($role->name, ucfirst($role->name)) }}<br>

            @endforeach
        </div>
    </div>
    @endif
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
