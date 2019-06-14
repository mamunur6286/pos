@extends('layouts.master')
@section('title', 'Categories List')
@section('content-head', 'Categories List')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-info"  href="{{ url('category/import') }}"><i class="fa fa-upload"></i> Import Excel</a>
                            <a class="btn btn-info"  href="{{ url('category/export') }}"><i class="fa fa-download"></i> Export Excel</a>
                            <br>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-info" href="{{ route('categories.create') }}"><i class="fa fa-plus"></i> Add Customer</a>
                            <br>
                        </div>

                    </div>
                    <table id="datatable-buttons" class=" table table-striped table-responsive table-bordered">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Photos</th>
                            <th>Comments</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        @php($i=1)
                        <tbody>
                        @foreach($categories as $value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->description }}</td>
                                <td>
                                    <img src="{{ asset('/') }}files/{{ $value->photo }}" width="50px" height="50px" alt="">

                                </td>
                                <td>{{ $value->comments }}</td>
                                <td class="text-center">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="{{ route('categories.edit',$value->id) }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> </a>
                                        </div>
                                            <div class="col-md-3">
                                                {!! Form::open([ 'method'=>'delete','route'=>['categories.destroy',$value->id],'onclick'=>" return confirm('Are you sure to delete this image?')"]) !!}
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>
                                                {!! Form::close() !!}
                                            </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection