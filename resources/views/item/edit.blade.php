
@extends('layouts.master')
@section('title', 'Item create form')
@section('content-head', 'Create Item')

@section('content')

    <style>
        * {box-sizing: border-box}

        /* Set height of body and the document to 100% */
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial;
        }

        /* Style tab links */
        .tablink {
            float: left;
            border-bottom: 1px solid gray;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            width: 15%;
            text-align: center;
        }

        .tablink:hover {

        }

        /* Style the tab content (and add height:100% for full page content) */
        .tabcontent {
            padding: 100px 20px;
            height: 100%;
        }


    </style>
    <a class="tablink" style="border-left:0px solid gray" onclick="openPage('Home', this, 'white')" id="defaultOpen">Home</a>
    <a class="tablink" onclick="openPage('News', this, 'white')" >Sales Price</a>
    <a class="tablink" onclick="openPage('Contact', this, 'white')">Purchase Price</a>
    <a class="tablink" onclick="openPage('About', this, 'white')">Transactions</a>



    <div id="Home" class="tabcontent bg-light">
        @if (count($errors) > 0)
            <div class = "alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            {!! Form::open(['method'=>'put','route'=>['items.update',$item->id], 'files'=>true,'class'=>'form-horizontal']) !!}


            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <img src="{{ asset('/') }}files/{{ $item->photo }}" width="100px" height="100px" alt="">
                </div>
            </div>
            <br>
            <div class="form-group">
                {{Form::label('category', 'Select Category',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {{Form::select('category_id', $categories, $item->category, array('class'=>'form-control' ) )}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('name', 'Name',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {{Form::text('name', $item->name, array('class'=>'form-control', 'placeholder'=>'Enter product name' ) )}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('description', 'Description',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {{Form::text('description', $item->description, array('class'=>'form-control', 'placeholder'=>'Enter description') )}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('photo', 'Item photo',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {{Form::file('photo', array('class'=>'form-control') )}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('comments', 'Item comments',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {{Form::text('comments', $item->comments, array('class'=>'form-control', 'placeholder'=>'Enter comments') )}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('', '',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {{Form::submit('Update', ['class'=>'btn btn-primary'])}}
                </div>
            </div>


            {!! Form::close() !!}
    </div>

    <div id="News" class="tabcontent bg-light">
        @if (count($errors) > 0)
            <div class = "alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::open(['method'=>'post','url'=>['sales/update',$price->id], 'files'=>true,'class'=>'form-horizontal']) !!}

        <div class="form-group">
            {{Form::label('comments', 'Enter Sales Price',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
            <div class="col-md-6 col-sm-6 col-xs-12">
                {{Form::text('sales_price', $price->sale_prices, array('class'=>'form-control', 'placeholder'=>'Enter comments') )}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('', '',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
            <div class="col-md-6 col-sm-6 col-xs-12">
                {{Form::submit('Update', ['class'=>'btn btn-primary'])}}
            </div>
        </div>


        {!! Form::close() !!}
    </div>

    <div id="Contact" class="tabcontent bg-light">
        {!! Form::open(['method'=>'post','url'=>['purchase/update',$price->id], 'files'=>true,'class'=>'form-horizontal']) !!}

        <div class="form-group">
            {{Form::label('comments', 'Enter Purchase Price',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
            <div class="col-md-6 col-sm-6 col-xs-12">
                {{Form::text('purchase_prices', $price->purchase_prices, array('class'=>'form-control', 'placeholder'=>'Enter comments') )}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('', '',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
            <div class="col-md-6 col-sm-6 col-xs-12">
                {{Form::submit('Update', ['class'=>'btn btn-primary'])}}
            </div>
        </div>


        {!! Form::close() !!}
    </div>

    <div id="About" class="tabcontent bg-light">
        <table class="table text-center table-bordered">
            <th class="text-center">Transaction Type</th>
            <th class="text-center">Date</th>
            <th class="text-center">Quantity In</th>
            <th class="text-center">Quantity Out	</th>
            <th class="text-center">Quantity On Hand</th>
            @php($total_out=0)
            @php($total_in=0)
            @foreach($sales as $sale)
            <tr>
                <td>{{ "sale" }}</td>
                <td>{{ $sale->invoice_date }}</td>
                <td>{{ '-' }}</td>
                <td>{{ $sale->quantity }}</td>
                <td>{{ '-'.$sale->quantity }}</td>
            </tr>

                @php($total_out=$total_out+$sale->quantity)
            @endforeach
            @foreach($purchases as $purchase)
            <tr>
                <td>{{ "purchase" }}</td>
                <td>{{ $purchase->invoice_date }}</td>
                <td>{{ $purchase->quantity }}</td>
                <td>{{ '-' }}</td>
                <td>{{ $purchase->quantity }}</td>
            </tr>
                @php($total_in=$total_in+$purchase->quantity)
            @endforeach
            <tr>
                <td></td>
                <th class="text-center">Total</th>
                <th class="text-center">{{ $total_in  }}</th>
                <th class="text-center">{{ $total_out }}</th>
                <th class="text-center">{{ $total_in-$total_out }}</th>
            </tr>
        </table>
    </div>

    <script>
        function openPage(pageName,elmnt,color) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = '';
                tablinks[i].style.color = "";
                tablinks[i].style.borderTop = '';
                tablinks[i].style.borderBottom = '1px solid gray';
                tablinks[i].style.borderLeft = '';
                tablinks[i].style.borderRight = '';

            }
            document.getElementById(pageName).style.display = "block";
            elmnt.style.backgroundColor = 'white';
            elmnt.style.color = 'blue';
            elmnt.style.borderTop = '3px solid #3c8dbc';
            elmnt.style.borderBottom = '0px';
            elmnt.style.borderLeft = '1px solid gray';
            elmnt.style.borderRight = '1px solid gray';
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>

@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#selector1").select2({
                placeholder: "Select a Name",
                allowClear: true
            });
            $("#selector2").select2({
                placeholder: "Select a Name",
                allowClear: true
            });
        })

    </script>
@endsection