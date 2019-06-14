@extends('layouts.master')
@section('title', 'User create form')
@section('content-head', 'Create User')

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
    {!! Form::open(['url'=>'users', 'files'=>true,'class'=>'form-horizontal ']) !!}

    <div class="form-group">
            {{ Form::label('name', 'User Name',['class'=>' col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::text('name', '', array('class' => 'form-control','placeholder'=>'Enter user name')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('email', 'Email',['class'=>' col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::email('email', '', array('class' => 'form-control','placeholder'=>'Enter email address')) }}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('role', 'Select Roll',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            @foreach ($roles as $role)
                {{ Form::checkbox('roles[]',  $role->id ) }}
                {{ Form::label($role->name, ucfirst($role->name)) }}<br>
            @endforeach
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('password', 'Password',['class'=>' col-md-3 col-sm-3 col-xs-12']) }}<br>
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::password('password', array('class' => 'form-control','placeholder'=>'Enter Password')) }}
        </div>
    </div>
    <div class="form-group">

        {{Form::label('password', 'Confirm Password',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::password('password_confirmation', array('class' => 'form-control','placeholder'=>'Confirm Password')) }}
        </div>
    </div>

    <div class="form-group">
        {{Form::label('', '',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::submit('Save', ['class'=>'btn btn-primary'])}}
        </div>
    </div>


    {!! Form::close() !!}



@endsection

