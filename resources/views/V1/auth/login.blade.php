
@extends('V1.layouts.master')

@section('content')

    <div class="main-conteiner">

        <div class="form-group">
            <input type="number"  id="phone" class="form-control" placeholder="تلفن همراه" autocomplete="off">
        </div>

        <div class="form-group">
            <input type="password" id="password" class="form-control" id="exampleInputPassword1" placeholder="کلمه عبور">
        </div>
        <div id="alert" class="alert alert-danger" role="alert" >
            This is a warning alert—check it out!
        </div>
        <br>
        <div class="d-flex justify-content-center ">
            <button id="submit" type="submit" class="btn  col-md-6">ورود</button>
        </div>
    </div>

@endsection

@section('css')
    <style>

        .form-group {
            margin-bottom: 0.7rem !important;;
        }

        #password ,#phone{
            text-align: center;
            font-family:BYekan,'BYekan',tahoma;
            font-size: 39px;
        }

        #submit{
            font-family:BYekan,'BYekan',tahoma;
            font-size: 28px;
            background-color: #d6bd25;
            color: black;
        }

        body{
            background-color:transparent !important;
        }

        html{
            background-image: url('https://wallup.net/wp-content/uploads/2017/03/29/490310-Fries-tomatoes-food.jpg');
        }
        .main-conteiner {

            width: 330px;
            margin: auto;
            margin-top: 200px;
        }
        #alert{
            display: none;
        }

        @media (max-width:500px){
            .main-conteiner {
                width: 80%;
                margin: auto;
                margin-top: 20%;
                /*padding: 72px;*/
            }
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
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
            window.location.href = Rout( Router.web.v1.profile.home);
        }


        $('#submit').click(function (){

            // 1. Validation Form

            var phone = $('#phone').val()
            var password = $('#password').val()


            if (validation.isValidLoginInformation(phone , password))
            {
                // 2. Post Form

                data ={phone:phone, password:password};
                var chertopert ;
                var saveData = $.ajax({
                    async : false,
                    contentType: "application/json",
                    type: 'POST',
                    dataType: "json",
                    url: Rout(Router.api.v1.user.login) ,
                    success: function(resultData) {  chertopert = resultData } ,
                    error: function(data){
                        // console.log(data.responseJSON);
                    },
                    data: JSON.stringify(data),
                });

                if (chertopert != undefined)
                {
                    var token = chertopert.data.token ;
                    cookie.setCookie('token' , token , 0.1);
                    cookie.setCookie('phone' , phone , 0.1);

                    // console.log(token);
                    // alert('every think is  ok ')
                    window.location.href = Rout( Router.web.v1.profile.home);

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



