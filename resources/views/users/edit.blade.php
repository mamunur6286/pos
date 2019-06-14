@extends('layouts.master')
@section('title', 'User edit form')
@section('content-head', 'Edit User')

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
    {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT','class'=>'form-horizontal')) }}{{-- Form model binding to automatically populate our fields with user data --}}

    <div class="form-group">
        {{ Form::label('name', 'User Name',['class'=>' col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('email', 'Email',['class'=>' col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::email('email', null, array('class' => 'form-control','placeholder'=>'Enter email address')) }}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('role', 'Select Roll',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            @foreach ($roles as $role)
                {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
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
            {{Form::submit('Update', ['class'=>'btn btn-primary'])}}
        </div>
    </div>


    {!! Form::close() !!}



@endsection

