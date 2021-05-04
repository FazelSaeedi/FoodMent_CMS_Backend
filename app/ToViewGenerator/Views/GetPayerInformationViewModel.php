<?php


namespace App\ToViewGenerator\Views;


use App\ToViewGenerator\BaseMessage;

class GetPayerInformationViewModel implements BaseMessage
{
    private array $data ;


    public function __construct( $data )
    {
        $this->data = $data ;
    }

    public function getJsonMobileView()
    {

        $array = [];

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
