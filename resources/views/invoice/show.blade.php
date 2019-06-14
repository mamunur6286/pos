@extends('layouts.master')
@section('title', 'Invoice Show')
@section('content-head', 'Show Invoice')

@section('content')
    <style>
        .border-hide tr td,th{
            padding: 5px;
        }
    </style>
    @foreach($invoices as $invoice)@endforeach

    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('print/invoice',$invoice->invoice_no) }}" class="btn btn-info">PDF</a>
            <a href="" class="btn btn-info"><i class="fa fa-download"></i></a>
        </div>
    </div>
    <table width="100%" class="  border-hide">
        <tr>
            <th>My Shop Manage</th>
            <td>Bill to</td>
            <td>Invoice No # {{ $invoice->invoice_no }}</td>
        </tr>
        <tr >
            <th >Plot-10, Road-10</th>
            <td>{{ $invoice->customer->name }}</td>
            <td>Invoice date: {{  \Illuminate\Support\Carbon::parse($invoice->invoice_date)->format('d M Y')}}</td>
{{--
            <td>Invoice date: {{  \Illuminate\Support\Carbon::parse($invoice->invoice_date)->diffForHumans('d M Y')}}</td>
--}}
        </tr>
        <tr >
            <td>BD, Dhaka</td>
            <td>{{ $invoice->customer->address }}</td>
            <td></td>
        </tr>
    </table>
    <br>
    <table  class="table table-responsive text-center mt-2 table-bordered" >
        <thead >
        <th class="text-center">Product Name</th>
        <th class="text-center">Quantity</th>
        <th class="text-center">Price</th>
        <th class="text-center">Discount</th>
        <th class="text-center">Total Fees</th>
        </thead>
        <tbody id="tablefield">
        @php($total_discount=0)
        @php($sub_total=0)
        @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->item->name }}</td>
            <td>{{ $invoice->quantity }}</td>
            <td>{{ $invoice->price }}</td>
            <td>{{ $invoice->discount }}</td>
            <td>{{ $invoice->quantity*$invoice->price }}</td>
        </tr>
            @php($total_discount=$total_discount+($invoice->quantity*$invoice->discount))
            @php($sub_total=$sub_total+($invoice->quantity*$invoice->price ))
            @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4" class="text-right"> Sub Total</td>
            <td class="text-center">{{ $sub_total }}</td>

        </tr>
        <tr>
            <td colspan="4" class="text-right">Total Discount</td>
            <td class="text-center">{{ $total_discount }}</td>

        </tr>
        <tr>
            <td colspan="4" class="text-right"> Total</td>
            <td class="text-center">{{ $sub_total - $total_discount }}</td>
        </tr>
        </tfoot>
    </table>

    <div class="row">
        <div class="col-md-12">
            <p style="margin-bottom: -10px" class="font-italic">Md Mamunur</p>
            <p>--------------------------</p>
            <p style="margin-top: -10px">Signature</p>
        </div>
    </div>

@endsection
