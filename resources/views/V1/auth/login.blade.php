
@extends('V1.layouts.master')

@section('content')

    <div class="main-conteiner">

        <div class="form-group">
            <label >Phone Number</label>
            <input type="text" id="phone" class="form-control" placeholder="Enter PhoneNumber" autocomplete="off">
        </div>

        <div class="form-group">
            <label >Password</label>
            <input type="password" id="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div id="alert" class="alert alert-danger" role="alert" >
            This is a warning alert—check it out!
        </div>
        <br>
        <button id="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>

@endsection

@section('css')
    <style>
        .g-sidenav-show{
            background-color: yellow;
        }
        .g-sidenav-hidden{
            background-color: yellow;
        }
        body{
            background-color: yellow;
        }
        html{
            background-color: yellow;
        }
        .main-conteiner {

            width: 500px;
            margin: auto;
            margin-top: 200px;
        }
        #alert{
            display: none;
        }

        @media (max-width:500px){
            .main-conteiner {
                width: 500px;
                margin: auto;
                margin-top: 0px;
                padding: 72px;
            }
        }
    </style>
@endsection

@section('js')
    <script>

        if(getCookie('token') != "")
        {
            window.location.href = "http://127.0.0.1:8000/v1/profile/home";
        }


        $('#submit').click(function (){

            // 1. Validation Form

            var phone = $('#phone').val()
            var password = $('#password').val()

            if(phone && !password)
            {
                $('#alert').text('لطفا رمز عبور خود را وارد کنید')
                $('#alert').css('display' , 'block');
            }else if (!phone && password)
            {
                $('#alert').text('لطفا شماره تلفن خود را وارد کنید');
                $('#alert').css('display' , 'block');
            }else if (!phone && !password)
            {
                $('#alert').text('لطفا شماره تلفن  و رمز عبور خود را وارد کنید');
                $('#alert').css('display' , 'block');
            }else {
                $('#alert').css('display' , 'none');
            }


            // 2. Post Form

            data ={phone:phone, password:password};
            var chertopert ;
            var saveData = $.ajax({
                async : false,
                contentType: "application/json",
                type: 'POST',
                dataType: "json",
                url: "http://127.0.0.1:8000/api/v1/user/login",
                success: function(resultData) {  chertopert = resultData} ,
                error: function(data){
                    console.log(data.responseJSON);
                },
                data: JSON.stringify(data),
            });


            if (chertopert != undefined)
            {
                var token = chertopert.data.token ;
                setCookie('token' , token , 0.1);
                console.log(token);
                alert('every think is  ok ')
                window.location.href = "http://127.0.0.1:8000/v1/profile/home";

            }else {
                $('#alert').text('رمز عبور ویا شماره تلفن شما اشتباه است');
                $('#alert').css('display' , 'block');
            }

        })


        function setCookie(name , value , expire)
        {
            var d = new Date();
            d.setTime(d.getTime() + (expire*24*60*60*1000));
            var expires = "expires="+ d.toUTCString();
            document.cookie = name + "=" + value + ";" + expires + ";path=/";
        }

        function getCookie(cname)
        {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

    </script>
@endsection



