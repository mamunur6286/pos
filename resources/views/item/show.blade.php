@extends('layouts.master')
@section('title', 'Show Item')
@section('content-head', 'Show Item')

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="text-center"><img width="160px" height="170px" src="{{asset('/')}}files/{{ $item->photo }}"></div>
            <br>
            <table class="table table-responsive table-bordered">
                <tr>
                    <td>Product Name</td>
                    <td>{{ $item->name }}</td>
                </tr>
                <tr>
                    <td>Product Category</td>
                    <td>{{ $item->category_id }}</td>
                </tr>
                <tr>
                    <td>Product Description</td>
                    <td>{{ $item->description }}</td>
                </tr>
                <tr>
                    <td>Product Units</td>
                    <td>{{ $item->units }}</td>
                </tr>
                <tr>
                    <td>Product Comments</td>
                    <td>{{ $item->comments }}</td>
                </tr>
                <tr>
                    <td>Bar Code</td>
                    <td><?php echo $item->barcode ?>  </td>
                </tr>
            </table>
        </div>
        <div class="col-md-2"></div>

    </div>


@endsection