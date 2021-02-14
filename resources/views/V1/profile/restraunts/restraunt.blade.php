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
    <style>
        th , tr{
            font-size: 13px !important;
        }

        th , tr , .card , .collapse  , .navbar-collapse{
            font-family: 'BYekan' !important;
        }

        .editRow > img , .deleteRow > img{
            cursor: pointer;
        }

        #autocomplete-list{
            margin-right: 0px !important;
        }
        #autocomplete-list > div{
            text-align: center;
            margin-left: 6px;
            padding: 2px;
            border: 6px;
            border-style: solid;
            border-width: 2px;
            border-color: #172b4d;
            border-radius: 12px;
            margin-top: 9px;
            font-size: 19px;
            cursor: pointer;
            font-family: 'BYekan';
        }

    </style>
    <!-- Sidenav -->
    @include('V1.partials.menu')
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        @include('V1.partials.topnav')
        @include('V1.partials.popups.restrauntOperationPopup')


        <div class="header bg-primary pb-6" >

        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header border-0">

                            <div id="card-header-Alerts" style="text-align:center">
                            </div>


                            <div class="row align-items-center">

                                <div class="col">
                                    <h3 style="text-align: right;" class="mb-0">رستوران ها</h3>
                                </div>
                                <div class="col text-right" >
                                    <a href="" class="btn btn-sm btn-primary" onclick="collapsePopup(true , 'افزودن رستوران' , 'add')" >افزودن رستوران</a>
                                </div>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table style="text-align: center ; font-family: 'behdad'; " id="category_table" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">حذف</th>
                                    <th scope="col">ویرایش</th>
                                    <th scope="col">گالری</th>
                                    <th scope="col">مدیر</th>
                                    <th scope="col">تلفن</th>
                                    <th scope="col">آدرس</th>
                                    <th scope="col">نام</th>
                                    <th scope="col">کد</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <nav style="font-family: 'BYekan'" aria-label="...">
                        <ul class="pagination justify-content-center">

                        </ul>
                    </nav>
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
        var paginationBatchNumber = 10;

        domainWithPort = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');



        // check cookie and token for get Information
        if(token == "")
            window.location.href = domainWithPort+"/v1/auth/login";
        else
        {
            if(!ajax.checkToken())
                cookie.logout()
        }

        $('#profileName').text(cookie.getCookie('phone'))

        $("#logout").click(function (){
            cookie.logout()
        })


        let routs = {
            getRestrauntTable :  domainWithPort +'/api/v1/restraunt/getrestraunttable/',
            getUserTable :  domainWithPort +'/api/v1/user/getusers',
        }


        getRestrauntTable(paginationBatchNumber)


        getTables('usersCanBeRestrauntAdmin' , routs.getUserTable )

        var getUsersTable = cookie.getObjectLocalStorage('usersCanBeRestrauntAdmin')

        autocomplete( document.getElementById('restraunt-admin').querySelector("input") , getUsersTable )



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


        //--------------------------------------------------------------------------------------------------------------

        // add photo to popup
        $('#restraunt-photo1').find("input").change(function(){

            var isValidateExtention = validation.isValidAddRestrauntPhoto(this.value);
            var parent_div = $(this).parent() ;
            var img = parent_div.find("img") ;

            console.log(parent_div.find("img"))
            if(isValidateExtention)
            {

                $("#add-secondFile-input .alert").hide();

                var fd = new FormData();
                var reader = new FileReader();

                var files = $(this)[0].files[0]
                // fd.append('image2' , files);

                reader.onload = function(e) {
                    $(img).attr('src', e.target.result);
                    $(img).css("display", 'block');

                }
                reader.readAsDataURL(files);
            }
            else
            {
                add_form_popup_RestrauntValidation.component["add-file2"] = false ;
                $(this).val("");
                $(img).css("display", 'none');
                $("#add-secondFile-input .alert").show();
            }

        })

        $('#restraunt-photo2').find("input").change(function(){

            var isValidateExtention = validation.isValidAddRestrauntPhoto(this.value);
            var parent_div = $(this).parent() ;
            var img = parent_div.find("img") ;

            console.log(parent_div.find("img"))
            if(isValidateExtention)
            {

                $("#add-secondFile-input .alert").hide();

                var fd = new FormData();
                var reader = new FileReader();

                var files = $(this)[0].files[0]
                // fd.append('image2' , files);

                reader.onload = function(e) {
                    $(img).attr('src', e.target.result);
                    $(img).css("display", 'block');

                }
                reader.readAsDataURL(files);
            }
            else
            {
                add_form_popup_RestrauntValidation.component["add-file2"] = false ;
                $(this).val("");
                $(img).css("display", 'none');
                $("#add-secondFile-input .alert").show();
            }

        })

        $('#restraunt-photo3').find("input").change(function(){

            var isValidateExtention = validation.isValidAddRestrauntPhoto(this.value);
            var parent_div = $(this).parent() ;
            var img = parent_div.find("img") ;

            console.log(parent_div.find("img"))
            if(isValidateExtention)
            {

                $("#add-secondFile-input .alert").hide();

                var fd = new FormData();
                var reader = new FileReader();

                var files = $(this)[0].files[0]
                // fd.append('image2' , files);

                reader.onload = function(e) {
                    $(img).attr('src', e.target.result);
                    $(img).css("display", 'block');

                }
                reader.readAsDataURL(files);
            }
            else
            {
                add_form_popup_RestrauntValidation.component["add-file2"] = false ;
                $(this).val("");
                $(img).css("display", 'none');
                $("#add-secondFile-input .alert").show();
            }

        })



        function collapsePopup(status , title , submitfunction)
        {
            if (status)
            {
                clearInputPopup()
                changeTitlePopup(title)
                changeSubmitOnclick(submitfunction)
                $(".container-popup").css('display' , 'block')

            }
            else
                $(".container-popup").css('display' , 'none')
        }

        function clearInputPopup()
        {
            $('#restraunt-code > input').val('');
            $('#restraunt-name > input').val('');
            $('#restraunt-address > input').val('');
            $('#restraunt-phone > input').val('');
            $('#restraunt-admin > input').val('');


            $('#restraunt-admin > input').removeAttr("adminid");

            $('#restraunt-photo1 > input').val(null) ;
            $('#restraunt-photo2 > input').val(null) ;
            $('#restraunt-photo3 > input').val(null) ;


            $('#restraunt-photo1 > img').hide();
            $('#restraunt-photo2 > img').hide();
            $('#restraunt-photo3 > img').hide();

        }

        function changeTitlePopup(title)
        {
            $('#title-popup').text(title)
        }

        function changeSubmitOnclick(status)
        {
            // edit or add
            $("#submit-popup").attr("onclick","submitPopup('"+status+"')");
        }

        function submitPopup(status)
        {
            if (status == 'add')
                submitAddProductPopup()
            else if (status == 'edit')
                submitEditProductPopup()
        }

        function submitAddProductPopup()
        {

            clearErrorsInPopup()

            var restraunt_code_div    = $("#restraunt-code")    ;
            var restraunt_name_div    = $("#restraunt-name")    ;
            var restraunt_address_div = $("#restraunt-address") ;
            var restraunt_phone_div   = $("#restraunt-phone")   ;
            var restraunt_admin_div   = $("#restraunt-admin")   ;
            var restraunt_photo1_div  = $("#restraunt-photo1")  ;
            var restraunt_photo2_div  = $("#restraunt-photo2")  ;
            var restraunt_photo3_div  = $("#restraunt-photo3")  ;



            var restraunt_code_value     =  restraunt_code_div.find("input").val()     ;
            var restraunt_name_value     =  restraunt_name_div.find("input").val()     ;
            var restraunt_address_value  =  restraunt_address_div.find("input").val()  ;
            var restraunt_phone_value    =  restraunt_phone_div.find("input").val()    ;
            var restraunt_admin_value    =  restraunt_admin_div.find("input").val()    ;
            var restraunt_admin_id    =  restraunt_admin_div.find("input").attr('id');


            var restraunt_image1_value   =  restraunt_photo1_div.find("input").val()   ;
            var restraunt_image2_value   =  restraunt_photo2_div.find("input").val()   ;
            var restraunt_image3_value   =  restraunt_photo3_div.find("input").val()   ;



            var addRestrauntValidation = validation.isValidAddRestraunt(
                restraunt_code_value, restraunt_name_value ,
                restraunt_address_value , restraunt_phone_value ,
                restraunt_admin_value , restraunt_image1_value ,
                restraunt_image2_value , restraunt_image3_value
            )


            if(addRestrauntValidation.valid)
            {


                var fd = new FormData();

                var photo1 = $(restraunt_photo1_div.find("input"))[0].files[0];
                var photo2 = $(restraunt_photo2_div.find("input"))[0].files[0];
                var photo3 = $(restraunt_photo3_div.find("input"))[0].files[0];

                fd.append('photo1',photo1);
                fd.append('photo2',photo2);
                fd.append('photo3',photo3);


                fd.append('code',    restraunt_code_value );
                fd.append('name',    restraunt_name_value );
                fd.append('address', restraunt_address_value );
                fd.append('phone',   restraunt_phone_value );
                fd.append('adminid',   restraunt_admin_id );


                $.ajax({
                    type: 'POST',
                    headers: { "Authorization": 'Bearer '+ token } ,
                    url: 'http://127.0.0.1:8000/api/v1/restraunt/addrestraunt',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(resp){
                        console.log(resp)

                        addRestraunt(resp.data.id , resp.data.code , resp.data.name , resp.data.address ,  resp.data.phone , restraunt_name_value  , resp.data.adminid)
                        collapsePopup(false)
                        AddCardHeaderAlerts( 'alert-success' , ' رستوران '+restraunt_name_value+' با موفقیت افزوده شد ' , 3000);

                    },
                    error: function (error){

                        for ( var key in error.responseJSON.errors )
                        {
                            addErrorToPopup(error.responseJSON.errors[key][0])
                        }

                    }
                });



            }
            else
            {
                for (var key in addRestrauntValidation.error)
                {
                    addErrorToPopup(addRestrauntValidation.error[key])
                }
            }

            /*
                        var addProdcutIsValid = validation.isValidAddProduct(
                            product_code_value, product_name_value ,
                            product_type_id , product_type_Value ,
                            product_mainGroup_id , product_mainGroup_Value ,
                            product_subGroup_id , product_subGroup_Value
                        )

                        data ={
                            name :product_name_value ,
                            code :product_code_value ,
                            type :product_type_id ,
                            subgroup :product_subGroup_id ,
                            maingroup :product_mainGroup_id ,
                        } ;

                        console.log(data);

                        if(addProdcutIsValid.valid)
                        {

                            $.ajax({
                                type: 'POST',
                                headers: { "Authorization": 'Bearer '+ token } ,
                                url: routs.addProduct,
                                contentType: "application/json",
                                type: 'POST',
                                dataType: "json",
                                data: JSON.stringify(data),
                                success: function (resp) {
                                    console.log(resp)

                                    addProduct(
                                        resp.data.id , resp.data.code , resp.data.name ,
                                        product_type_Value , product_mainGroup_Value , product_subGroup_Value ,
                                        resp.data.typeid , resp.data.maingroupid , resp.data.subgroupid
                                    )


                                    collapsePopup(false)
                                    AddCardHeaderAlerts( 'alert-success' , ' گروه '+resp.data.name+' با موفقیت افزوده شد ' , 3000)
                                },
                                error: function (error) {

                                    for ( var key in error.responseJSON.errors )
                                    {
                                        addErrorToPopup(error.responseJSON.errors[key][0])
                                    }

                                },
                            });


                        }else {
                            for (var key in addProdcutIsValid.error)
                            {
                                addErrorToPopup(addProdcutIsValid.error[key])
                            }
                        }*/


        }



        function clearErrorsInPopup()
        {
            $('#error div').each(
                function(element) { this.remove(); }
            );
        }

        function addErrorToPopup(message)
        {
            $("#error").append("<div class='alert alert-danger' style='display: block'>"+message+"</div>")
        }

        function addRestraunt(id  , code , name ,address , phone , adminName , adminId )
        {


            var editIconeURL = 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/64/Edit_icon_%28the_Noun_Project_30184%29.svg/1024px-Edit_icon_%28the_Noun_Project_30184%29.svg.png';
            var trushIconeURL = 'data:image/png;base64,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';

            $("tbody").append(
                "<tr id='"+id+"'>" +
                "<th onclick='deleteRow(this)'><img onclick='deleteRow(this)' style='width: 1.375rem;' src='"+trushIconeURL+"'> </th>" +
                "<th onclick='editRow(this)'><img onclick='editRow(this)' style='width: 1.375rem;' src='"+editIconeURL+"'> </th>" +
                "<th class='gallery'>...</th>" +
                "<th class='admin' adminid='"+adminId+"'>"+adminName+"</th>" +
                "<th class='phone'>"+phone+"</th>" +
                "<th class='address'>"+address+"</th>" +
                "<th class='name'>"+name+"</th>" +
                "<th class='code'>"+code+"</th>" +
                "</tr>")

        }

        function AddCardHeaderAlerts( AlertClass  ,  message , time )
        {
            let Randomkey = Math.random().toString(36).substring(7);

            $('#card-header-Alerts').append(
                '<div id="'+Randomkey+'" class="alert '+AlertClass+'">' +
                ''+message+''+
                '<button style="float: left;" type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>' +

                '</div>' +
                '')


            $("#"+Randomkey).delay(time).fadeOut(800);

        }

        function getTables( name , url )
        {

            $.ajax({
                async : true ,
                headers: { "Authorization": 'Bearer '+ token } ,
                url: url ,
                contentType: "application/json" ,
                type: 'GET' ,
                dataType: "json",
                success: function (resp) {
                    console.log(resp.data);
                    cookie.setObjectLocalStorage(name, resp.data)
                },
                error: function (error) {
                     console.log(error);

                },
            });
        }

        function autocomplete(inp, arr) {

            const isEmpty = str => !str.trim().length;

            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function(e) {

                if (isEmpty(this.value))
                {
                    this.removeAttribute("id");
                    this.removeAttribute("code");
                }

                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) { return false;}
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items row");

                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/




                let matches = Object.entries(arr).filter(([key, value]) => value.phone.includes("1"))
                    .reduce((acc, [k, v]) =>({...acc, [k]: v}), {})

                console.log(matches[0])
                for (var w in matches)
                {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = "<strong>" + matches[w]['phone'].substr(0, val.length) + "</strong>";
                    b.innerHTML += matches[w]['phone'].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' id='" + matches[w]['id'] + "' value='" + matches[w]['phone'] + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/

                    b.addEventListener("click", function(e) {

                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        inp.id = this.getElementsByTagName("input")[0].id;
                        inp.setAttribute("code", this.getElementsByTagName("input")[0].getAttribute("code"));
                        /*close the list of autocompleted values,
                         (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
                //
                /*for (var w in arr) {

                    //alert(arr[w]['name']);
                    /!*check if the item starts with the same letters as the text field value:*!/
                    if (arr[w]['name'].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /!*create a DIV element for each matching element:*!/
                        b = document.createElement("DIV");
                        /!*make the matching letters bold:*!/
                        b.innerHTML = "<strong>" + arr[w]['name'].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[w]['name'].substr(val.length);
                        /!*insert a input field that will hold the current array item's value:*!/
                        b.innerHTML += "<input type='hidden' id='" + arr[w]['id'] + "' value='" + arr[w]['name'] + "' code='" + arr[w]['code'] + "'>";
                        /!*execute a function when someone clicks on the item value (DIV element):*!/
                        b.addEventListener("click", function(e) {

                            /!*insert the value for the autocomplete text field:*!/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            inp.id = this.getElementsByTagName("input")[0].id;
                            inp.setAttribute("code", this.getElementsByTagName("input")[0].getAttribute("code"));

                            /!*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*!/
                            closeAllLists();
                        });

                        a.appendChild(b);

                    }
                }*/

            });

            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                    }
                }
            });


            function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }


            function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }


            function closeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }

            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function (e) {
                closeAllLists(e.target);
            });

        }


        function getRestrauntTable(paginationBatchNumber)
        {

            $.ajax({
                headers: { "Authorization": 'Bearer '+ token } ,
                url: routs.getRestrauntTable + paginationBatchNumber ,
                contentType: "application/json" ,
                type: 'GET' ,
                dataType: "json",
                success: function (resp) {
                    console.log(resp.data);
                    for ( var key in resp.data.data )
                    {
                        var Restraunts = resp.data.data[key]

                        addRestraunt(
                            Restraunts.id , Restraunts.code , Restraunts.name ,
                            Restraunts.address , Restraunts.phone,
                            Restraunts.adminName , Restraunts.adminid
                        );

                    }

                    AddPagination( resp.data )

                },
                error: function (error) {
                    // console.log(resp);
                },
            });
        }

        function AddPagination( paginationInfo )
        {
            console.log( paginationInfo )
            var next_page_url =  paginationInfo['next_page_url'];
            var prev_page_url =  paginationInfo['prev_page_url'];
            var current_page =  paginationInfo['current_page'];
            var total = paginationInfo.total ;
            var per_page = paginationInfo['per_page'] ;
            var path = paginationInfo.path ;
            var pagesNumbers = Math.ceil(total / per_page)



            $('.pagination').append('<li onclick="paginationItemClick(this)" class="page-item" Url="'+prev_page_url+'"> <a class="page-link" href="#" tabindex="-1">قبل</a> </li>')
            for (var i = 1 ; i <= pagesNumbers ; i++ )
            {
                var pageActive ;

                if (i == current_page )
                    pageActive = 'active' ;
                else
                    pageActive = '' ;

                $('.pagination').append('<li onclick="paginationItemClick(this)" class="page-item ' + pageActive + '" url = "'+path+'?page='+i+'"><a class="page-link" href="#">' + i + '</a></li>')
            }
            $('.pagination').append('<li onclick="paginationItemClick(this)" class="page-item" Url="'+next_page_url+'"> <a class="page-link" href="#" tabindex="-1">بعد</a> </li>')


        }

        function paginationItemClick(e)
        {
            var url = $(e).attr('url');

            if (url != 'null')
            {

                $.ajax({
                    headers: { "Authorization": 'Bearer '+ token } ,
                    url: url ,
                    contentType: "application/json" ,
                    type: 'GET' ,
                    dataType: "json",
                    success: function (resp) {
                        console.log(resp.data);
                        emptyTable("category_table tbody");

                        for ( var key in resp.data.data )
                        {
                            var restraunt = resp.data.data[key]
                            addRestraunt(
                                restraunt.id , restraunt.code ,
                                restraunt.name , restraunt.address ,
                                restraunt.phone , restraunt.adminName
                                , restraunt.adminid
                            )

                        }

                        clearPagination()
                        AddPagination( resp.data )

                    },
                    error: function (error) {
                        // console.log(resp);
                    },
                });

            }

        }

        function clearPagination()
        {
            $('.pagination').empty();
        }

        function emptyTable(id)
        {
            $('#'+ id).empty();
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
