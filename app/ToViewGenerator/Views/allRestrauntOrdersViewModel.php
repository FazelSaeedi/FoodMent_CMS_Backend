<?php


namespace App\ToViewGenerator\Views;


use App\ToViewGenerator\BaseMessage;

class allRestrauntOrdersViewModel implements BaseMessage
{


    private array $data;


    public function __construct($data)
    {
        $this->data = $data;
    }


    public function getJsonMobileView()
    {
        $array = [];

        foreach ($this->data[0] as $row) {
            array_push($array, $row);
        }

        return [json_encode($array)];

   /*     $data = json_encode($this->data);
        $data = json_decode($data, true);

        return [json_encode($this->data)];*/

        $array = [];

        foreach ($this->data as $row) {
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
        $array = [];

        foreach ($this->data[0] as $row) {
            array_push($array, $row);
        }

        return $array;
    }


}
