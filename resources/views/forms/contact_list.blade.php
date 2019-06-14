@extends('layouts.master')
@section('title', 'Contact List')
@section('content-head', 'Contact List')

@section('content')
@if(Session::has('success'))
    <script>
        Swal.fire(
            'Good job!',
            '{{Session::get("success")}}',
            'success'
        )
    </script>
@endif

@if(Session::has('error'))
    <script>
        Swal.fire(
            'Good job!',
            '{{Session::get("error")}}',
            'error'
        )
    </script>
@endif





        <table class="table table-stripped">
            <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Address</th>
            <th>Added at</th>
            <th>Updated at</th>
            <th>Action</th>
            </tr>



    @foreach($contacts as $contact)


        <tr>
            <td>{{$contact->id}}</td>
            <td><a href="{{route('product.edit', $contact->id)}}">{{$contact->name}}</a></td>
            <td>{{$contact->mobile}}</td>
            <td>{{$contact->email}}</td>
            <td>{{$contact->address}}</td>
            <td>{{\Carbon\Carbon::parse($contact->created_at)->diffForHumans()}}</td>
            <td>{{\Carbon\Carbon::parse($contact->updated_at)->diffForHumans()}}</td>
            <td>
                <a href="{{route('product.edit', $contact->id)}}" class="btn-sm btn-primary">Edit</a>

                {!! Form::open(['method'=>'DELETE', 'route'=>['product.destroy', $contact->id]]) !!}
                {{Form::submit('Delete', ['class'=>'btn-xs btn-danger pull-right'])}}
                {!! Form::close() !!}
            </td>

        </tr>
    @endforeach
        </table>
@endsection