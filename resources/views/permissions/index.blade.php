
@extends('layouts.master')
@section('title', 'Permissions List')
@section('content-head', 'Permissions List')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
                <div class="x_content table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-info"  href="{{ route('users.index') }}"><i class="fa fa-life-saver"></i> Users</a>
                            <a class="btn btn-info"  href="{{ route('roles.index') }}"><i class="fa fa-list-alt"></i> Roles</a>
                            <br>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-info" href="{{ URL::to('permissions/create') }}"><i class="fa fa-plus"></i> Add Permission</a>
                        </div>
                        <br>
                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Permissions</th>
                            <th>Operation</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-info btn-sm pull-left" style=""><i class="fa fa-edit"></i></a>

                                    {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    {!! Form::close() !!}

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