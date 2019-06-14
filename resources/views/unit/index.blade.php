@extends('layouts.master')
@section('title', 'Unit List')
@section('content-head', 'Units List')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
                <div class="x_content table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-info"  href="{{ url('unit/import') }}"><i class="fa fa-upload"></i> Import Excel</a>
                            <a class="btn btn-info"  href="{{ url('unit/export') }}"><i class="fa fa-download"></i> Export Excel</a>
                            <br>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-info" href="{{ route('units.create') }}"><i class="fa fa-plus"></i> Add Unit</a>
                        </div>
                        <br>
                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        @php($i=1)
                        <tbody>
                        @foreach($units as $unit)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $unit->name }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6 text-right">
                                            <a href="{{ route('units.edit',$unit->id) }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> </a>
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::open([ 'method'=>'delete','route'=>['units.destroy',$unit->id],'onclick'=>" return confirm('Are you sure to delete this unit?')"]) !!}
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