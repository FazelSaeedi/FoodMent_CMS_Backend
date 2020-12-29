class Validation
{

    test()
    {
        alert("test")
    }



    loginValidation(phone , password)
    {
        var isValidate = true ;

        if(phone && !password)
        {
            $('#alert').text('لطفا رمز عبور خود را وارد کنید')
            $('#alert').css('display' , 'block');
            isValidate = false;

        }else if (!phone && password)
        {
            $('#alert').text('لطفا شماره تلفن خود را وارد کنید');
            $('#alert').css('display' , 'block');
            isValidate = false;

        }else if (!phone && !password)
        {
            $('#alert').text('لطفا شماره تلفن  و رمز عبور خود را وارد کنید');
            $('#alert').css('display' , 'block');
            isValidate = false;

        }else {
            $('#alert').css('display' , 'none');

        }

        return isValidate ;

    }


}
