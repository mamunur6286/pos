@extends('layouts.master')
@section('title', 'Users List')
@section('content-head', 'Users List')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
                <div class="x_content table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-info"  href="{{ route('permissions.index') }}"><i class="fa fa-life-saver"></i> Permissions</a>
                            <a class="btn btn-info"  href="{{ route('roles.index') }}"><i class="fa fa-list-alt"></i> Roles</a>
                            <br>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-info" href="{{ route('users.create') }}"><i class="fa fa-plus"></i> Add User</a>
                        </div>
                        <br>
                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date/Time Added</th>
                                <th>User Roles</th>
                                <th>Operations</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($users as $user)
                                <tr>

                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                                    <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                                    <td class="">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info pull-left" style="margin-right: 3px;"><i class="fa fa-edit"></i> </a>

                                        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
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