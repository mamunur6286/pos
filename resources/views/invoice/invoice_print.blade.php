<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Print</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
<div class="container">
    <style>
        .border-hide tr td,th{
            padding: 4px;
            font-size: 10px;
        }
        .data tr td,th{
            padding: 1px;
            font-size: 10px;
        }
    </style>
    <p class="text-center">== Invoice ==</p>
    @foreach($invoices as $invoice)@endforeach

    <table width="100%" class="  border-hide">
        <tr>
            <th>My Shop Manage</th>
            <th>Bill to</th>
            <th>Invoice No # {{ $invoice->invoice_no }}</th>
        </tr>
        <tr >
            <td >Plot-10, Road-10</td>
            <td>{{ $invoice->customer->name }}</td>
            <td>Invoice date: {{  \Illuminate\Support\Carbon::parse($invoice->invoice_date)->format('d M Y')}}</td>
        </tr>
        <tr >
            <td>BD, Dhaka</td>
            <td>{{ $invoice->customer->address }}</td>
            <td></td>
        </tr>
    </table>

    <table  class="table data text-center mt-2 table-bordered" >

        <tr>
            <th class="text-center">Product Name</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Price</th>
            <th class="text-center">Discount</th>
            <th class="text-center">Total Fees</th>
        </tr>

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

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td  class="text-right"> Sub Total</td>
            <td class="text-center">{{ $sub_total }}</td>

        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td  class="text-right">Total Discount</td>
            <td class="text-center">{{ $total_discount }}</td>

        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td  class="text-right"> Total</td>
            <td class="text-center">{{ $sub_total - $total_discount }}</td>
        </tr>
    </table>

    <div class="row">
        <div class="col-md-12">
            <p style="margin-bottom: -10px;font-size: 12px;margin-left: 18px" class="font-italic">Md Mamunur</p>
            <p>-------------------</p>
            <p style="margin-top: -20px; font-size: 12px; margin-left: 18px">Signature</p>
        </div>
    </div>
</div>
</div>


</body>
</html>