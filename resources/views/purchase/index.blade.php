@extends('layouts.master')
@section('title', 'purchase List')
@section('content-head', 'purchase List')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
                <div class="x_content table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-info"  href="{{ url('purchase/import') }}"><i class="fa fa-upload"></i> Import Excel</a>
                            <a class="btn btn-info"  href="{{ url('purchase/export') }}"><i class="fa fa-download"></i> Export Excel</a>
                            <br>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-info" href="{{ route('purchases.create') }}"><i class="fa fa-plus"></i> Add purchase</a>
                            <br>
                        </div>

                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>purchase No</th>
                            <th>purchase Date</th>
                            <th>supplier Id</th>
                            <th>Item Id</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        @php($i=1)
                        <tbody>
                        @foreach($purchases as $purchase)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td><a href="{{ route('purchases.show',$purchase->id) }}">{{ $purchase->purchase_no }}</a></td>
                                <td>{{ $purchase->purchase_date}}</td>
                                <td>{{ $purchase->supplier_id }}</td>
                                <td>{{ $purchase->item_id }}</td>
                                <td>{{ $purchase->quantity }}</td>
                                <td>{{ $purchase->price }}</td>
                                <td>{{ $purchase->discount }}</td>
                                <td>{{ $purchase->amount }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="{{ route('purchases.edit',$purchase->id) }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> </a>
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::open([ 'method'=>'delete','route'=>['purchases.destroy',$purchase->id],'onclick'=>" return confirm('Are you sure to delete this supplier?')"]) !!}
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