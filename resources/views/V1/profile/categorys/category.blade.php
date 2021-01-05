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
                                    <h3 class="mb-0">دسته بندی ها</h3>
                                </div>
                                <div class="col text-right" id="addCategory">
                                    <a href="#!" class="btn btn-sm btn-primary">افزودن دسته</a>
                                </div>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table id="category_table" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">نام دسته</th>
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
@endsection

{{--Test Js --}}
@section('js')
    <script>

        let cookie = new Cookie();
        var token = cookie.getCookie('token') ;
        let ajax = new Ajax(token);


        domainWithPort = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');


        // check cookie and token for get Information
        if(token == "")
            window.location.href = domainWithPort+"/v1/auth/login";
        else
        {
            if(!ajax.checkToken())
               cookie.logout()
        }


        $("#logout").click(function (){
            cookie.logout()
        })


        var categoryParent = 0 ;
        fillCategoryTable(ajax.getMainCategory())




        $('#addCategory').click(function (){
            alert('category add');
            ajax.addCategory('sss');
            fillCategoryTable(ajax.getMainCategory())
        })



        function emptyTable(id)
        {
            $('#'+ id).empty();
        }

        function fillCategoryTable(mainCategoryList)
        {

            emptyTable("category_table tbody");
            $.each(mainCategoryList.data, function(i, val) {
                console.log(val['title']);

                $("tbody").append("<tr id='"+val['id']+"'>" +
                    "<th>"+val['title']+"</th>" +
                    "<th>ویرایش</th>" +
                    "<th>حذف</th>" +
                    "</tr>"
                );
            })

        }



    </script>
@endsection
