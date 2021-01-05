@extends('V1.layouts.master')
<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard


* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com



=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->


@section('content')

    <!-- Sidenav -->
    @include('V1.partials.menu')
    <!-- Main content -->




    <div class="main-content" id="panel">
        <!-- Topnav -->
        @include('V1.partials.addRestrauntPopup')
        @include('V1.partials.editRestrauntPopup')
        @include('V1.partials.topnav')

        <div class="header bg-primary pb-6">

        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">رستوران ها</h3>
                                </div>
                                <div class="col text-right">
                                    <a id="addRestaurant" href="#!" class="btn btn-sm btn-primary">افزودن رستوران</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">نام</th>
                                    <th scope="col">آدرس</th>
                                    <th scope="col">شماره تلفن</th>
                                    <th scope="col">ویرایش</th>
                                    <th scope="col">حذف</th>
                                    <th scope="col">گالری</th>
                                </tr>
                                </thead>
                                <tbody>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
         </div>
        </div>
    </div>
@endsection

{{--Test Js --}}
@section('js')
    <script>


        let cookie = new Cookie();
        var token = cookie.getCookie('token') ;
        let ajax = new Ajax(token);
        let validation = new Validation();
        domainWithPort = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');



        // check cookie and token for get Information
        if(token == "")
        {
            window.location.href = domainWithPort+"/v1/auth/login";
        }else{
            if(!ajax.checkToken())
                cookie.logout()
        }

        $("#logout").click(function (){
            cookie.logout()
        })



        var add_form_popup_RestrauntValidation = {
                'form' : false ,
                'component' : {
                    'add-name-restaurant-Popup' : false ,
                    'add-address-restaurant-Popup' : false ,
                    'add-phone-restaurant-Popup' : false ,
                    'add-file1' : false ,
                    'add-file2' : false ,
                    'add-file3' : false ,
                }
            }


        var edit_form_popup_RestrauntValidation = {
            'form' : true ,
            'component' : {
                'edit-name-restaurant-Popup' : false ,
                'edit-address-restaurant-Popup' : false ,
                'edit-phone-restaurant-Popup' : false ,
            },'file' :{
                'edit-file1' : {
                    'exist' : false ,
                    'src' : null
                } ,
                'edit-file2' : {
                    'exist' : false ,
                    'src' : null
                } ,
                'edit-file3' : {
                    'exist' : false ,
                    'src' : null
                } ,
            }
        }





        // button add restraun
        $("#addRestaurant").click(function (){
            clearPopup('add');
            $(".add-restaurant-Popup").fadeIn(200)



            // for menu
            //$('.sidenav').css('transform', "translateX(-250px)")
            //$('.main-content').css('margin-left' , "0px")

        })


        // ------------------------------------------------



        // buttom close-add-restaurant
        $("#close-add-restaurant").click(function (){
            $(".add-restaurant-Popup").fadeOut(200)

            // for menu
            // $('.sidenav').css('transform' , "translateX(0px)")
            // $('.main-content').css('margin-left' , "255px")

        })

        // buttom close-edit-restaurant
        $("#close-edit-restaurant").click(function (){
            $(".edit-restaurant-Popup").fadeOut(200)

            // for menu
            // $('.sidenav').css('transform' , "translateX(0px)")
            // $('.main-content').css('margin-left' , "255px")

        })



        // ------------------------------------------------


        // button submit edit restraun
        $("#submit-edit-restaurant").click(function (){


            // validate popup Inputs
            $.each(edit_form_popup_RestrauntValidation.component, function(i, val) {

                var value = $('#'+i).val();
                var parentId = $('#'+i).parent().attr('id');


                if(value.length > 0 )
                {
                    edit_form_popup_RestrauntValidation.component[i] = true ;
                    $('#' + parentId + ' .alert').hide();
                    edit_form_popup_RestrauntValidation.form = true ;
                }else {
                    edit_form_popup_RestrauntValidation.component[i] = false ;
                    $('#' + parentId + ' .alert').show();
                    edit_form_popup_RestrauntValidation.form = false ;
                    return false;
                }

            });
            $.each(edit_form_popup_RestrauntValidation.file, function(i, val) {

                var value = $('#'+i).val();
                var parentId = $('#'+i).parent().attr('id');

                if(!value)
                {
                    // alert($('#'+parentId+' img').attr('src'))
                    edit_form_popup_RestrauntValidation.file[i].exist = false ;
                    edit_form_popup_RestrauntValidation.file[i].src = $('#'+parentId+' img').attr('src')
                }else{
                    edit_form_popup_RestrauntValidation.file[i].exist = true ;
                    edit_form_popup_RestrauntValidation.file[i].src = null ;
                }

            })


            console.log(edit_form_popup_RestrauntValidation)

            if (edit_form_popup_RestrauntValidation.form == true)
            {
                // send ajax ->


                var id = $('.edit-restaurant-Popup').attr('rowid');
                var name = $('#edit-name-restaurant-Popup').val();
                var address = $('#edit-address-restaurant-Popup').val();
                var phone = $('#edit-phone-restaurant-Popup').val();


                var img1 = $('#edit-img1').attr('src');
                var img2 = $('#edit-img2').attr('src');
                var img3 = $('#edit-img3').attr('src');

                var fd = new FormData();

                $.each(edit_form_popup_RestrauntValidation.file, function(i, val) {

                    var value = $('#'+i).val();
                    var parentId = $('#'+i).parent().attr('id');


                    if(edit_form_popup_RestrauntValidation.file[i].exist)
                    {
                        fd.append( i , $('#'+i)[0].files[0] );
                    }

                })



                /*$.ajax({
                    url: 'http://127.0.0.1:8000/api/v1/upload/image',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        console.log("response")
                        console.log(response)
                    },
                    error : function(e){
                        // console.log(e)
                    } ,
                });*/



                /*console.log({
                    id : id,
                    name : name ,
                    address : address ,
                    phone : phone ,
                    img1 : img1 ,
                    img2 : img2 ,
                    img3 : img3 ,
                })*/


                $(`tr#${id} .name`).html(name)
                $(`tr#${id} .phone`).html(phone)
                $(`tr#${id} .address`).html(address)

                $(`tr#${id} .row .img1`).attr('src' , img1)
                $(`tr#${id} .row .img2`).attr('src' , img2)
                $(`tr#${id} .row .img3`).attr('src' , img3)

                $(".edit-restaurant-Popup").fadeOut(200)
            }

        })

        // button submit insert restraun
        $("#submit-add-restaurant").click(function (){


            // validate submit popup add restraunt form
            // validate add restraunt add
            $.each(add_form_popup_RestrauntValidation.component, function(i, val) {


                    var value = $('#'+i).val();
                    var parentId = $('#'+i).parent().attr('id');


                    if( value.length > 0)
                    {
                        add_form_popup_RestrauntValidation.component[i] = true ;
                        $('#' + parentId + ' .alert').hide();
                        add_form_popup_RestrauntValidation.form = true
                    }else {
                        add_form_popup_RestrauntValidation.component[i] = false ;
                        $('#' + parentId + ' .alert').show();
                        add_form_popup_RestrauntValidation.form = false
                        return false;
                    }



            });
            // ---

            console.log(add_form_popup_RestrauntValidation);

           if(add_form_popup_RestrauntValidation.form == true)
           {
               var name = $('#add-name-restaurant-Popup').val();
               var address = $('#add-address-restaurant-Popup').val();
               var phone = $('#add-phone-restaurant-Popup').val();
               var img1 = $('#add-img1').attr('src');
               var img2 = $('#add-img2').attr('src');
               var img3 = $('#add-img3').attr('src');



               console.log({
                   name : name ,
                   address : address ,
                   phone : phone ,
                   img1 : img1 ,
                   img2 : img2 ,
                   img1 : img3 ,
               })

               var random = Math.floor((Math.random() * 100) + 1);


               $(".add-restaurant-Popup").fadeOut(200)
               $("tbody").append(
                   "<tr id='"+random+"'>" +
                   "<th class='name'>"+name+"</th>" +
                   "<th class='phone'>"+phone+"</th>" +
                   "<th class='address d-inline-block text-truncate' style='direction: rtl ; max-width: 220px'>"+address+"</th>" +
                   "<th onclick='editRow(this)'>ویرایش</th>" +
                   "<th onclick='deleteRow(this)'>حذف</th>" +
                   "<th>" +
                       "<div class='row'>" +
                           "<div class='col-md-4' > <img class='table_restraunt_photo img1' src='"+img1+"'> </div>" +
                           "<div class='col-md-4' > <img class='table_restraunt_photo img2' src='"+img2+"'> </div>" +
                           "<div class='col-md-4' > <img class='table_restraunt_photo img3' src='"+img3+"'> </div>" +
                       "</div>" +
                   "</th>"+
                   "</tr>");




               // for menu
               //$('.sidenav').css('transform' , "translateX(0px)")
           }


        })




        // validation add input
        $('#add-name-restaurant-Popup').on("change paste keyup", function() {
            var value = $(this).val();
            var parentId = $(this).parent().attr('id');


            if( value.length)
            {
                add_form_popup_RestrauntValidation.component["add-name-restaurant-Popup"] = true ;
                $('#' + parentId + ' .alert').hide();
            }else {
                add_form_popup_RestrauntValidation.component["add-name-restaurant-Popup"] = false ;
                $('#' + parentId + ' .alert').show();
            }
        });

        $('#add-address-restaurant-Popup').on("change paste keyup", function() {
            var value = $(this).val();
            var parentId = $(this).parent().attr('id');


            if( value.length)
            {
                add_form_popup_RestrauntValidation.component["add-address-restaurant-Popup"] = true ;
                $('#' + parentId + ' .alert').hide();
            }else {
                add_form_popup_RestrauntValidation.component["add-address-restaurant-Popup"] = false ;
                $('#' + parentId + ' .alert').show();
            }
        });

        $('#add-phone-restaurant-Popup').on("change paste keyup", function() {
            var value = $(this).val();
            var parentId = $(this).parent().attr('id');


            if( value.length)
            {
                add_form_popup_RestrauntValidation.component["add-phone-restaurant-Popup"] = true ;
                $('#' + parentId + ' .alert').hide();
            }else {
                add_form_popup_RestrauntValidation.component["add-phone-restaurant-Popup"] = false ;
                $('#' + parentId + ' .alert').show();
            }


        });



        // validation edit input
        $('#edit-name-restaurant-Popup').on("change paste keyup", function() {
            var value = $(this).val();
            var parentId = $(this).parent().attr('id');



            if( value.length)
            {
                edit_form_popup_RestrauntValidation.component["edit-name-restaurant-Popup"] = true ;
                $('#' + parentId + ' .alert').hide();
            }else {
                edit_form_popup_RestrauntValidation.component["edit-name-restaurant-Popup"] = false ;
                $('#' + parentId + ' .alert').show();
            }

            console.log( "edit name => "+ edit_form_popup_RestrauntValidation.component["edit-name-restaurant-Popup"])
        });

        $('#edit-address-restaurant-Popup').on("change paste keyup", function() {
            var value = $(this).val();
            var parentId = $(this).parent().attr('id');


            if( value.length)
            {
                edit_form_popup_RestrauntValidation.component["edit-address-restaurant-Popup"] = true ;
                $('#' + parentId + ' .alert').hide();
            }else {
                edit_form_popup_RestrauntValidation.component["edit-address-restaurant-Popup"] = false ;
                $('#' + parentId + ' .alert').show();
            }


            console.log( "edit address => "+ edit_form_popup_RestrauntValidation.component["edit-address-restaurant-Popup"])

        });

        $('#edit-phone-restaurant-Popup').on("change paste keyup", function() {
            var value = $(this).val();
            var parentId = $(this).parent().attr('id');


            if( value.length)
            {
                edit_form_popup_RestrauntValidation.component["edit-phone-restaurant-Popup"] = true ;
                $('#' + parentId + ' .alert').hide();
            }else {
                edit_form_popup_RestrauntValidation.component["edit-phone-restaurant-Popup"] = false ;
                $('#' + parentId + ' .alert').show();
            }

            console.log( "edit phone => "+ edit_form_popup_RestrauntValidation.component["edit-phone-restaurant-Popup"])


        });



        // add photo to popup
        $('#add-file1').change(function(){

            var isValidateExtention = validation.isValidAddRestrauntPhoto(this.value);

            if(isValidateExtention)
            {
                add_form_popup_RestrauntValidation.component["add-file1"] = true ;
                $("#add-firstFile-input .alert").hide();



                var fd = new FormData();
                var reader = new FileReader();

                var files1 = $('#add-file1')[0].files[0]
                fd.append('image1',files1);
                console.log(files1);

                reader.onload = function(e) {
                    $('#add-img1').attr('src', e.target.result);
                    $('#add-img1').css("display", 'block');
                }

                reader.readAsDataURL(files1);

            }else
            {
                add_form_popup_RestrauntValidation.component["add-file1"] = false ;
                $('#add-file1').val("");
                $('#add-img1').css("display", 'none');
                $("#add-firstFile-input .alert").show();

            }

        })

        $('#add-file2').change(function(){

            var isValidateExtention = validation.isValidAddRestrauntPhoto(this.value);

            if(isValidateExtention)
            {
                add_form_popup_RestrauntValidation.component["add-file2"] = true ;
                $("#add-secondFile-input .alert").hide();

                var fd = new FormData();
                var reader = new FileReader();

                var files2 = $('#add-file2')[0].files[0]
                fd.append('image2',files2);

                reader.onload = function(e) {
                    $('#add-img2').attr('src', e.target.result);
                    $('#add-img2').css("display", 'block');

                }

                reader.readAsDataURL(files2);

            }
            else
            {
                add_form_popup_RestrauntValidation.component["add-file2"] = false ;
                $('#add-file2').val("");
                $('#add-img2').css("display", 'none');
                $("#add-secondFile-input .alert").show();

            }


        })

        $('#add-file3').change(function(){

            var isValidateExtention = validation.isValidAddRestrauntPhoto(this.value);


            if(isValidateExtention)
            {
                add_form_popup_RestrauntValidation.component["add-file3"] = true ;
                $("#add-thirdFile-input .alert").hide();

                var fd = new FormData();
                var reader = new FileReader();

                var files3 = $('#add-file3')[0].files[0]
                fd.append('image3',files3);

                reader.onload = function(e) {
                    $('#add-img3').attr('src', e.target.result);
                    $('#add-img3').css("display", 'block');


                }

                reader.readAsDataURL(files3);

            }
            else
            {
                add_form_popup_RestrauntValidation.component["add-file3"] = false ;
                $('#add-file3').val("");
                $('#add-img3').css("display", 'none');
                $("#add-thirdFile-input .alert").show();


            }

        })




        // edit photo to popup
        $('#edit-file1').change(function(){

            var isValidateExtention = validation.isValidAddRestrauntPhoto(this.value);

            if(isValidateExtention)
            {
                $("#edit-firstFile-input .alert").hide();



                var fd = new FormData();
                var reader = new FileReader();

                var files1 = $('#edit-file1')[0].files[0]
                fd.append('image1',files1);
                console.log(files1);

                reader.onload = function(e) {
                    $('#edit-img1').attr('src', e.target.result);
                    $('#edit-img1').css("display", 'block');
                }

                reader.readAsDataURL(files1);

            }else
            {
                $('#edit-file1').val("");
                $('#edit-img1').css("display", 'none');
                $("#edit-firstFile-input .alert").show();

            }

        })

        $('#edit-file2').change(function(){

            var isValidateExtention = validation.isValidAddRestrauntPhoto(this.value);

            if(isValidateExtention)
            {
                $("#edit-secondFile-input .alert").hide();



                var fd = new FormData();
                var reader = new FileReader();

                var files1 = $('#edit-file2')[0].files[0]
                fd.append('image1',files1);
                console.log(files1);

                reader.onload = function(e) {
                    $('#edit-img2').attr('src', e.target.result);
                    $('#edit-img2').css("display", 'block');
                }

                reader.readAsDataURL(files1);

            }else
            {
                $('#edit-file2').val("");
                $('#edit-img2').css("display", 'none');
                $("#edit-secondFile-input .alert").show();

            }

        })

        $('#edit-file3').change(function(){

            var isValidateExtention = validation.isValidAddRestrauntPhoto(this.value);

            if(isValidateExtention)
            {
                $("#edit-thirdFile-input .alert").hide();



                var fd = new FormData();
                var reader = new FileReader();

                var files1 = $('#edit-file3')[0].files[0]
                fd.append('image1',files1);
                console.log(files1);

                reader.onload = function(e) {
                    $('#edit-img3').attr('src', e.target.result);
                    $('#edit-img3').css("display", 'block');
                }

                reader.readAsDataURL(files1);

            }else
            {
                $('#edit-file3').val("");
                $('#edit-img3').css("display", 'none');
                $("#edit-thirdFile-input .alert").show();

            }

        })





        function deleteRow(e)
        {

            var tr = $(e).closest('tr');
            var trId = tr.attr('id');


            $(`tr#${trId}`).remove();
            alert(trId)
        }

        function editRow(e)
        {
            clearPopup('edit');


            var tr = $(e).closest('tr');
            var trId = $(e).closest('tr').attr('id');
            var phone = tr.find('.phone').text();
            var name = tr.find('.name').text();
            var address = tr.find('.address').text();



             var img1 = tr.find('.row .img1').attr('src');
             var img2 = tr.find('.row .img2').attr('src');
             var img3 = tr.find('.row .img3').attr('src');




            $('#edit-name-restaurant-Popup').val(name)
            $('#edit-address-restaurant-Popup').val(address)
            $('#edit-phone-restaurant-Popup').val(phone)
            $('.edit-restaurant-Popup').attr('rowId', trId);


            $('#edit-img1').attr('src', img1).show();
            $('#edit-img2').attr('src', img2).show();
            $('#edit-img3').attr('src', img3).show();


            $(".edit-restaurant-Popup").fadeIn(200)


            //alert("open edit Page")
            // return trId;
        }

        function clearPopup(type)
        {

            // type = add or edit

            $('#'+type+'-name-restaurant-Popup').val('') ;
            $('#'+type+'-address-restaurant-Popup').val('') ;
            $('#'+type+'-phone-restaurant-Popup').val('') ;

            $('#'+type+'-file1').val(null) ;
            $('#'+type+'-file2').val(null) ;
            $('#'+type+'-file3').val(null) ;

            $('#'+type+'-img1').hide();
            $('#'+type+'-img2').hide();
            $('#'+type+'-img3').hide();

            $('.alert').hide();


        }







    </script>
@endsection

@section('css')

<style>
.table_restraunt_photo {
    width: 35px; height: 35px ; margin-top: 4px ;
{

</style>

@endsection
