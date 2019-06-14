@extends('layouts.master')
@section('title', 'Role create form')
@section('content-head', 'Create Role')

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
    {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT','class'=>'form-horizontal ')) }}

    <div class="form-group">
        {{ Form::label('name', 'Role Name',['class'=>' col-md-3 col-sm-3 col-xs-12']) }}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::text('name', null, array('class' => 'form-control','placeholder'=>'Enter role name')) }}
        </div>
    </div>

    <div class="form-group">
        {{Form::label('Permissions', 'Assign Permissions',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            @foreach ($permissions as $permission)

                {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
                {{Form::label($permission->name, ucfirst($permission->name)) }}<br>

            @endforeach
        </div>
    </div>

    <div class="form-group">
        {{Form::label('', '',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::submit('Update', ['class'=>'btn btn-primary'])}}
        </div>
    </div>


    {!! Form::close() !!}


    <br>
    <br>
    <br>
    <br>
    <br>
@endsection


