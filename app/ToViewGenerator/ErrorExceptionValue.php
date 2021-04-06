<?php


namespace App\ToViewGenerator;


use Symfony\Component\HttpFoundation\Response;


class ErrorExceptionValue
{


    // Fields --------------------------------


    const PHONE    = 101    ;
    const PASSWORD = 102 ;


    // Rules  --------------------------------

    const REQUIRED  = 501  ;



    // Fields Array  -------------------------

    public static array $fields = [
        'phone'    =>  self::PHONE,
        'password' =>  self::PASSWORD
    ];








    // Rules Array  -------------------------



    private array $rules  = [
        'required' =>  self::REQUIRED
    ];



    // --------------------------------------

    public static function getErrorCode($field )
    {
        return '';
    }

}


