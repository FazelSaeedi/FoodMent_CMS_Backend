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
        @include('V1.partials.popups.MenuOperationPopup')

        <style>
            .deactive{
                display: none; !important;
            }
        </style>
        <div class="header bg-primary pb-6" >

        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">
            <div class="restrauntPopup row  ">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header border-0">

                            <div id="card-header-Alerts-restraunt" style="text-align:center">
                            </div>


                            <div class="row align-items-center">

                                <div class="col">
                                    <h3 style="text-align: right;" class="mb-0">رستوران ها</h3>
                                </div>
                                <div class="col text-right" >
                                    <a href="#!" class="btn btn-sm btn-primary  seeMenuButton deactive" onclick="collapsePage(true)" >مشاهده منو</a>
                                    <a href="#!" class="btn btn-sm btn-primary" onclick="collapsePopup('container-popup' , true , 'افزودن رستوران' , 'add')" >افزودن رستوران</a>
                                </div>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table style="text-align: center ; font-family: 'behdad'; " id="restraunt_table" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">انتخاب</th>
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

            <div class="menuPopup row deactive ">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header border-0">

                            <div id="card-header-Alerts-menu" style="text-align:center">
                            </div>


                            <div class="row align-items-center">

                                <div class="col">
                                    <h3 style="text-align: right;" class="mb-0">منو</h3>
                                </div>
                                <div class="col text-right" >
                                    <a href="#!" class="btn btn-sm btn-primary" onclick="collapsePage(false)" >بازگشت</a>
                                    <a href="#!" class="btn btn-sm btn-primary" onclick="collapsePopup('container-popup-menu' , true , 'افزودن محصول' , 'add')" >افزودن محصول </a>
                                    <a href="#!" class="btn btn-sm btn-primary" onclick="alert()" >درخواست ساخت منو جدید </a>

                                </div>


                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table style="text-align: center ; font-family: 'behdad'; " id="menu_table" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">انتخاب</th>
                                    <th scope="col">حذف</th>
                                    <th scope="col">ویرایش</th>
                                    <th scope="col">مواد تشکیل دهنده</th>
                                    <th scope="col">قیمت نهایی</th>
                                    <th scope="col">درصد تخفیف</th>
                                    <th scope="col">قیمت</th>
                                    <th scope="col">گروه فرعی</th>
                                    <th scope="col">گروه اصلی</th>
                                    <th scope="col">ماهیت</th>
                                    <th scope="col">نام</th>

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
            window.location.href = Rout(Router.web.v1.auth.login);
        else{
            $.ajax({
                type: 'POST',
                async : false ,
                headers: { "Authorization": 'Bearer '+this.token } ,
                url: Rout(Router.api.v1.user.getuserinfo) ,
                data: 'data to send',
                success: function (resp) {

                },
                error: function () {
                    cookie.logout()
                },
                statusCode: {
                    200: function (response) {
                        statusCode = 200 ;
                    },
                    401: function (response) {
                        statusCode = 401 ;
                    }
                }
            });
        }

        $('#profileName').text(cookie.getCookie('phone'))

        $("#logout").click(function (){
            cookie.logout()
        })


        let routs = {
            getUserTable :  domainWithPort +'/api/v1/user/getusers',

            getRestrauntTable :  domainWithPort +'/api/v1/restraunt/getrestraunttable/',
            getRestrauntphoto :  domainWithPort +'/images/{restrauntId}/banner/banner{bannernumber}.jpg',
            editRestraunt :  domainWithPort +'/api/v1/restraunt/editrestraunt',
            deleteRestraunt :  domainWithPort +'/api/v1/restraunt/deleterestraunt',
            addRestraunt  : domainWithPort + '/api/v1/restraunt/addrestraunt' ,

            getProductPhoto : domainWithPort + '/images/{restrauntId}/food/{ProductMenuId}/{bannernumber}.jpg' ,
            getProductName : domainWithPort + '/api/v1/product/getproductlist' ,

            getMenuRestraunt : domainWithPort + '/api/v1/menu/getmenutable/{restrauntid}/{paginationnumber}' ,
            addRestrauntMenu : domainWithPort + '/api/v1/menu/addmenuproduct' ,
            editMenuRestraunt : domainWithPort + '/api/v1/menu/editmenuproduct' ,
            deleteMenuProduct : domainWithPort + '/api/v1/menu/deletemenuproduct'
        }


        getRestrauntTable(paginationBatchNumber)


        getTables('usersCanBeRestrauntAdmin' , Rout(Router.api.v1.user.getUserTable) )

        var getUsersTable = {
        }


        // ------------------------------------------------------------------------------------------------

        getProductNameList('productsnameTabke' , Rout(Router.api.v1.product.getProductName));

        var getProductNameList = {

        }




        function deleteRow(e)
        {

            console.log('are')
            var tr = $(e).closest('tr');
            var trId = tr.attr('id');



            var data ={id : trId };

            $.ajax({
                type: 'POST',
                headers: { "Authorization": 'Bearer '+ token } ,
                url: Rout(Router.api.v1.restraunt.deleteRestraunt) ,
                contentType: "application/json",
                type: 'POST',
                dataType: "json",
                data: JSON.stringify(data),
                success: function (resp) {
                    console.log(resp)
                    AddCardHeaderAlerts( 'alert-success' , 'محصول شما با موفقیت حذف گردید' , 3000 , 'restraunt')
                    $(`tr#${trId}`).remove();
                },
                error: function (error) {
                    console.log(error)
                    for ( var key in error.responseJSON.errors )
                    {
                        AddCardHeaderAlerts( 'alert-danger' , error.responseJSON.errors[key] , 3000 , 'restraunt')
                    }
                },
            });
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


        $('#menuProduct-photo1').find("input").change(function(){

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
                //add_form_popup_RestrauntValidation.component["add-file2"] = false ;
                $(this).val("");
                $(img).css("display", 'none');
                $("#add-secondFile-input .alert").show();
            }

        })

        $('#menuProduct-photo2').find("input").change(function(){

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
                //add_form_popup_RestrauntValidation.component["add-file2"] = false ;
                $(this).val("");
                $(img).css("display", 'none');
                $("#add-secondFile-input .alert").show();
            }

        })

        $('#menuProduct-photo3').find("input").change(function(){

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
                //add_form_popup_RestrauntValidation.component["add-file2"] = false ;
                $(this).val("");
                $(img).css("display", 'none');
                $("#add-secondFile-input .alert").show();
            }

        })

        function collapsePopup( namePopup , status , title , submitfunction)
        {

            if (status)
            {
                clearInputPopup()
                changeTitlePopup(title)
                changeSubmitOnclick(submitfunction)
                changeSubmitOnclickMenu(submitfunction)
                $("."+namePopup).css('display' , 'block')
            }
            else
                $("."+namePopup).css('display' , 'none')
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


            //---

            $('#menuProduct-name > input').val('');
            $('#menuProduct-price > input').val('');
            $('#menuProduct-discount > input').val('');
            $('#menuProduct-makeups > input').val('');



            $('#menuProduct-photo1 > input').val(null) ;
            $('#menuProduct-photo2 > input').val(null) ;
            $('#menuProduct-photo3 > input').val(null) ;


            $('#menuProduct-photo1 > img').hide();
            $('#menuProduct-photo2 > img').hide();
            $('#menuProduct-photo3 > img').hide();

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
                submitAddRestrauntPopup()
            else if (status == 'edit')
                submitEditRestrauntPopup()
        }

        function submitAddRestrauntPopup()
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
                    url: Rout(Router.api.v1.restraunt.addRestraunt) ,
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(resp){
                        console.log(resp)

                        addRestraunt(resp.data.id , resp.data.code , resp.data.name , resp.data.address ,  resp.data.phone , restraunt_name_value  , resp.data.adminid)
                        collapsePopup( 'container-popup' , false)
                        AddCardHeaderAlerts( 'alert-success' , ' رستوران '+restraunt_name_value+' با موفقیت افزوده شد ' , 3000, 'restraunt');

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


        }

        function submitEditRestrauntPopup()
        {

            clearErrorsInPopup()

            var restraunt_code_div      =  $("#restraunt-code")
            var restraunt_name_div      =  $("#restraunt-name")
            var restraunt_id            =  $(".main-content-popup").attr('rowId');
            var restraunt_phone      =  $("#restraunt-phone")
            var restraunt_address_div =  $("#restraunt-address")
            var restraunt_admin_div  =  $("#restraunt-admin")

            var restraunt_photo1_div =   $("#restraunt-photo1")
            var restraunt_photo2_div =   $("#restraunt-photo2")
            var restraunt_photo3_div =   $("#restraunt-photo3")

            var restraunt_code_value = restraunt_code_div.find("input").val() ;
            var restraunt_name_value = restraunt_name_div.find("input").val() ;


            var restraunt_phone = restraunt_phone.find("input").val() ;
            var restraunt_address = restraunt_address_div.find("input").val() ;

            var restraunt_admin_Name =  restraunt_admin_div.find("input").val();
            var restraunt_admin_ID   =  restraunt_admin_div.find("input").attr('id');

            var restraunt_photo1 =    restraunt_photo1_div.find("input").val()   ;
            var restraunt_photo2 =    restraunt_photo2_div.find("input").val()   ;
            var restraunt_photo3 =    restraunt_photo3_div.find("input").val()   ;

            var restraunt_img1 =    restraunt_photo1_div.find("img").attr("src")   ;
            var restraunt_img2 =    restraunt_photo2_div.find("img").attr("src")   ;
            var restraunt_img3 =    restraunt_photo3_div.find("img").attr("src")   ;



            var editRestrauntValidation = validation.isValidEditRestraunt(
                restraunt_code_value, restraunt_name_value ,
                restraunt_address , restraunt_phone,
                restraunt_admin_Name ,
            )

            console.log(editRestrauntValidation);

           var data = {
                id : restraunt_id ,
                name:restraunt_name_value,
                code:restraunt_code_value,
                adminid : restraunt_admin_ID ,
                phone : restraunt_phone ,
                address : restraunt_address,
            };

            if(editRestrauntValidation.valid)
            {

                var fd = new FormData();

                var photo1 = $(restraunt_photo1_div.find("input"))[0].files[0];
                var photo2 = $(restraunt_photo2_div.find("input"))[0].files[0];
                var photo3 = $(restraunt_photo3_div.find("input"))[0].files[0];


                if (restraunt_photo1)
                    fd.append('photo1',photo1);
                else
                    fd.append('srcphoto1' , restraunt_img1)


                if (restraunt_photo2)
                    fd.append('photo2',photo2);
                else
                    fd.append('srcphoto2' , restraunt_img2)


                if (restraunt_photo3)
                    fd.append('photo3',photo3);
                else
                    fd.append('srcphoto3' , restraunt_img3)


                fd.append('code',    restraunt_code_value );
                fd.append('id',    restraunt_id );
                fd.append('name',    restraunt_name_value );
                fd.append('address', restraunt_address );
                fd.append('phone',   restraunt_phone );
                fd.append('adminid',   restraunt_admin_ID );

                $.ajax({
                    type: 'POST',
                    headers: { "Authorization": 'Bearer '+ token } ,
                    url: Rout(Router.api.v1.restraunt.editRestraunt),
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(resp){

                        console.log(resp)

                        editRestraunt(
                            resp.data.id , resp.data.code ,
                            resp.data.name , resp.data.address ,
                            resp.data.phone , restraunt_admin_Name  ,
                            resp.data.adminid
                        )


                        collapsePopup( 'container-popup', false)
                        AddCardHeaderAlerts( 'alert-success' , ' رستوران '+resp.data.name+' با موفقیت ویرایش شد ' , 3000 , 'restraunt')

                    },
                    error: function (error) {

                        console.log(error)

                        for ( var key in error.responseJSON.errors )
                        {
                            addErrorToPopup(error.responseJSON.errors[key])
                        }

                    },
                });


            }else {
                for (var key in editRestrauntValidation.error)
                {
                    addErrorToPopup(editRestrauntValidation.error[key])
                }
            }
        }

        function editRow(e)
        {


            var tr = $(e).closest('tr');
            var trId = $(e).closest('tr').attr('id');

            var code = tr.find('.code').text();
            var name = tr.find('.name').text();
            var address = tr.find('.address').text();
            var phone = tr.find('.phone').text();

            var adminName = tr.find('.admin').text();
            var adminId = tr.find('.admin').attr('adminid');



            collapsePopup( 'container-popup', true , 'ویرایش رستوران' , 'edit')


            $('#restraunt-code > input').val(code);
            $('#restraunt-name > input').val(name);

            $('#restraunt-address > input ' ).val(address);
            $('#restraunt-phone > input ' ).val(phone);
            $('#restraunt-admin > input ' ).val(adminName);


            $('#restraunt-admin > input ' ).attr('id' , adminId);


            $('#restraunt-photo1 > img').attr('src' , Rout(Router.api.v1.restraunt.getRestrauntphoto).replace('{restrauntId}' , trId).replace('{bannernumber}' , '1'))
            $('#restraunt-photo1 > img').show()

            $('#restraunt-photo2 > img').attr('src' , Rout(Router.api.v1.restraunt.getRestrauntphoto).replace('{restrauntId}' , trId).replace('{bannernumber}' , '2'))
            $('#restraunt-photo2 > img').show()


            $('#restraunt-photo3 > img').attr('src' , Rout(Router.api.v1.restraunt.getRestrauntphoto).replace('{restrauntId}' , trId).replace('{bannernumber}' , '3'))
            $('#restraunt-photo3 > img').show()


            $(".main-content-popup").attr("rowId",trId);

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

            $("#restraunt_table  > tbody").append(
                "<tr class='click' id='"+id+"'>" +
                "<th><input type='checkbox' value='checked'/></th>" +
                "<th><img onclick='deleteRow(this)' style='width: 1.375rem;' src='"+trushIconeURL+"'> </th>" +
                "<th><img onclick='editRow(this)' style='width: 1.375rem;' src='"+editIconeURL+"'> </th>" +
                "<th class='gallery'>...</th>" +
                "<th class='admin' adminid='"+adminId+"'>"+adminName+"</th>" +
                "<th class='phone'>"+phone+"</th>" +
                "<th class='address'>"+address+"</th>" +
                "<th class='name'>"+name+"</th>" +
                "<th class='code'>"+code+"</th>" +
                "</tr>")


        }

        function editRestraunt( rowId  , code , name ,address , phone , adminName , adminId )
        {

            var tr = $('#'+rowId)
            var codeth = tr.find('.code');
            var nameth = tr.find('.name');
            var addressth = tr.find('.address');
            var phoneth = tr.find('.phoneth');
            var adminth = tr.find('.adminth');



            codeth.text(code)
            nameth.text(name)

            addressth.text(address)
            phoneth.text(phone)
            adminth.text(adminName)

            adminth.attr("adminid",adminId);


        }

        function AddCardHeaderAlerts( AlertClass  ,  message , time  , state)
        {
            let Randomkey = Math.random().toString(36).substring(7);

            $('#card-header-Alerts-'+state).append(
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
                // async : true ,
                headers: { "Authorization": 'Bearer '+ token } ,
                url: url ,
                contentType: "application/json" ,
                type: 'GET' ,
                dataType: "json",
                success: function (resp) {
                    console.log(resp.data);
                    cookie.setObjectLocalStorage(name, resp.data)

                    getUsersTable = cookie.getObjectLocalStorage('usersCanBeRestrauntAdmin')
                    autocompleteGetUserTable( document.getElementById('restraunt-admin').querySelector("input") , getUsersTable )

                },
                error: function (error) {
                     console.log(error);

                },
            });
        }


        function getProductNameList(name , url)
        {
            $.ajax({
                // async : true ,
                headers: { "Authorization": 'Bearer '+ token } ,
                url: url ,
                contentType: "application/json" ,
                type: 'GET' ,
                dataType: "json",
                success: function (resp) {
                    console.log(resp.data);
                    cookie.setObjectLocalStorage(name, resp.data)

                    getProductNameList  = cookie.getObjectLocalStorage('productsnameTabke')
                    autocompleteGetProdctName( document.getElementById('menuProduct-name').querySelector("input") , getProductNameList )
                },
                error: function (error) {
                    console.log(error);

                },
            });
        }

        function autocompleteGetUserTable(inp, arr) {

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

        function autocompleteGetProdctName(inp, arr) {

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

                console.log(val)
                let matches = Object.entries(arr).filter(([key, value]) =>  value.name.includes(val))
                    .reduce((acc, [k, v]) =>({...acc, [k]: v}), {})


                for (var w in matches)
                {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = "<strong>" + matches[w]['name'].substr(0, val.length) + "</strong>";
                    b.innerHTML += matches[w]['name'].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' id='" + matches[w]['id'] + "' value='" + matches[w]['name'] + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/

                    b.addEventListener("click", function(e) {

                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        inp.id = this.getElementsByTagName("input")[0].id;
                        inp.setAttribute("id", this.getElementsByTagName("input")[0].getAttribute("id"));
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
                url:  Rout(Router.api.v1.restraunt.getRestrauntTable) + '/' + paginationBatchNumber ,
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
                        emptyTable("restraunt_table tbody");

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

    <script>

       var data = {
           menuPopup : false ,
           clickedTableid : null ,
           rowClickedInformation : {
               id : '' ,
               code : '' ,
               name : '' ,
               address : '' ,
               phone : '' ,
               admin : '' ,
           }
       }

       $("#restraunt_table").on("click", "tr", function(e){

           $('#'+data.clickedTableid).css('background-color' , '');
           $('#'+data.clickedTableid + '> th > input').prop('checked', false);


           if (data.clickedTableid == $(this).attr('id')) {
               $('#'+data.clickedTableid).css('background-color' , '');
               $('#'+data.clickedTableid + '> th > input').prop('checked', false);
               data.clickedTableid = null ;
               $('.seeMenuButton').addClass("deactive");


           }else{

               $(this).css('background' , '#ccc');
               data.clickedTableid = $(this).attr('id') ;
               $('#'+data.clickedTableid + '> th > input').prop('checked', true);
               $('.seeMenuButton').removeClass("deactive");

/*               data.rowClickedInformation.code = $('#'+data.clickedTableid + '> .code').text();
               data.rowClickedInformation.phone = $('#'+data.clickedTableid + '> .phone').text();
               data.rowClickedInformation.address = $('#'+data.clickedTableid + '> .address').text();
               data.rowClickedInformation.id = data.clickedTableid ;
               data.rowClickedInformation.admin = $('#'+data.clickedTableid + '> .admin').text();*/

               var row = {
                   'code' :  $('#'+data.clickedTableid + '> .code').text() ,
                   'phone' : $('#'+data.clickedTableid + '> .phone').text() ,
                   'address' : $('#'+data.clickedTableid + '> .address').text() ,
                   'id' : data.clickedTableid ,
                   'admin' : $('#'+data.clickedTableid + '> .admin').text() ,
                   'name' : $('#'+data.clickedTableid + '> .name').text()
               }
               data.rowClickedInformation = row ;
               console.log(data.rowClickedInformation)

           }

       });

       $('.seeMenuButton').click(function (){
           getRestrauntMenu(data.rowClickedInformation.id , 100);
           $('.main-content-popup').attr('restrauntid' , data.rowClickedInformation.id)
       });


       function collapsePage(status)
       {
           if (status == true)
           {
               $('.menuPopup').removeClass('deactive')
               $('.restrauntPopup').addClass('deactive')
           }else {
               $('.menuPopup').addClass('deactive')
               $('.restrauntPopup').removeClass('deactive')
           }

       }

       function addRestrauntMenu( id , productId , name ,type ,maingroup , subgroup  , price , discount , finalprice ,  makeup )
       {


           var editIconeURL = 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/64/Edit_icon_%28the_Noun_Project_30184%29.svg/1024px-Edit_icon_%28the_Noun_Project_30184%29.svg.png';
           var trushIconeURL = 'data:image/png;base64,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';

           $("#menu_table  > tbody").append(
               "<tr class='click' id='"+id+"'>" +
               "<th><input type='checkbox' value='checked'/></th>" +
               "<th><img onclick='deleteRowMenu(this)' style='width: 1.375rem;' src='"+trushIconeURL+"'> </th>" +
               "<th><img onclick='editRowMenu(this)' style='width: 1.375rem;' src='"+editIconeURL+"'> </th>" +
               "<th class='makeup' >"+makeup+"</th>" +
               "<th class='finalprice' >"+finalprice+"</th>" +
               "<th class='discount' >"+discount+"</th>" +
               "<th class='price' >"+price+"</th>" +
               "<th class='subgroup' >"+subgroup+"</th>" +
               "<th class='maingroup'>"+maingroup+"</th>" +
               "<th class='type'>"+type+"</th>" +
               "<th class='name' id='"+productId+"'>"+name+"</th>" +
               "</tr>")


       }

       function getRestrauntMenu(restrauntid , paginationnumber)
       {
           emptyTable('menu_table tbody')

           var menuURL = Rout(Router.api.v1.menu.getMenuRestraunt).replace('{restrauntid}' , restrauntid ).replace( '{paginationnumber}' , paginationnumber ) ;

           $.ajax({
               headers: { "Authorization": 'Bearer '+ token } ,
               url: menuURL ,
               contentType: "application/json" ,
               type: 'GET' ,
               dataType: "json",
               success: function (resp) {
                   // console.log(resp.data.data);

                   for ( var key in resp.data.data )
                   {
                       var MenuItem = resp.data.data[key]
                       var discount = MenuItem.menuprice-(( MenuItem.menuprice * MenuItem.menudiscount ) / 100)
                        console.log(MenuItem)
                       addRestrauntMenu(
                           MenuItem.menuid , MenuItem.productid , MenuItem.productname , MenuItem.typename ,
                           MenuItem.maingroupname , MenuItem.subgroupname,
                           MenuItem.menuprice , MenuItem.menudiscount ,
                           discount , MenuItem.menumakeup
                       );
                   }

                   // AddPagination( resp.data )
               },
               error: function (error) {
                   // console.log(resp);
               },
           });

       }

       function changeSubmitOnclickMenu(status)
       {
           // edit or add
           $("#submit-popup-menu").attr("onclick","submitPopupMenu('"+status+"')");
       }

       function submitPopupMenu(status)
       {

           if (status == 'add')
               submitAddMenuPopup()
           else if (status == 'edit')
               submitEditMenuPopup()
       }

       function submitAddMenuPopup()
       {
           $('#errorMenu div').each(
               function(element) { this.remove(); }
           );

           var menuProduct_name_div      =   $("#menuProduct-name")       ;
           var menuProduct_price_div     =   $("#menuProduct-price")      ;
           var menuProduct_discount_div  =   $("#menuProduct-discount")   ;
           var menuProduct_makeups_div   =   $("#menuProduct-makeups")    ;

           var menuProduct_photo1_div    =   $("#menuProduct-photo1")     ;
           var menuProduct_photo2_div    =   $("#menuProduct-photo2")     ;
           var menuProduct_photo3_div    =   $("#menuProduct-photo3")     ;

           var restrauntId = data.rowClickedInformation.id ;

           var menuProduct_name_value     =  menuProduct_name_div.find("input").val()     ;
           var menuProduct_id_value =   menuProduct_price_div.find("input").attr('id');
           var menuProduct_price_value  =  menuProduct_price_div.find("input").val()  ;
           var menuProduct_discount_value    =  menuProduct_discount_div.find("input").val()    ;
           var menuProduct_makeups_value    =  menuProduct_makeups_div.find("input").val()    ;




           var menuProduct_photo1_value   =  menuProduct_photo1_div.find("input").val()   ;
           var menuProduct_photo2_value   =  menuProduct_photo2_div.find("input").val()   ;
           var menuProduct_photo3_value   =  menuProduct_photo3_div.find("input").val()   ;


           var isValidMenuProduct = validation.isValidAddMenuProduct(
                                       menuProduct_name_value , menuProduct_price_value ,
                                       menuProduct_discount_value , menuProduct_makeups_value ,
                                       menuProduct_photo1_value ,menuProduct_photo2_value , menuProduct_photo3_value
                                   )



           if(isValidMenuProduct.valid) {


               var fd = new FormData();

               var photo1 = $(menuProduct_photo1_div.find("input"))[0].files[0];
               var photo2 = $(menuProduct_photo2_div.find("input"))[0].files[0];
               var photo3 = $(menuProduct_photo3_div.find("input"))[0].files[0];

               fd.append('photo1', photo1);
               fd.append('photo2', photo2);
               fd.append('photo3', photo3);


               fd.append('productid',$('#menuProduct-name').find("input").attr('id'));
               fd.append('restrauntid', data.rowClickedInformation.id);
               fd.append('price', menuProduct_price_value);
               fd.append('discount', menuProduct_discount_value);
               fd.append('makeups', menuProduct_makeups_value);



               $.ajax({
                   type: 'POST',
                   headers: { "Authorization": 'Bearer '+ token } ,
                   url: Rout(Router.api.v1.menu.addRestrauntMenu) ,
                   data: fd,
                   contentType: false,
                   processData: false,
                   success: function(resp){
                       console.log(resp.data[0])

                       var finalPrice = resp.data[0].price - ((resp.data[0].price * resp.data[0].discount)/100)

                       addRestrauntMenu(resp.data[0].id , resp.data[0].productid , resp.data[0].productname , resp.data[0].typename ,
                                           resp.data[0].maingroupname ,  resp.data[0].subgroupname ,
                                           resp.data[0].price ,resp.data[0].discount, finalPrice , resp.data[0].makeup
                       )


                       collapsePopup( 'container-popup-menu' , false)
                       AddCardHeaderAlerts( 'alert-success' , ' محصول '+ resp.data[0].productname +' با موفقیت افزوده شد ' , 3000 , 'menu');

                   },
                   error: function (error){
                        console.log(error)
                       for ( var key in error.responseJSON.errors )
                       {
                           var message = error.responseJSON.errors[key][0];
                           $("#errorMenu").append("<div class='alert alert-danger' style='display: block'>"+message+"</div>")
                       }

                   }
               });

           }else {
               for (var key in isValidMenuProduct.error)
               {
                    var message = isValidMenuProduct.error[key];
                    $("#errorMenu").append("<div class='alert alert-danger' style='display: block'>"+message+"</div>")

               }
           }
       }

       function submitEditMenuPopup()
       {
           $('#errorMenu div').each(
               function(element) { this.remove(); }
           );

           var menuProduct_name_div      =   $("#menuProduct-name")       ;
           var menuProduct_price_div     =   $("#menuProduct-price")      ;
           var menuProduct_discount_div  =   $("#menuProduct-discount")   ;
           var menuProduct_makeups_div   =   $("#menuProduct-makeups")    ;
           var menuProduct_photo1_div    =   $("#menuProduct-photo1")     ;
           var menuProduct_photo2_div    =   $("#menuProduct-photo2")     ;
           var menuProduct_photo3_div    =   $("#menuProduct-photo3")     ;

           var menuProduct_menuId            =  $(".main-content-popup").attr('rowid');
           var menuProduct_productId         =  menuProduct_name_div.find("input").attr('id')     ;
           var restrauntId                   =  $(".main-content-popup").attr('restrauntid')   ;
           var menuProduct_price_value       =  menuProduct_price_div.find("input").val()           ;
           var menuProduct_discount_value    =  menuProduct_discount_div.find("input").val()        ;
           var menuProduct_makeups_value     =  menuProduct_makeups_div.find("input").val()         ;

           var menuProduct_photo1 =    menuProduct_photo1_div.find("input").val()   ;
           var menuProduct_photo2 =    menuProduct_photo2_div.find("input").val()   ;
           var menuProduct_photo3 =    menuProduct_photo3_div.find("input").val()   ;



           var menuProduct_img1   =  $('#menuProduct-photo1 > img').attr("src")    ;
           var menuProduct_img2   =  $('#menuProduct-photo2 > img').attr("src")   ;
           var menuProduct_img3   =  $('#menuProduct-photo3 > img').attr("src")   ;


           var editMenuRestrauntValidation = validation.isValidEditMenu(menuProduct_price_value ,menuProduct_discount_value , menuProduct_makeups_value)

           console.log(editMenuRestrauntValidation);

           var data = {
               id : menuProduct_menuId ,
               productid:menuProduct_productId,
               restrauntid:restrauntId,
               price : menuProduct_price_value ,
               discount : menuProduct_discount_value ,
               makeups : menuProduct_makeups_value,
           };



            if(editMenuRestrauntValidation.valid)
            {
                var fd = new FormData();

                var photo1 = $(menuProduct_photo1_div.find("input"))[0].files[0];
                var photo2 = $(menuProduct_photo2_div.find("input"))[0].files[0];
                var photo3 = $(menuProduct_photo3_div.find("input"))[0].files[0];


                if (menuProduct_photo1)
                    fd.append('photo1',photo1);
                else
                    fd.append('srcphoto1' , menuProduct_img1)


                if (menuProduct_photo2)
                    fd.append('photo2',photo2);
                else
                    fd.append('srcphoto2' , menuProduct_img2)


                if (menuProduct_photo3)
                    fd.append('photo3',photo3);
                else
                    fd.append('srcphoto3' , menuProduct_img3)



                fd.append('id',    menuProduct_menuId );
                fd.append('productid',    menuProduct_productId );
                fd.append('restrauntid',    restrauntId );
                fd.append('price', menuProduct_price_value );
                fd.append('discount',   menuProduct_discount_value );
                fd.append('makeups',   menuProduct_makeups_value );

                $.ajax({
                    type: 'POST',
                    headers: { "Authorization": 'Bearer '+ token } ,
                    url: Rout(Router.api.v1.menu.editMenuRestraunt),
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(resp){

                        console.log(resp.data)
                        var response = resp
                        editMenuProductRow(
                            response.data.id ,response.data.productname , response.data.productid ,
                            response.data.typename ,response.data.maingroupname , response.data.subgroupname ,
                            response.data.price ,response.data.discount , response.data.finalprice ,
                            response.data.makeup
                        )
                        collapsePopup( 'container-popup-menu' , false)
                        AddCardHeaderAlerts( 'alert-success' , ' محصول  با موفقیت ویرایش شد ' , 3000 , 'menu');

                    },
                    error: function (error) {

                        console.log(error)

                        for ( var key in error.responseJSON.errors )
                        {
                            addErrorToPopup(error.responseJSON.errors[key])
                        }

                    },
                });

            }else {
                for (var key in editMenuRestrauntValidation.error)
                {
                    var message = editMenuRestrauntValidation.error[key];
                    $("#errorMenu").append("<div class='alert alert-danger' style='display: block'>"+message+"</div>")
                }
            }

       }

       function editRowMenu(e)
       {
           var tr = $(e).closest('tr');
           var trId = $(e).closest('tr').attr('id');

           var name = tr.find('.name').text();
           var nameId = tr.find('.name').attr('id');
           var price = tr.find('.price').text();
           var discount = tr.find('.discount').text();
           var makeup = tr.find('.makeup').text();


           var restrauntid = data.rowClickedInformation.id

           console.log(nameId)

           collapsePopup( 'container-popup-menu', true , 'ویرایش محصول' , 'edit')


           $('#menuProduct-name > input').val(name);
           $('#menuProduct-name > input').attr('id' , nameId);
           $('#menuProduct-price > input').val(price);

           $('#menuProduct-discount > input ' ).val(discount);
           $('#menuProduct-makeups > input ' ).val(makeup);


           //$('#menu-product > input ' ).attr('id' , restrauntid);



           $('#menuProduct-photo1 > img').attr('src' , Rout(Router.api.v1.product.getProductPhoto).replace('{restrauntId}' , restrauntid).replace('{ProductMenuId}' , trId).replace('{bannernumber}' , 1))
           $('#menuProduct-photo1 > img').show()

           $('#menuProduct-photo2 > img').attr('src'  , Rout(Router.api.v1.product.getProductPhoto).replace('{restrauntId}' , restrauntid).replace('{ProductMenuId}' , trId).replace('{bannernumber}' , 2))
           $('#menuProduct-photo2 > img').show()


           $('#menuProduct-photo3 > img').attr('src'  , Rout(Router.api.v1.product.getProductPhoto).replace('{restrauntId}' , restrauntid).replace('{ProductMenuId}' , trId).replace('{bannernumber}' , 3))
           $('#menuProduct-photo3 > img').show()


           $(".main-content-popup").attr("rowId",trId);


       }

       function deleteRowMenu(e)
       {
           var tr = $(e).closest('tr');
           var trId = $(e).closest('tr').attr('id');


           var data ={id : trId };

           $.ajax({
               type: 'POST',
               headers: { "Authorization": 'Bearer '+ token } ,
               url: Rout( Router.api.v1.menu.deleteMenuProduct ) ,
               contentType: "application/json",
               type: 'POST',
               dataType: "json",
               data: JSON.stringify(data),
               success: function (resp) {
                   console.log(resp)
                   AddCardHeaderAlerts( 'alert-success' , 'آیتم منو شما با موفقیت حذف گردید' , 3000 , 'restraunt')
                   $(`tr#${trId}`).remove();
               },
               error: function (error) {
                   console.log(error)
                   for ( var key in error.responseJSON.errors )
                   {
                       AddCardHeaderAlerts( 'alert-danger' , error.responseJSON.errors[key] , 3000 , 'restraunt')
                   }
               },
           });
           console.log(trId)
       }

       function editMenuProductRow( rowId  , productName, productId , typeName , mainGroupName , subGroupName  , price , discount , finalPrice , makeup )
       {
            console.log(rowId)
            console.log(productName)
            console.log(productId)
            console.log(typeName)
            console.log(mainGroupName)
            console.log(subGroupName)
            console.log(price)
            console.log(discount)
            console.log(finalPrice)
            console.log(makeup)

           var table = $('#menu_table');
           var tbody = table.find('tbody');
           var tr = tbody.find('#'+rowId);

           console.log(tr)
           var nameth = tr.find('.name').text(productName.toString()).attr('id' , productId);
           var typeth = tr.find('.type').text(typeName.toString());
           var maingroupth = tr.find('.maingroup').text(mainGroupName.toString());
           var subgroupth = tr.find('.subgroup').text(subGroupName.toString());
           var price = tr.find('.price').text(price.toString());
           var discount = tr.find('.discount').text(discount.toString());
           var finalprice = tr.find('.finalprice').text(finalPrice.toString());
           var makeup = tr.find('.makeup').text(makeup.toString());


       }


    </script>
@endsection

@section('css')

<style>
.table_restraunt_photo {
    width: 35px; height: 35px ; margin-top: 4px ;
{

table tr.active {background: #ccc;}


</style>

@endsection
