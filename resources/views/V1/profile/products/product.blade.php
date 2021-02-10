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
        @include('V1.partials.popups.productOperationPopup')


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
                                    <h3 style="text-align: right;" class="mb-0">محصولات</h3>
                                </div>
                                <div class="col text-right" >
                                    <a href="#!" class="btn btn-sm btn-primary" onclick="collapsePopup(true , 'افزودن محصول' , 'add')" >افزودن محصول</a>
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
                                    <th scope="col">دسته فرعی</th>
                                    <th scope="col">دسته اصلی</th>
                                    <th scope="col">ماهیت</th>
                                    <th scope="col">نام محصول</th>
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

@section('js')
<script>


    // --------------
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
        getProduct           :  domainWithPort +'/api/v1/product/getproducttable/',
        addProduct           :  domainWithPort +'/api/v1/product/addproduct',
        editProduct          :  domainWithPort +'/api/v1/product/editproduct',
        deleteProduct        :  domainWithPort +'/api/v1/product/deleteproduct',
        getTypeTable         :  domainWithPort +'/api/v1/category/gettypestable/',
        getMainGroupTable    :  domainWithPort +'/api/v1/category/getmaingrouptable/',
        getSubGroupTable     :  domainWithPort +'/api/v1/category/getsubgrouptable/'
    }

    getProductTable(paginationBatchNumber)


    getTables('type' , routs.getTypeTable , 300)
    getTables('mainGroup' , routs.getMainGroupTable , 300)
    getTables('subGroup' , routs.getSubGroupTable , 300)

    var typeTable = cookie.getObjectLocalStorage('type')
    var mainGroupTable = cookie.getObjectLocalStorage('mainGroup')
    var subGroupTable = cookie.getObjectLocalStorage('subGroup')

    autocomplete( document.getElementById('type').querySelector("input") , typeTable )
    autocomplete( document.getElementById('mainGroup').querySelector("input") , mainGroupTable )
    autocomplete( document.getElementById('subGroup').querySelector("input") , subGroupTable )



    /*$('.container-popup').click(function (e){
        var mouseclickElement = document.elementFromPoint(e.pageX, e.pageY) ;
        if (mouseclickElement.className == 'container-popup')
            collapsePopup(false);
    })*/



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
        $('#product-code > input').val('');
        $('#product-name > input').val('');

        $('#type > input').val('');
        $('#mainGroup > input').val('');
        $('#subGroup > input').val('');


        $('#type > input').removeAttr("id");
        $('#type > input').removeAttr("code");

        $('#mainGroup > input').removeAttr("id");
        $('#mainGroup > input').removeAttr("code");

        $('#subGroup > input').removeAttr("id");
        $('#subGroup > input').removeAttr("code");

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

    // ---

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




            let matches = Object.entries(arr).filter(([key, value]) => value.name.includes(val))
                .reduce((acc, [k, v]) =>({...acc, [k]: v}), {})

            for (var w in matches)
            {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + matches[w]['name'].substr(0, val.length) + "</strong>";
                b.innerHTML += matches[w]['name'].substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' id='" + matches[w]['id'] + "' value='" + matches[w]['name'] + "' code='" + matches[w]['code'] + "'>";
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

        var product_code_div = $("#product-code")
        var product_name_div = $("#product-name")
        var product_type_div = $("#type")
        var product_mainGroup_div = $("#mainGroup")
        var product_subGroup_div = $("#subGroup")

        console.log(product_subGroup_div.find("input").attr('id'))

        var product_code_value = product_code_div.find("input").val() ;
        var product_name_value = product_name_div.find("input").val() ;
        var product_type_id = product_type_div.find("input").attr('id');
        var product_type_Value = product_type_div.find("input").val();
        var product_mainGroup_id = product_mainGroup_div.find("input").attr('id');
        var product_mainGroup_Value = product_mainGroup_div.find("input").val();
        var product_subGroup_id = product_subGroup_div.find("input").attr('id');
        var product_subGroup_Value = product_subGroup_div.find("input").val();


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
        }

    }

    function submitEditProductPopup()
    {

        clearErrorsInPopup()

        var product_code_div      =  $("#product-code")
        var product_name_div      =  $("#product-name")
        var product_id            =  $(".main-content-popup").attr('rowId');
        var product_type_div      =  $("#type")
        var product_mainGroup_div =  $("#mainGroup")
        var product_subGroup_div  =  $("#subGroup")


        var product_code_value = product_code_div.find("input").val() ;
        var product_name_value = product_name_div.find("input").val() ;

        var product_type_value = product_type_div.find("input").val() ;
        var product_mainGroup_value = product_mainGroup_div.find("input").val() ;
        var product_subGroup_value = product_subGroup_div.find("input").val() ;


        var product_type_id = product_type_div.find("input").attr('id');
        var product_mainGroup_id = product_mainGroup_div.find("input").attr('id');
        var product_subGroup_id = product_subGroup_div.find("input").attr('id');


        // alert(product_code_value)

        var editProductIsValid = validation.isValidAddProduct(
            product_code_value   , product_name_value ,
            product_type_id      , product_type_value ,
            product_mainGroup_id , product_mainGroup_value ,
            product_subGroup_id  , product_subGroup_value
        )


        data = {
            name:product_name_value,
            id : product_id ,
            code:product_code_value,
            type : product_type_id,
            maingroup: product_mainGroup_id,
            subgroup : product_subGroup_id,
        };

        if(editProductIsValid.valid)
        {
            $.ajax({
                type: 'POST',
                headers: { "Authorization": 'Bearer '+ token } ,
                url: routs.editProduct ,
                contentType: "application/json",
                type: 'POST',
                dataType: "json",
                data: JSON.stringify(data),
                success: function (resp) {

                    console.log(resp)

                     editProduct(
                         resp.data.id , resp.data.code ,resp.data.name ,
                         product_type_value , product_mainGroup_value , product_subGroup_value ,
                         resp.data.typeid ,resp.data.maingroupid , resp.data.subgroupid
                     )

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
            for (var key in editProductIsValid.error)
            {
                addErrorToPopup(editProductIsValid.error[key])
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

    function addProduct( id , code , name , typeName , mainGroupName , subGroupName , typeID , mainGroupID , subGroupID )
    {
        var editIconeURL = 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/64/Edit_icon_%28the_Noun_Project_30184%29.svg/1024px-Edit_icon_%28the_Noun_Project_30184%29.svg.png';
        var trushIconeURL = 'data:image/png;base64,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';

        $("tbody").append("<tr id='"+id+"'>" +
            "<th class='deleteRow' > <img onclick='deleteRow(this)' style='width: 1.375rem;' src='"+trushIconeURL+"'> </th>" +
            "<th class='editRow'   > <img onclick='editRow(this)'   style='width: 1.375rem;' src='"+editIconeURL+"'>  </th>" +
            "<th class='subGroup'    subGroupID='"+subGroupID+"' >"+subGroupName+"</th>" +
            "<th class='mainGroup'   mainGroupID='"+mainGroupID+"' >"+mainGroupName+"</th>" +
            "<th class='type'        typeID='"+typeID+"'>"+typeName+"</th>" +
            "<th class='name' >"+name+"</th>" +
            "<th class='code'>"+code+"</th>" +
            "</tr>"
        );
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
                url: routs.deleteProduct,
                contentType: "application/json",
                type: 'POST',
                dataType: "json",
                data: JSON.stringify(data),
                success: function (resp) {
                    console.log(resp)
                    AddCardHeaderAlerts( 'alert-success' , 'محصول شما با موفقیت حذف گردید' , 3000)
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

    function editRow(e)
    {

        var tr = $(e).closest('tr');
        var trId = $(e).closest('tr').attr('id');
        var name = tr.find('.name').text();
        var code = tr.find('.code').text();

        var typeValue = tr.find('.type').text();
        var mainGroupValue = tr.find('.mainGroup').text();
        var subGroupValue = tr.find('.subGroup').text();

        var typeID = tr.find('.type').attr('typeid');
        var mainGroupID = tr.find('.mainGroup').attr('maingroupid');
        var subGroupID = tr.find('.subGroup').attr('subgroupid');



        var editMainGroup = {
            id : trId ,
            code : code ,
            name : name ,
        }

        // console.log(editType);
        collapsePopup( true , 'ویرایش محصول' , 'edit')


        $('#product-code > input').val(code);
        $('#product-name > input').val(name);

        $('#type > input ' ).val(typeValue);
        $('#mainGroup > input ' ).val(mainGroupValue);
        $('#subGroup > input ' ).val(subGroupValue);


        $('#type > input ' ).attr('id' , typeID);
        $('#mainGroup > input ' ).attr('id' , mainGroupID);
        $('#subGroup > input ' ).attr('id' , subGroupID);


        $(".main-content-popup").attr("rowId",trId);

    }

    function editProduct( rowId , code , name , typeName , mainGroupName , subGroupName , typeID , mainGroupID , subGroupID)
    {
        var tr = $('#'+rowId)
        var codeth = tr.find('.code');
        var nameth = tr.find('.name');
        var typeth = tr.find('.type');
        var mainGroupth = tr.find('.mainGroup');
        var subGroupth  = tr.find('.subGroup');


        codeth.text(code)
        nameth.text(name)
        typeth.text(typeName)
        mainGroupth.text(mainGroupName)
        subGroupth.text(subGroupName)

        typeth.attr("typeid",typeID);
        mainGroupth.attr("maingroupid",mainGroupID);
        subGroupth.attr("subgroupid",subGroupID);

    }

    // test -----------------

    function getTables( name , url , paginationBatchNumber)
    {
        $.ajax({
            async : false ,
            headers: { "Authorization": 'Bearer '+ token } ,
            url: url + paginationBatchNumber ,
            contentType: "application/json" ,
            type: 'GET' ,
            dataType: "json",
            success: function (resp) {


                console.log(resp.data.data);
                cookie.setObjectLocalStorage(name, resp.data.data)


            },
            error: function (error) {
                // console.log(resp);
            },
        });
    }

    function getProductTable(paginationBatchNumber)
    {

        $.ajax({
            headers: { "Authorization": 'Bearer '+ token } ,
            url: routs.getProduct + paginationBatchNumber ,
            contentType: "application/json" ,
            type: 'GET' ,
            dataType: "json",
            success: function (resp) {
                console.log(resp.data);
                // resp.responseJSONfor ( var key in error.responseJSON.errors )
                for ( var key in resp.data.data )
                {
                    var product = resp.data.data[key]
                    addProduct(
                        product.productid , product.productcode , product.productname ,
                        product.typename , product.maingroupname , product.subgroupname ,
                        product.typeid , product.maingroupid , product.subgroupid
                    )
                }

                AddPagination( resp.data )

            },
            error: function (error) {
                // console.log(resp);
            },
        });
    }

    function emptyTable(id)
    {
        $('#'+ id).empty();
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
                        var product = resp.data.data[key]
                        addProduct(
                            product.productid , product.productcode , product.productname ,
                            product.typename , product.maingroupname , product.subgroupname ,
                            product.typeid , product.maingroupid , product.subgroupid
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

</script>
@endsection
