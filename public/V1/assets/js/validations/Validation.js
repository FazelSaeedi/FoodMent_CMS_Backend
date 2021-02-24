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
            if(allowed_extensions[i] == file_extension)
            {
                return true; // valid file extension
            }
        }

        return false;
    }


    isValidAddType( code , name )
    {
        var validation = {
            valid: true ,
            error: {

            },
        };


            if (code.length < 1)
            {
                validation.error.codeLenght = "کد الزامی است" ;
                validation.valid = false ;
            }

            if (name.length < 1)
            {
                validation.error.nameLenght = "نام الزامی است" ;
                validation.valid = false ;
            }

            if (code.length > 0 && !this.isNumber(code))
            {
                validation.error.codeNumber = "لطفا کد را به صورت عددی وارد نمایید" ;
                validation.valid = false ;
            }

        return validation ;

    }


    isValidAddMainGroup( code , name )
    {
        var validation = {
            valid: true ,
            error: {

            },
        };


        if (code.length < 1)
        {
            validation.error.codeLenght = "کد الزامی است" ;
            validation.valid = false ;
        }

        if (name.length < 1)
        {
            validation.error.nameLenght = "نام الزامی است" ;
            validation.valid = false ;
        }

        if (code.length > 0 && !this.isNumber(code))
        {
            validation.error.codeNumber = "لطفا کد را به صورت عددی وارد نمایید" ;
            validation.valid = false ;
        }

        return validation ;

    }


    isValidAddSubGroup( code , name )
    {
        var validation = {
            valid: true ,
            error: {

            },
        };


        if (code.length < 1)
        {
            validation.error.codeLenght = "کد الزامی است" ;
            validation.valid = false ;
        }

        if (name.length < 1)
        {
            validation.error.nameLenght = "نام الزامی است" ;
            validation.valid = false ;
        }

        if (code.length > 0 && !this.isNumber(code))
        {
            validation.error.codeNumber = "لطفا کد را به صورت عددی وارد نمایید" ;
            validation.valid = false ;
        }

        return validation ;

    }


    isValidAddProduct( code , name , typeID , typeValue , mainGroupID , mainGroupValue , subGroupID , subGroupValue )
    {
        var validation = {
            valid: true ,
            error: {

            },
        };

        if (code.length < 1)
        {
            validation.error.codeLenght = "کد الزامی است" ;
            validation.valid = false ;
        }
        if (name.length < 1)
        {
            validation.error.nameLenght = "نام الزامی است" ;
            validation.valid = false ;
        }
        if (code.length > 0 && !this.isNumber(code))
        {
            validation.error.codeNumber = "لطفا کد را به صورت عددی وارد نمایید" ;
            validation.valid = false ;
        }
        if (typeID == null )
        {
            validation.error.typeIdUndefined = "لطفا کد دسته را وارد نمایید" ;
            validation.valid = false ;
        }
        if ( typeID != null && !this.isNumber(typeID))
        {
            validation.error.typeIDNumber = "لطفا کد دسته را به صورت عددی وارد نمایید" ;
            validation.valid = false ;
        }
        if ( typeValue.length < 1)
        {
            validation.error.typeValuelength = "دسته الزامی است" ;
            validation.valid = false ;
        }
        if (mainGroupID == null )
        {
            validation.error.mainGroupIDUndefined = "لطفا کد  گروه اصلی را وارد نمایید" ;
            validation.valid = false ;
        }
        if ( mainGroupID != null && !this.isNumber(mainGroupID))
        {
            validation.error.mainGroupIDNumber = "لطفا کد گروه اصلی را به صورت عددی وارد نمایید" ;
            validation.valid = false ;
        }
        if ( mainGroupValue.length < 1)
        {
            validation.error.mainGroupValuelength = " گروه اصلی الزامی است" ;
            validation.valid = false ;
        }
        if (subGroupID == null )
        {
            validation.error.subGroupIDUndefined = "لطفا کد  گروه فرعی را وارد نمایید" ;
            validation.valid = false ;
        }
        if ( subGroupID != null && !this.isNumber(subGroupID))
        {
            validation.error.subGroupIDNumber = "لطفا کد گروه فرعی را به صورت عددی وارد نمایید" ;
            validation.valid = false ;
        }
        if ( subGroupValue.length < 1)
        {
            validation.error.subGroupIDValuelength = " گروه فرعی الزامی است" ;
            validation.valid = false ;
        }

        // console.log(validation)


        return validation ;

    }

    isValidAddRestraunt ( code , name , address , phone  , admin , image1 , image2  , image3)
    {
        var validation = {
            valid: true ,
            error: {

            },
        };


        if (code.length<1)
        {
            validation.error.codeLenght = "کد الزامی است" ;
            validation.valid = false ;
        }

        if (name.length < 1)
        {
            validation.error.nameLenght = "نام الزامی است" ;
            validation.valid = false ;
        }

        if (address.length < 1)
        {
            validation.error.addressLenght = "آدرس الزامی است" ;
            validation.valid = false ;
        }

        if (phone.length < 1)
        {
            validation.error.phoneLenght = "تلفن الزامی است" ;
            validation.valid = false ;
        }

        if (admin.length < 1)
        {
            validation.error.adminLenght = "مدیر الزامی است" ;
            validation.valid = false ;
        }

        if (code.length > 0 && !this.isNumber(code))
        {
            validation.error.codeNumber = "لطفا کد را به صورت عددی وارد نمایید" ;
            validation.valid = false ;
        }

        if (phone.length > 0 && !this.isNumber(phone))
        {
            validation.error.phoneNumber = "لطفا شماره تلفن را به صورت عددی وارد نمایید" ;
            validation.valid = false ;
        }

        if (!this.isValidAddRestrauntPhoto(image1))
        {
            validation.error.photo1Invalid = "لطفا فایل اول را با پسوند jpg , png وارد نمایید" ;
            validation.valid = false ;
        }

        if (!this.isValidAddRestrauntPhoto(image2))
        {
            validation.error.photo2Invalid = "لطفا فایل دوم را با پسوند jpg , png وارد نمایید" ;
            validation.valid = false ;
        }

        if (!this.isValidAddRestrauntPhoto(image3))
        {
            validation.error.photo3Invalid = "لطفا فایل سوم را با پسوند jpg , png وارد نمایید" ;
            validation.valid = false ;
        }


        return validation ;
    }


    isValidEditRestraunt ( code , name , address , phone  , adminName )
    {
        var validation = {
            valid: true ,
            error: {

            },
        };


        if (code.length<1)
        {
            validation.error.codeLenght = "کد الزامی است" ;
            validation.valid = false ;
        }

        if (name.length < 1)
        {
            validation.error.nameLenght = "نام الزامی است" ;
            validation.valid = false ;
        }

        if (address.length < 1)
        {
            validation.error.addressLenght = "آدرس الزامی است" ;
            validation.valid = false ;
        }

        if (phone.length < 1)
        {
            validation.error.phoneLenght = "تلفن الزامی است" ;
            validation.valid = false ;
        }

        if (adminName.length < 1)
        {
            validation.error.adminNameLenght = " نام مدیر الزامی است" ;
            validation.valid = false ;
        }

        if (code.length > 0 && !this.isNumber(code))
        {
            validation.error.codeNumber = "لطفا کد را به صورت عددی وارد نمایید" ;
            validation.valid = false ;
        }

        if (phone.length > 0 && !this.isNumber(phone))
        {
            validation.error.phoneNumber = "لطفا شماره تلفن را به صورت عددی وارد نمایید" ;
            validation.valid = false ;
        }





        return validation ;

    }


    isValidAddMenuProduct (name , price , discount  , makeups , image1 , image2  , image3)
    {
        var validation = {
            valid: true ,
            error: {

            },
        };


        if(name.length < 1)
        {
            validation.error.nameLenght = "لطفا نام را وارد نمایید" ;
            validation.valid = false ;
        }


        if(price.length < 1 )
        {
            validation.error.priceLenght = "لطفا قیمت را وارد نمایید" ;
            validation.valid = false ;
        }


        if(discount.length < 1 )
        {
            validation.error.discountLenght = "لطفا درصد تخفیف را وارد نمایید" ;
            validation.valid = false ;
        }

        if (discount.length > 2)
        {
            validation.error.discountIsnotPercent = "لطفا درصد تخفیف را به صورت صحیح وارد نمایید" ;
            validation.valid = false ;
        }

        if(makeups.length < 1)
        {
            validation.error.makeupsLenght = "لطفا مواد تشکیل دهنده را وارد نمایید" ;
            validation.valid = false ;
        }




        if (!this.isValidAddRestrauntPhoto(image1))
        {
            validation.error.photo1Invalid = "لطفا فایل اول را با پسوند jpg , png وارد نمایید" ;
            validation.valid = false ;
        }

        if (!this.isValidAddRestrauntPhoto(image2))
        {
            validation.error.photo2Invalid = "لطفا فایل دوم را با پسوند jpg , png وارد نمایید" ;
            validation.valid = false ;
        }

        if (!this.isValidAddRestrauntPhoto(image3))
        {
            validation.error.photo3Invalid = "لطفا فایل سوم را با پسوند jpg , png وارد نمایید" ;
            validation.valid = false ;
        }

        return validation
    }

    isValidEditMenu ( price , discount , makeups )
    {
        var validation = {
            valid: true ,
            error: {

            },
        };


        if(price.length < 1)
        {
            validation.error.priceIdLenght = "لطفا مبلغ را وارد نمایید" ;
            validation.valid = false ;
        }

        if(discount.length < 1)
        {
            validation.error.discountLenght = "لطفا درصد تخفیف را وارد نمایید" ;
            validation.valid = false ;
        }

        if(makeups.length < 1)
        {
            validation.error.makeupsLenght = "لطفا موادتشکیل دهنده را وارد نمایید" ;
            validation.valid = false ;
        }


        return validation
    }

    isNumber(n)
    {
        return !isNaN(parseFloat(n)) && !isNaN(n - 0)
    }



}
