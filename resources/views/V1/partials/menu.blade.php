
<?php
$url = Config::get('app.base_url');
?>
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">

        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class = "navbar-brand" href="javascript:void(0)">
                <img src="http://kalament.ir/foodment/public/V1/assets/img/brand/foodment.png" class="navbar-brand-img" alt="...">
            </a>
        </div>
        <style>

            .navbar-inner{
                font-size: 18px !important;
                font-weight: 400  !important;
                font-family: 'behdad','BYekan',tahoma;
            }

            .nav-link-text{
                margin: auto;
            }

        </style>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li id="menu-panel" class="nav-item">
                        <a  class="nav-link" href="{{$url}}/v1/profile/home">
{{--                            <i class="ni ni-tv-2 text-primary"></i>--}}
                            <span class="nav-link-text">پنل کاربری</span>
                        </a>
                    </li>
                    <li id="menu-type" class="nav-item">
                        <a class="nav-link" href="{{$url}}/v1/profile/types">
{{--                            <i class="ni ni-planet text-orange"></i>--}}
                            <span class="nav-link-text"> دسته بندی ها</span>
                        </a>
                    </li>
                    <li id="menu-maingroup" class="nav-item">
                        <a class="nav-link" href="{{$url}}/v1/profile/maingroups">
{{--                            <i class="ni ni-planet text-orange"></i>--}}
                            <span class="nav-link-text">گروه ها</span>
                        </a>
                    </li>
                    <li id="menu-subgroup" class="nav-item">
                        <a class="nav-link" href="{{$url}}/v1/profile/subgroups">
{{--                            <i class="ni ni-planet text-orange"></i>--}}
                            <span class="nav-link-text"> زیر گروه ها</span>
                        </a>
                    </li>
                    <li id="menu-product" class="nav-item">
                        <a class="nav-link" href="{{$url}}/v1/profile/products">
{{--                            <i class="ni ni-planet text-orange"></i>--}}
                            <span class="nav-link-text"> محصولات ها</span>
                        </a>
                    </li>
                    <li  id="menu-restraunt" class="nav-item">
                        <a class="nav-link" href="{{$url}}/v1/profile/restraunts">
{{--                            <i class="ni ni-spaceship text-orange"></i>--}}
                            <span class="nav-link-text">رستوران ها</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

@section('menujs')
    <script>

 /*       let menuCookie = new Cookie();

        $('.navbar-nav > li ').click(function (){
            var menuItemClick = $(this).attr("id")
            // alert(menuItemClick)
            menuCookie.setCookie('menuActive' , menuItemClick , 5000 )
        })


        var menuActive = menuCookie.getCookie('menuActive');



        if (menuActive != 'menu-panel' && menuActive != 'undefined')
        {
            $('#' + menuActive + ' > a').addClass( "active" )
        }else {
            $('#' + 'menu-panel' + ' > a').addClass( "active" )
        }*/








    </script>
@endsection
