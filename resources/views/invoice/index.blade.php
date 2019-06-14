@extends('layouts.master')
@section('title', 'Invoice List')
@section('content-head', 'Invoice List')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
                <div class="x_content table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-info"  href="{{ url('invoice/import') }}"><i class="fa fa-upload"></i> Import Excel</a>
                            <a class="btn btn-info"  href="{{ url('invoice/export') }}"><i class="fa fa-download"></i> Export Excel</a>
                            <br>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-info" href="{{ route('invoices.create') }}"><i class="fa fa-plus"></i> Add Invoice</a>
                            <br>
                        </div>

                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Invoice No</th>
                            <th>Invoice Date</th>
                            <th>Customer Id</th>
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
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td><a href="{{ route('invoices.show',$invoice->id) }}">{{ $invoice->invoice_no }}</a></td>
                                <td>{{ $invoice->invoice_date}}</td>
                                <td>{{ $invoice->customer_id }}</td>
                                <td>{{ $invoice->item_id }}</td>
                                <td>{{ $invoice->quantity }}</td>
                                <td>{{ $invoice->price }}</td>
                                <td>{{ $invoice->discount }}</td>
                                <td>{{ $invoice->amount }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="{{ route('invoices.edit',$invoice->id) }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> </a>
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::open([ 'method'=>'delete','route'=>['invoices.destroy',$invoice->id],'onclick'=>" return confirm('Are you sure to delete this customer?')"]) !!}
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