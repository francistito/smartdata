@extends('layouts.main', ['title' => __("Upload data"), 'header' => __("Upload data")])

@push('after-styles')
    <style>
        .image-title-wrap {
            padding: 0 15px 15px 15px;
            color: #222;
        }

        #variable {
            background-color: red;
        }

        .input-file-container {
            position: relative;
            width: 225px;
        }
        .js .input-file-trigger {
            display: block;
            padding: 14px 45px;
            background: #39D2B4;
            color: #fff;
            font-size: 1em;
            transition: all .4s;
            cursor: pointer;
        }
        .js .input-file {
            position: absolute;
            top: 0; left: 0;
            width: 225px;
            opacity: 0;
            padding: 14px 0;
            cursor: pointer;
        }
        .js .input-file:hover + .input-file-trigger,
        .js .input-file:focus + .input-file-trigger,
        .js .input-file-trigger:hover,
        .js .input-file-trigger:focus {
            background: #34495E;
            color: #39D2B4;
        }

        .file-return {
            margin: 0;
        }
        .file-return:not(:empty) {
            margin: 1em 0;
        }
        .js .file-return {
            font-style: italic;
            font-size: .9em;
            font-weight: bold;
        }
        .js .file-return:not(:empty):before {
            content: "Selected file: ";
            font-style: normal;
            font-weight: normal;
        }

        h2 + P {
            text-align: center;
        }
        .txtcenter {
            margin-top: 4em;
            font-size: .9em;
            text-align: center;
            color: #aaa;
        }
        .copy {
            margin-top: 2em;
        }
        .copy a {
            text-decoration: none;
            color: #1ABC9C;
        }
    </style>

@endpush
@section('content')


    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">

                    {!! Form::open(['route' => 'data.store_uploaded_data', 'class' => '', 'novalidate','enctype'=>'multipart/form-data']) !!}
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="container mt-3">
                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <div class="input-file-container">
                                            <input name="contacts_file" class="input-file" id="fileUploader" type="file" onchange="document.getElementById('loadImg').style.display='inline';">
                                            <label  class="input-file-trigger">{!! trans('Select file') !!}</label>
                                            <p class="file-return" style="font-size: larger"></p>
                                        </div>
                                    </div>
                                </div>

                                <div id="json_file_data">

                                </div>

                                <input type="hidden" value="" name="json_data">
                                <div id="loadImg" style="margin-left:0px;margin-top: 0px;display: none">
                                    <div ><img src="{!! url("loadingGif.gif") !!}" width="150" style="margin-left: 300px" ></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12 offset-3">
                                    <div class="element-form">
                                        <div class="form-group pull-center">
                                            {!! Form::button(trans('Upload'), ['class' => 'btn btn-primary', 'type'=>'submit', 'style' => 'border-radius: 5px;']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mt-3">
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

@push('after-scripts')
    {!! Html::script(url("js/convertExcelToJSON/js/xlsx.full.min.js")) !!}

    <script>

        $('#form').submit(function() {
            $('#gif').css('visibility', 'visible');
            $('#gif').css('display', 'block');

        });



        function showLoading(){

            document.getElementById("loadImg").style = "visibility: visible";
        }
        function hideLoading(){
            document.getElementById("loadImg").style = "visibility: hidden";

        }



        $(document).ready(function () {
            $("#fileUploader").change(function (evt) {
                var selectedFile = evt.target.files[0];
                var reader = new FileReader();
                reader.onload = function (event) {
                    document.getElementById("loadImg").style = "display: none";
                    var data = event.target.result;
                    var workbook = XLSX.read(data, {type: 'binary'});

                    workbook.SheetNames.forEach(function (sheetName) {
                        var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                        var json_object = JSON.stringify(XL_row_object);

                        $("input[name='json_data']").val(json_object)

                        // $("#json_file_data").append(
                        //
                        //     '<input type="text" class="form-control document_title" name="json_dat" value="' + json_object + '" hidden>'
                        //     );

                    })
                };
                reader.onerror = function (event) {
                    console.error("File could not be read! Code " + event.target.error.code)
                };
                reader.readAsBinaryString(selectedFile)
            })
        })


        //script for input file
        document.querySelector("html").classList.add('js');
        var fileInput  = document.querySelector( ".input-file" ),
            button     = document.querySelector( ".input-file-trigger" ),
            the_return = document.querySelector(".file-return");

        button.addEventListener( "keydown", function( event ) {
            if ( event.keyCode == 13 || event.keyCode == 32 ) {
                fileInput.focus();
            }
        });
        button.addEventListener( "click", function( event ) {
            fileInput.focus();
            return false;
        });
        fileInput.addEventListener( "change", function( event ) {
            the_return.innerHTML = document.getElementById("fileUploader").files[0].name;;
        });





        $(document).ready(function() {
            $('#programmatic-multiple').select2({
                placeholder : 'Choose Contact'
            });

            // var sender_select = $("select[name='sender_id']")
            let contacts = $("#contacts");
            // let sendTo = $("#sendTo");
            let contacts_file = $("#contacts_file");
            let file = $(".fileupload-preview");
            $('body').find("form[name='upload_contacts']").submit( function (event) {
                event.preventDefault();
                $('body').find("#myModal").modal('hide');
                let url = $(this).attr('action');
                $.ajax({
                    type: "POST",
                    url: url,
                    data: new FormData(this),
                    enctype: 'multipart/form-data',
                    // dataType: 'json',
                    // contentType: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        contacts.hide();
                        // sendTo.prop("disabled", true);
                        contacts_file.show();
                        $("input[name='attachment']").val(data.attachment);
                        $("input[name='specific_name']").val(data.specific_name);
                        file.text(data.attachment);
                        // console.log(data)
                    },
                    error: function () {
                        alert("error")
                    }
                });
                $(this).refresh();
            });
        });

        let contacts = $("#contacts");
        function showSendTo() {
            $("#contacts_file").hide();
            contacts.show();
        }
    </script>

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
    {{--<script>--}}
    {{--$(document).ready(function() {--}}
    {{--$('.group').select2({--}}
    {{--placeholder : 'Choose Group'--}}
    {{--});--}}
    {{--});--}}
    {{--</script>--}}



@endpush
