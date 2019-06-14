@extends('layouts.master')
@section('title', 'Purchase Show')
@section('content-head', 'Show Purchase')

@section('content')
    <style>
        .border-hide tr td,th{
            padding: 5px;
        }
    </style>
    @foreach($purchases as $purchase)@endforeach

    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('print/purchase',$purchase->purchase_no) }}" class="btn btn-info">PDF</a>
            <a href="" class="btn btn-info"><i class="fa fa-download"></i></a>
        </div>
    </div>
    <table width="100%" class="  border-hide">
        <tr>
            <th>My Shop Manage</th>
            <td>Bill From</td>
            <td>Purchase No # {{ $purchase->purchase_no }}</td>
        </tr>
        <tr >
            <th >Plot-10, Road-10</th>
            <td>{{ $purchase->supplier->name }}</td>
            <td>Invoice date: {{  \Illuminate\Support\Carbon::parse($purchase->invoice_date)->format('d M Y')}}</td>
            {{--
                        <td>Invoice date: {{  \Illuminate\Support\Carbon::parse($purchase->invoice_date)->diffForHumans('d M Y')}}</td>
            --}}
        </tr>
        <tr >
            <td>BD, Dhaka</td>
            <td>{{ $purchase->supplier->address }}</td>
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
        @foreach($purchases as $purchase)
            <tr>
                <td>{{ $purchase->item->name }}</td>
                <td>{{ $purchase->quantity }}</td>
                <td>{{ $purchase->price }}</td>
                <td>{{ $purchase->discount }}</td>
                <td>{{ $purchase->quantity*$purchase->price }}</td>
            </tr>
            @php($total_discount=$total_discount+($purchase->quantity*$purchase->discount))
            @php($sub_total=$sub_total+($purchase->quantity*$purchase->price ))
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
