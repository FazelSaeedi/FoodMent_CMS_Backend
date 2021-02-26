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

                            <div id="card-header-Alerts" style="text-align:center">
                            </div>


                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 style="text-align: center;" class="mb-0 ">صفحه اصلی</h3>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <div class="col mt-5 text" style="text-align: center; font-size: 30px">
                                به پلتفرم فروش غذای آنلاین
                                کالامنت خوش آمدید
                            </div>
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
        domainWithPort = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');
       // var GlobalRouter = new Router(domainWithPort);

        // check cookie and token for get Information
        if(token == "")
        {
            window.location.href = Rout(Router.web.v1.auth.login);
        }else{
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



        $("#logout").click(function (){
            cookie.logout()
        })




    </script>
@endsection
