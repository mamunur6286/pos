@extends('layouts.master')
@section('title', 'Suppliers List')
@section('content-head', 'Suppliers List')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
                <div class="x_content table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-info"  href="{{ url('supplier/import') }}"><i class="fa fa-upload"></i> Import Excel</a>
                            <a class="btn btn-info"  href="{{ url('supplier/export') }}"><i class="fa fa-download"></i> Export Excel</a>
                            <br>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-info" href="{{ route('suppliers.create') }}"><i class="fa fa-plus"></i> Add Suppliers</a>
                        </div>
                        <br>
                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        @php($i=1)
                        <tbody>
                        @foreach($suppliers as $supplier)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $supplier->name }}</td>
                                <td>
                                    <img src="{{ asset('/') }}{{ $supplier->image }}" width="50px" height="50px" alt="">

                                </td>
                                <td>{{ $supplier->mobile }}</td>
                                <td>{{ $supplier->email }}</td>
                                <td>{{ $supplier->city }}</td>
                                <td>{{ $supplier->country }}</td>
                                <td>{{ $supplier->address }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="{{ route('suppliers.edit',$supplier->id) }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> </a>
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::open([ 'method'=>'delete','route'=>['suppliers.destroy',$supplier->id],'onclick'=>" return confirm('Are you sure to delete this customer?')"]) !!}
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