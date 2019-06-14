@extends('layouts.master')
@section('title', 'purchase create form')
@section('content-head', 'Create purchase')

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
    {!! Form::open(['route'=>'purchases.store', 'files'=>true,'class'=>'form-horizontal ']) !!}
    <table  class="table table-responsive mt-2 bordered-0 " >
        <tr>
            <td>
                {{Form::select('supplier_id', $suppliers, null, array('class'=>'form-control supplier_id','id'=>'selector3' ) )}}
            </td>
            <td>
                {{Form::text('purchase_date', '', array('class'=>'form-control item_price','id'=>'datepicker','readonly','placeholder'=>'yyyy-mm-dd' ) )}}

            </td>
            <td>
                {{Form::text('purchase_no', $purchase_no, array('class'=>'form-control item_price' ) )}}
            </td>
        </tr>
        <tr>
            <td>
                <select name="item_id" class="form-control selector3" id="add">
                    <option value=""> Select One</option>
                    @foreach($products as $key=>$value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </td>
            <td></td>
            <td></td>
        </tr>
    </table>
<br>
    <table  class="table table-responsive table-striped mt-2 table-bordered" >
        <thead >
        <th class="text-center">Product Name</th>
        <th class="text-center">Quantity</th>
        <th class="text-center">Price</th>
        <th class="text-center">Discound</th>
        <th class="text-center">Total Fees</th>
        <th  class="text-center"><a href="#" id="addCustom" class="btn btn-success">+</a></th>
        </thead>
        <tbody id="tablefield">

        </tbody>
        <tfoot>
        <tr>
            <td colspan="4" class="text-right"> Sub Total</td>
            <td class="text-center"><p id="sub_total" class="sub_total"></p></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="4" class="text-right">Total Discount</td>
            <td class="text-center"><p class="total_discount"></p></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="4" class="text-right"> Total</td>
            <td class="text-center"><p class="total"></p></td>
            <td></td>
        </tr>
        </tfoot>
    </table>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            {{ Form::submit('Save',['class'=>'form-control btn btn-success']) }}
        </div>
        <div class="col-md-4"></div>
    </div>
    {!! Form::close() !!}
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js">
</script>
<script>
    $('.remove').live('click',function(){

        var length = $('#tablefield tr').length;
        if(length == 1){
        }else {
            $(this).parent().parent().remove();
        }

    });
</script>

@section('invoice')

    <script type="text/javascript">
        $(document).ready(function(){
            $(".selector3").select2({
                placeholder: "Select a Name",
                allowClear: true
            });
            $("#selector4").select2({
                placeholder: "Select a Name",
                allowClear: true
            });
            $('#addCustom').click(function(){


                $('#tablefield').append('<tr >' +
                    '<td><input value="" class="form-control item_id" type="text" name="item_id[]"></td>' +
                    '<td><input value="1" class="form-control quantity" type="number" name="quantity[]"></td>' +
                    '<td><input value="" id="item_price" class="form-control item_price" type="text" name="price[]"></td>' +
                    '<td><input class="form-control discount" type="text" name="discount[]"></td>' +
                    '<td><input id="total_price" value="" class="form-control total_price" type="text" name="amount[]"></td>'+
                    '<td><a href="#"  class="btn btn-danger remove">X</a></td>'+
                    '</tr>');


            });

            $('#add').change(function(){

                var id= $(this).val();
                var url = "{{url('getPrice')}}";

                $('.item_id').each(function (i,e) {
                    var item_id =$(this).val()-0;
                    if(item_id==id){
                        var tr = $(this).parent().parent();
                         var j = tr.find('.quantity').val()-0;
                         var t_qnty = j +1;
                         tr.find('.quantity').val(t_qnty);

                        var quantity =tr.find('.quantity').val();
                        var item_price =tr.find('.item_price').val()-0;

                        var amount=item_price*quantity;
                        tr.find('.total_price').val(amount);
                        total();
                         onexit();
                    }
                });

                var tr=$('.quantity').parent().parent();

                $.ajax({
                    url: url,
                    method:"GET",
                    data:{id:id},
                    dataType:"json",
                    success:function(data) {

                        $('#tablefield').append('<tr >' +
                            '<td>'+data['name']+'<input value="'+ id +'" class="form-control item_id" type="hidden" name="item_id[]"></td>' +
                            '<td><input value="1" class="form-control quantity" type="number" name="quantity[]"></td>' +
                            '<td><input value="'+data['price']+'" id="item_price" class="form-control item_price" type="text" name="price[]"></td>' +
                            '<td><input class="form-control discount" type="text" name="discount[]"></td>' +
                            '<td><input id="total_price" value="'+data['price']+'" class="form-control total_price" type="text" name="amount[]"></td>'+
                            '<td><a href="#"  class="btn btn-danger remove">X</a></td>'+
                            '</tr>');
                        total();
                    }
                });


            });

            function multiProcuct() {
                var total=0;


                $('.sub_total').html(total);
                $('.total').html(total);
            }


            $('#tablefield').delegate('.quantity,.item_price,.item_id','keyup change',function () {

                var tr=$(this).parent().parent();
                var id= tr.find('.item_id').val();
                var url = "{{url('getPrice')}}";

                $.ajax({
                    url: url,
                    method:"GET",
                    data:{id:id},
                    dataType:"json",
                    success:function(data) {
                        tr.find('.item_price').val(data['price']);

                        var quantity =tr.find('.quantity').val();
                        var item_price =tr.find('.item_price').val();
                        var amount=item_price*quantity;
                        tr.find('.total_price').val(amount);
                        total();
                    }
                });
                var quantity =tr.find('.quantity').val();
                var item_price =tr.find('.item_price').val()-0;

                var amount=item_price*quantity;
                tr.find('.total_price').val(amount);
                total();

            });
            function total() {
                var total=0;
                $('.total_price').each(function (i,e) {
                    var amount =$(this).val()-0;
                    total =total+ amount;
                });

                $('.sub_total').html(total);
                $('.total').html(total);
            }


            $('#tablefield').delegate('.discount ,.quantity','keyup change',function () {
                var tr=$(this).parent().parent();
                var quantity =tr.find('.quantity').val();

                var total_discount=0;
                $('.discount').each(function (i,e) {

                    var discount =$(this).val()-0;
                    total_discount =total_discount+ (discount*quantity);
                });
                $('.total_discount').html(total_discount);

                var subtotal = $('#sub_total').text();

                $('.total').html(subtotal-total_discount);

            });




        });
    </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(document).ready(function() {
            $( "#datepicker" ).datepicker({
                yearRange:'1990:2018',
                changeYear:true,
                changeMonth:true,
                dateFormat: 'yy-mm-dd'
            });

        });
    </script>
@endsection