<?php


namespace App\ToViewGenerator\Views;


use App\ToViewGenerator\BaseMessage;

class RestaurantBakeOrderViewModel implements BaseMessage
{


    private array $data;


    public function __construct($data)
    {
        $this->data = $data;
    }


    public function getJsonMobileView()
    {
        return [];
    }


    public function getJsonDeviceView()
    {
        return [];
    }


    public function getJsonWebBrowserView()
    {
        return [];
    }


}
