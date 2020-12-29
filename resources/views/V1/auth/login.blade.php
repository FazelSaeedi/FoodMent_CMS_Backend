
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

        let cookie = new Cookie();
        let validation = new Validation();
        var isValidateUI = false ;
        domainWithPort = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');



        if(cookie.getCookie('token') != "")
        {
            window.location.href = domainWithPort+"/v1/profile/home";
        }


        $('#submit').click(function (){

            // 1. Validation Form

            var phone = $('#phone').val()
            var password = $('#password').val()


            if (validation.loginValidation(phone , password))
            {
                // 2. Post Form

                data ={phone:phone, password:password};
                var chertopert ;
                var saveData = $.ajax({
                    async : false,
                    contentType: "application/json",
                    type: 'POST',
                    dataType: "json",
                    url: domainWithPort+"/api/v1/user/login",
                    success: function(resultData) {  chertopert = resultData} ,
                    error: function(data){
                        // console.log(data.responseJSON);
                    },
                    data: JSON.stringify(data),
                });

                if (chertopert != undefined)
                {
                    var token = chertopert.data.token ;
                    cookie.setCookie('token' , token , 0.1);
                    // console.log(token);
                    // alert('every think is  ok ')
                    window.location.href = domainWithPort+"/v1/profile/home";

                }
                else
                {
                    $('#alert').text('رمز عبور ویا شماره تلفن شما اشتباه است');
                    $('#alert').css('display' , 'block');
                }
            }

        })



    </script>
@endsection



