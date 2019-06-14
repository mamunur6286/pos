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
    <a class="tablink text-center" onclick="openPage('Home', this, 'white')" id="defaultOpen">Home</a>
    <a class="tablink" onclick="" >News</a>
    <a class="tablink" onclick="">Contact</a>
    <a class="tablink" onclick="">About</a>



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


        {!! Form::open(['route'=>'items.store', 'files'=>true,'class'=>'form-horizontal ']) !!}

        <div class="form-group">
            {{Form::label('category', 'Select Category',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
            <div class="col-md-6 col-sm-6 col-xs-12">
                {{Form::select('category_id', $categories, null, array('class'=>'form-control','id'=>'selector1' ) )}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('unit', 'Unit',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
            <div class="col-md-6 col-sm-6 col-xs-12">
                {{Form::select('units', $units, null, array('class'=>'form-control','id'=>'selector2' ) )}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('name', 'Name',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
            <div class="col-md-6 col-sm-6 col-xs-12">
                {{Form::text('name', '', array('class'=>'form-control', 'placeholder'=>'Enter product name' ) )}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
            <div class="col-md-6 col-sm-6 col-xs-12">
                {{Form::text('description', '', array('class'=>'form-control', 'placeholder'=>'Enter description') )}}
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
                {{Form::text('comments', '', array('class'=>'form-control', 'placeholder'=>'Enter comments') )}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('', '',['class'=>' col-md-3 col-sm-3 col-xs-12'])}}
            <div class="col-md-6 col-sm-6 col-xs-12">
                {{Form::submit('Save', ['class'=>'btn btn-primary'])}}
            </div>
        </div>


        {!! Form::close() !!}
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
            elmnt.style.color = 'red';
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