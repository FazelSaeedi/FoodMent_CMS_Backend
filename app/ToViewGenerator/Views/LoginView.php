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
        $array = array();

        foreach ($this->data as $row)
        {
            array_push($array , json_encode($row));
        }
        return $array ;
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


