class Validation
{


    isValidLoginInformation(phone , password)
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


    isValidAddRestrauntPhoto(fileName)
    {
        var allowed_extensions = new Array("jpg","png");
        var file_extension = fileName.split('.').pop().toLowerCase(); // split function will split the filename by dot(.), and pop function will pop the last element from the array which will give you the extension as well. If there will be no extension then it will return the filename.

        for(var i = 0; i <= allowed_extensions.length; i++)
        {
            if(allowed_extensions[i]==file_extension)
            {
                return true; // valid file extension
            }
        }

        return false;
    }


}
