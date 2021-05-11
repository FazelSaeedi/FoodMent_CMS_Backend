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


    // --- Order Processing


    public function userRequestOrder( $orderId );



    public function restaurantAcceptOrder( $orderId );



    public function userPayOrder( $orderId );



    public function restaurantBakeOrder( $orderId );



    public function restaurantSendOrder( $orderId );



    public function restaurantCanselOrder( $orderId );



    public function userCancelpayOrder ($orderId ) ;


    public function cansel( $orderId , $description ) ;


    public function getPayerInformation( $orderId ) ;


    public function getOrderItemsInfo( $OrderItemIdListArray , $restaurantId );
}
