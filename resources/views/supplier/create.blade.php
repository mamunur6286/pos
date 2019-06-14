@extends('layouts.master')
@section('title', 'supplier create form')
@section('content-head', 'Create Supplier')

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

    {!! Form::open(['route'=>'suppliers.store', 'files'=>true,'class'=>'form-horizontal ']) !!}
    <div class="form-group">
        {{Form::label('image', 'Customer Image',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::file('image', array('class'=>'form-control') )}}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('name', 'Name',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::text('name', '', array('class'=>'form-control', 'placeholder'=>'Enter customer name' ) )}}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('mobile', 'Mobile',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::text('mobile', '', array('class'=>'form-control', 'placeholder'=>'Enter mobile number') )}}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('email', 'Email',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::text('email', '', array('class'=>'form-control', 'placeholder'=>'Enter email address') )}}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('city', 'City',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::text('city', '', array('class'=>'form-control', 'placeholder'=>'Enter city') )}}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('country', 'Country',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::text('country', '', array('class'=>'form-control', 'placeholder'=>'Enter country') )}}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('address', 'Address',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::text('address', '', array('class'=>'form-control', 'placeholder'=>'Enter address') )}}
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
