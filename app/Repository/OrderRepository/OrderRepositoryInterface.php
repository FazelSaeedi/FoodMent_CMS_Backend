<?php


namespace App\Repository\OrderRepository;


interface OrderRepositoryInterface
{

    public function getNewRestrauntOrders( $restrauntCode );

    public function getAllRestrauntOrders( $restrauntCode );

}
