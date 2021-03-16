<?php


namespace App\ToViewGenerator;


class Message implements BaseMessage
{



    private int   $statusCode   ;
    private int   $packetcount  ;
    private int   $datetime     ;
    private array $data         ;
    private array $errors       ;


    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
    public function setStatusCode(int $statusCode): Message
    {
        $this->statusCode = $statusCode;
        return $this;
    }


    public function getPacketcount(): int
    {
        return $this->packetcount;
    }
    public function setPacketcount(int $packetcount): Message
    {
        $this->packetcount = $packetcount;
        return $this;

    }


    public function getDatetime(): int
    {
        return $this->datetime;
    }
    public function setDatetime(int $datetime): Message
    {
        $this->datetime = $datetime;
        return $this;
    }


    public function getData(): array
    {
        return $this->data;
    }
    public function setData(array $data): Message
    {
        $this->data = $data;
        return $this;
    }


    public function getErrors(): array
    {
        return $this->errors;
    }
    public function setErrors(array $errors): Message
    {
        $this->errors = $errors;
        return $this;
    }




    public function getJsonMobileView()
    {

        return response()->json([
           'statusCode'  =>  $this->getStatusCode()  ,
           'packetCount' =>  $this->getPacketcount() ,
           'datetime'    =>  $this->getDatetime()    ,
           'data'        =>  $this->getData()        ,
           'errors'      =>  $this->getErrors()
        ]);

    }



    public function getJsonDeviceView()
    {
        return "statusCode:{$this->getStatusCode()}#packetCount:0#datetime:32156151561#data:[]#errors:[]" ;
    }



    public function getJsonWebBrowserView()
    {
        return response()->json([
            'statusCode'  =>  $this->getStatusCode()  ,
            'packetCount' =>  $this->getPacketcount() ,
            'datetime'    =>  $this->getDatetime()    ,
            'data'        =>  $this->getData()        ,
            'errors'      =>  $this->getErrors()
        ]);
    }





}


