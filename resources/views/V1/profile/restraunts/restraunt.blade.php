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
                                    <th scope="col">Page name</th>
                                    <th scope="col">Visitors</th>
                                    <th scope="col">Unique users</th>
                                    <th scope="col">ویرایش</th>
                                    <th scope="col">حذف</th>
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
        domainWithPort = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');

        // check cookie and token for get Information
        if(cookie.getCookie('token') == "")
        {
            window.location.href = domainWithPort+"/v1/auth/login";
        }

        $("#logout").click(function (){
            cookie.logout()
        })






        /*--------------------------------------------*
        *                                             *
        *                                             *
        * Start----------- addRestaurantsPopup        *
        *                                             *
        *                                             *
        * --------------------------------------------*/



        // buttom close-add-restaurant
        $("#close-add-restaurant").click(function (){
            $(".add-restaurant-Popup").fadeOut(200)

              // for menu
              // $('.sidenav').css('transform' , "translateX(0px)")
              // $('.main-content').css('margin-left' , "255px")

        })


        // button add restraun
        $("#addRestaurant").click(function (){
            $(".add-restaurant-Popup").fadeIn(200)



             // for menu
             //$('.sidenav').css('transform', "translateX(-250px)")
             //$('.main-content').css('margin-left' , "0px")

        })


        // button submit add restraun
        $("#submit-add-restaurant").click(function (){

            var name = $('#name-restaurant-Popup').val();
            var address = $('#address-restaurant-Popup').val();
            var phone = $('#phone-restaurant-Popup').val();

            console.log({
                name : name ,
                address : address ,
                phone : phone
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
                "</tr>");



             // for menu
             //$('.sidenav').css('transform' , "translateX(0px)")

        })





        /*--------------------------------------------*
        *                                             *
        *                                             *
        *  Start----------- editRestaurantsPopup      *
        *                                             *
        *                                             *
        * --------------------------------------------*/



        // buttom close-edit-restaurant
        $("#close-edit-restaurant").click(function (){
            $(".edit-restaurant-Popup").fadeOut(200)

            // for menu
            // $('.sidenav').css('transform' , "translateX(0px)")
            // $('.main-content').css('margin-left' , "255px")

        })


        // button submit edit restraun
        $("#submit-edit-restaurant").click(function (){

            var id = $('.edit-restaurant-Popup').attr('id');
            var name = $('#edit-name-restaurant-Popup').val();
            var address = $('#edit-address-restaurant-Popup').val();
            var phone = $('#edit-phone-restaurant-Popup').val();

            console.log({
                id : id,
                name : name ,
                address : address ,
                phone : phone
            })



            $(`tr#${id} .name`).html(name)
            $(`tr#${id} .phone`).html(phone)
            $(`tr#${id} .address`).html(address)

            $(".edit-restaurant-Popup").fadeOut(200)

        })



        function editRow(e)
        {

            var tr = $(e).closest('tr');
            var phone = tr.find('.phone').text();
            var name = tr.find('.name').text();
            var address = tr.find('.address').text();


             $('#edit-name-restaurant-Popup').val(name)
             $('#edit-address-restaurant-Popup').val(address)
             $('#edit-phone-restaurant-Popup').val(phone)


            $(".edit-restaurant-Popup").fadeIn(200)


            // alert("open edit Page")
            // return trId;
        }





        /*--------------------------------------------*
        *                                             *
        *                                             *
        *  Start----------- deleteRestaurant          *
        *                                             *
        *                                             *
        * --------------------------------------------*/


        function deleteRow(e)
        {


            var tr = $(e).closest('tr');
            var trId = tr.attr('id');


            $(`tr#${trId}`).remove();
            alert(trId)
        }




    </script>
@endsection
