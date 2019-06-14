@extends('layouts.master')
@section('title', 'Contact form')
@section('content-head', 'Contact Form')

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


    {!! Form::open(['route'=>'product.store']) !!}

    {{Form::text('name', '',array('class'=>'form-control', 'placeholder'=>'Enter your name') )}}
    @if($errors->has('name'))
        <p class="alert alert-danger">
            {{$errors->first('name')}}
        </p>
    @endif
    {{Form::text('mobile', '',array('class'=>'form-control', 'placeholder'=>'Enter your mobile no') )}}
    {{Form::text('email', '',array('class'=>'form-control', 'placeholder'=>'Enter your email no') )}}
    {{Form::text('address', '',array('class'=>'form-control', 'placeholder'=>'Enter your address') )}}

    {{--<input class="form-control" type="text" name="name" value="" placeholder="Enter your name" required>--}}


    {{Form::submit('Save', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

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

@endsection
