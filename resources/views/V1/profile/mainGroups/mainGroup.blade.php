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


    </style>
    <!-- Sidenav -->
    @include('V1.partials.menu')
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        @include('V1.partials.topnav')
        @include('V1.partials.popups.mainGroupOperationPopup')


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
                                    <h3 style="text-align: right;" class="mb-0">گروه ها</h3>
                                </div>
                                <div class="col text-right" >
                                    <a href="#!" class="btn btn-sm btn-primary" onclick="collapsePopup(true , 'افزودن گروه اصلی' , 'add')" >افزودن گروه</a>
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
                                    <th scope="col">نام گروه</th>
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
        var paginationBatchNumber = 5;

        domainWithPort = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');

        let routs = {
            getMainGroupTable    :  domainWithPort +'/api/v1/category/getmaingrouptable/',
            deleteMainGroupTable :  domainWithPort +'/api/v1/category/deletemaingroup/',
            addMainGroup :          domainWithPort +'/api/v1/category/addmaingroup',
            editMainGroup :         domainWithPort +'/api/v1/category/editmaingroup',
        }


        // check cookie and token for get Information
        if(token == "")
            window.location.href = Rout(Router.web.v1.auth.login);
        else
        {
            if(!ajax.checkToken())
                cookie.logout()
        }

        $('#profileName').text(cookie.getCookie('phone'))

        // get MainGrpoup table from serve
        getMainGroupTable(paginationBatchNumber)

        $("#logout").click(function (){
            cookie.logout()
        })



        function getMainGroupTable(paginationBatchNumber)
        {

            $.ajax({
                headers: { "Authorization": 'Bearer '+ token } ,
                url: Rout(Router.api.v1.category.getMainGroupTable) +'/'+paginationBatchNumber ,
                contentType: "application/json" ,
                type: 'GET' ,
                dataType: "json",
                success: function (resp) {
                    console.log(resp.data);
                    // resp.responseJSONfor ( var key in error.responseJSON.errors )
                    for ( var key in resp.data.data )
                    {
                        var mainGroup = resp.data.data[key]
                        addMainGroup(mainGroup.id , mainGroup.code , mainGroup.name)
                    }

                    AddPagination( resp.data )

                },
                error: function (error) {
                    // console.log(resp);
                },
            });
        }

        function collapsePopup(status , title , submitfunction)
        {
            if (status)
            {
                clearInputPopup()
                changeTitlePopup(title)
                changeSubmitOnclick(submitfunction)
                $(".container-popup").fadeIn(200)
            }
            else
                $(".container-popup").fadeOut(200)
        }

        function clearInputPopup()
        {
            $('#mainGroup-code > input').val('');
            $('#mainGroup-name > input').val('');
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

        function addMainGroup( id , code , name)
        {
            var editIconeURL = 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/64/Edit_icon_%28the_Noun_Project_30184%29.svg/1024px-Edit_icon_%28the_Noun_Project_30184%29.svg.png';
            var trushIconeURL = 'data:image/png;base64,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';
            $("tbody").append("<tr id='"+id+"'>" +
                "<th class='deleteRow' > <img onclick='deleteRow(this)' style='width: 1.375rem;' src='"+trushIconeURL+"'> </th>" +
                "<th class='editRow'   > <img onclick='editRow(this)'   style='width: 1.375rem;' src='"+editIconeURL+"'>  </th>" +
                "<th class='name'>"+name+"</th>" +
                "<th class='code'>"+code+"</th>" +
                "</tr>"
            );
        }

        function emptyTable(id)
        {
            $('#'+ id).empty();
        }

        function editRow(e)
        {

            var tr = $(e).closest('tr');
            var trId = $(e).closest('tr').attr('id');
            var name = tr.find('.name').text();
            var code = tr.find('.code').text();

            var editMainGroup = {
                id : trId ,
                code : code ,
                name : name ,
            }

            // console.log(editType);
            collapsePopup( true , 'ویرایش گروه' , 'edit')


            $('#mainGroup-code > input').val(code);
            $('#mainGroup-name > input').val(name);

            $(".main-content-popup").attr("rowId",trId);

        }

        function deleteRow(e)
        {
            var r = confirm("آیا از حذف مطمئن هستید؟");
            if (r == true) {

                var tr = $(e).closest('tr');
                var trId = $(e).closest('tr').attr('id');


                data ={id : trId };
                $.ajax({
                    type: 'POST',
                    headers: { "Authorization": 'Bearer '+ token } ,
                    url: Rout(Router.api.v1.category.deleteMainGroupTable),
                    contentType: "application/json",
                    type: 'POST',
                    dataType: "json",
                    data: JSON.stringify(data),
                    success: function (resp) {
                        console.log(resp)
                        AddCardHeaderAlerts( 'alert-success' , 'گروه شما با موفقیت حذف گردید' , 3000)
                        tr.remove();
                    },
                    error: function (error) {

                        for ( var key in error.responseJSON.errors )
                        {
                            // alert(error.responseJSON.errors[key])
                            AddCardHeaderAlerts( 'alert-danger' , error.responseJSON.errors[key] , 3000)
                        }
                    },
                });

            } else {
            }

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

        function submitPopup(status)
        {
            if (status == 'add')
                submitAddMainGroupPopup()
            else if (status == 'edit')
                submitEditMainGroupPopup()
        }

        function submitAddMainGroupPopup()
        {

            clearErrorsInPopup()

            var mainGroup_code_div = $("#mainGroup-code")
            var mainGroup_name_div = $("#mainGroup-name")



            var mainGroup_code_value = mainGroup_code_div.find("input").val() ;
            var mainGroup_name_value = mainGroup_name_div.find("input").val() ;
            var addMainGroupIsValid = validation.isValidAddMainGroup( mainGroup_code_value , mainGroup_name_value)
            data ={name:mainGroup_name_value , code:mainGroup_code_value};


            if(addMainGroupIsValid.valid)
            {

                $.ajax({
                    type: 'POST',
                    headers: { "Authorization": 'Bearer '+ token } ,
                    url: Rout(Router.api.v1.category.addMainGroup),
                    contentType: "application/json",
                    type: 'POST',
                    dataType: "json",
                    data: JSON.stringify(data),
                    success: function (resp) {
                        console.log(resp)
                        addMainGroup(resp.data.id , resp.data.code ,resp.data.name)
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
                for (var key in addMainGroupIsValid.error)
                {
                    addErrorToPopup(addMainGroupIsValid.error[key])
                }
            }

        }

        function submitEditMainGroupPopup()
        {
            clearErrorsInPopup()

            var mainGroup_code_div = $("#mainGroup-code")
            var mainGroup_name_div = $("#mainGroup-name")
            var mainGroup_id       = $(".main-content-popup").attr('rowId');


            var mainGroup_code_value = mainGroup_code_div.find("input").val() ;
            var mainGroup_name_value = mainGroup_name_div.find("input").val() ;

            var editMainGroupIsValid = validation.isValidAddMainGroup(mainGroup_code_value , mainGroup_name_value)

            data ={
                name:mainGroup_name_value,
                id : mainGroup_id ,
                code:mainGroup_code_value
            };

            if(editMainGroupIsValid.valid)
            {

                $.ajax({
                    type: 'POST',
                    headers: { "Authorization": 'Bearer '+ token } ,
                    url: Rout(Router.api.v1.category.editMainGroup) ,
                    contentType: "application/json",
                    type: 'POST',
                    dataType: "json",
                    data: JSON.stringify(data),
                    success: function (resp) {
                        console.log(resp)
                        editMainGroup(resp.data.id , resp.data.code ,resp.data.name)
                        collapsePopup(false)
                        AddCardHeaderAlerts( 'alert-success' , ' گروه '+resp.data.name+' با موفقیت ویرایش شد ' , 3000)
                    },
                    error: function (error) {

                        for ( var key in error.responseJSON.errors )
                        {
                            addErrorToPopup(error.responseJSON.errors[key][0])
                        }

                    },
                });


            }else {
                for (var key in editMainGroupIsValid.error)
                {
                    addErrorToPopup(editMainGroupIsValid.error[key])
                }
            }
        }

        function clearErrorsInPopup()
        {
            $('#error div').each(
                function(element)
                {
                    this.remove();
                }
            );
        }

        function addErrorToPopup(message)
        {
            $("#error").append("<div class='alert alert-danger' style='display: block'>"+message+"</div>")
        }


        function editMainGroup( rowId , code , name)
        {
            var tr = $('#'+rowId)
            var codeth = tr.find('.code');
            var nameth = tr.find('.name');


            codeth.text(code)
            nameth.text(name)

        }

        // pagination ----------------------------------------------------------------------------------------------------------
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
                            var mainGroup = resp.data.data[key]
                            addMainGroup(mainGroup.id , mainGroup.code , mainGroup.name)
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

    </script>
@endsection
