@extends('layouts.master')
@section('title', 'Items Lists Table')
@section('content-head', 'Items List')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-info"  href="{{ url('item/import') }}"><i class="fa fa-upload"></i> Import Excel</a>
                            <a class="btn btn-info"  href="{{ url('item/export') }}"><i class="fa fa-download"></i> Export Excel</a>
                            <br>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-info" href="{{ route('items.create') }}"><i class="fa fa-plus"></i> Add Product</a>
                            <br>
                        </div>

                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Unit</th>
                            <th>Description</th>
                            <th>Photos</th>
                            <th>Comments</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        @php($i=1)
                        <tbody>
                        @foreach($items as $value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->category->name }}</td>
                                <td>{{ $value->unit->name }}</td>
                                <td>{{ $value->description }}</td>
                                <td>
                                    <img src="{{ asset('/') }}files/{{ $value->photo }}" width="50px" height="50px" alt="">
                                </td>
                                <td>{{ $value->comments }}</td>
                                <td class="text-center">
                                    <div class="row">
                                        @can('edit')
                                        <div class="col-md-4">
                                            <a href="{{ route('items.show',$value->id) }}" class="btn btn-sm btn-success"><i class="fa fa-eye-slash"></i> </a>
                                        </div>
                                            <div class="col-md-4">
                                            <a href="{{ route('items.edit',$value->id) }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> </a>
                                        </div>
                                        @endcan
                                        @can('delete')
                                            <div class="col-md-4">
                                                {!! Form::open([ 'method'=>'delete','route'=>['items.destroy',$value->id],'onclick'=>" return confirm('Are you sure to delete this image?')"]) !!}
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>
                                                {!! Form::close() !!}
                                            </div>
                                        @endcan
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