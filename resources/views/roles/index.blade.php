
@extends('layouts.master')
@section('title', 'Roles List')
@section('content-head', 'Roles List')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
                <div class="x_content table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-info"  href="{{ route('users.index') }}"><i class="fa fa-life-saver"></i> Users</a>
                            <a class="btn btn-info"  href="{{ route('permissions.index') }}"><i class="fa fa-list-alt"></i> Permissions</a>
                            <br>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-info" href="{{  URL::to('roles/create')  }}"><i class="fa fa-plus"></i> Add Role</a>
                        </div>
                        <br>
                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th>Operation</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($roles as $role)
                            <tr>

                                <td>{{ $role->name }}</td>

                                <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                                <td>
                                    <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-sm btn-info pull-left" style="margin-right: 3px;"><i class="fa fa-edit"></i></a>

                                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
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