<?php


namespace App\Repository\OrderRepository;


interface OrderRepositoryInterface
{


    public function getNewRestrauntOrders( $restrauntCode );



    public function getAllRestrauntOrders( $restrauntCode );



    public function getNewOrders($restrauntCode);



    public function getNewOrderItems($restrauntCode);



    public function getAllOrders($restrauntCode);



    public function getAllOrderItems($restrauntCode);



}
