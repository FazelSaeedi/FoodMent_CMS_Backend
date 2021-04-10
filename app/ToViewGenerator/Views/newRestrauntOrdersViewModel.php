<?php


namespace App\ToViewGenerator\Views;


use App\ToViewGenerator\BaseMessage;

class newRestrauntOrdersViewModel implements BaseMessage
{


    private array $data;



    public function __construct($data)
    {
        $this->data = $data;
    }



    public function getJsonMobileView()
    {
        $data = json_encode($this->data);
        $data = json_decode($data, true);

        return [json_encode($data[0]['data'])];

        $array = [];

        foreach ($data[0]['data'] as $row) {
            array_push($array, json_encode($row));
        }

        return $array;

    }



    public function getJsonDeviceView()
    {
        return $this->data;
    }



    public function getJsonWebBrowserView()
    {
        return $this->data;
    }



}
