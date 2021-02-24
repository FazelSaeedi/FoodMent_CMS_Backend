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
        var GlobalRouter = new Router(domainWithPort);

        // check cookie and token for get Information
        if(token == "")
        {
            window.location.href = GlobalRouter.Rout('auth' , 'login');
        }else{
            if(!ajax.checkToken())
                cookie.logout()
        }

        $("#logout").click(function (){
            cookie.logout()
        })





    </script>
@endsection
