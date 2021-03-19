<?php


namespace App\ToViewGenerator;


use App\Http\Controllers\Controller;
use App\ToViewGenerator\Views\LoginView;


class MessageController
{



    public static function sendMessage( $statusCode , $errors  , $data , $view )
    {


        $message  =  new Message()                  ;
        $view     =  new $view($data)               ;


        $message->setStatusCode($statusCode)
                ->setDatetime(time())
                ->setPacketcount( count($data) )
                ->setErrors($errors);

        $type = $_SERVER['HTTP_USER_AGENT'];




        switch ( $type )
        {

            case 'MOBILE':
                $message->setData($view->getJsonMobileView());
                return $message->getJsonMobileView();




            case 'DEVICE':
                $message->setData($view->getJsonDeviceView());
                return $message->getJsonDeviceView();




            case 'WEB':
                $message->setData($view->getJsonWebBrowserView());
                return $message->getJsonWebBrowserView();



            default:
                $message->setData($view->getJsonWebBrowserView());
                return $message->getJsonWebBrowserView();

        }



    }


    public static function setLogMessage(){}

}
