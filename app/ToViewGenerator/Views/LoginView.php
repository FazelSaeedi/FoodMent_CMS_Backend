<?php


namespace App\ToViewGenerator\Views;


use App\ToViewGenerator\BaseMessage;
use App\ToViewGenerator\Message;
use phpDocumentor\Reflection\Types\This;

class LoginView implements BaseMessage
{


    private array $data ;


    public function __construct( $data )
    {
        $this->data = $data ;
    }




    public function getJsonMobileView()
    {

        return [json_encode($this->data)];
    }



    public function getJsonDeviceView()
    {
        return $this->data ;
    }



    public function getJsonWebBrowserView()
    {
        return $this->data ;
    }


}


