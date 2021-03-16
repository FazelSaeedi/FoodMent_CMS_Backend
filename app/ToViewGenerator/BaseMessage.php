<?php


namespace App\ToViewGenerator;


interface BaseMessage
{

    public function getJsonMobileView();


    public function getJsonDeviceView();


    public function getJsonWebBrowserView();

}
