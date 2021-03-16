<?php


namespace App\ToViewGenerator\Views;


use App\ToViewGenerator\BaseMessage;

class TestView implements BaseMessage
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
            //array_push($array, toJsonString($row['Email'] , $row['Active'] , $row['CreatedDate'] , $row['Roles'][0] , $row['Roles'][1]));
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


    function toJsonString ( $email , $active , $CreateDate , $firstname , $lastname  )
    {
        return "{\"Email\":\"{$email}\",\"Active\":{$active},\"CreatedDate\":\"{$CreateDate}\",\"Roles\":[\"{$firstname}\",\"{$lastname}\"]}";
    }

}
