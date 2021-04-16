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
        $array0 = [];
        $array1 = [];

        foreach ($this->data[0] as $row) {
            array_push($array0, $row);
        }

        foreach ($this->data[1] as $row) {
            array_push($array1, $row);
        }

        return [ json_encode($array0) , json_encode($array1) ];

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
        $array0 = [];
        $array1 = [];

        foreach ($this->data[0] as $row) {
            array_push($array0, $row);
        }

        foreach ($this->data[1] as $row) {
            array_push($array1, $row);
        }

        return [ $array0 , $array1 ];
    }


}
