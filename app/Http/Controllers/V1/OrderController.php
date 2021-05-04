<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\GetAllRestrauntOrdersRequest;
use App\Http\Requests\V1\GetNewRestrauntOrdersRequest;
use App\Http\Requests\V1\GetPeyerInformationRequest;
use App\Http\Requests\V1\restaurantAcceptOrderRequest;
use App\Http\Requests\V1\RestaurantBakeOrderRequest;
use App\Http\Requests\V1\RestaurantCanselOrderRequest;
use App\Http\Requests\V1\RestaurantSendOrderRequest;
use App\Http\Requests\V1\UserPayOrderRequest;
use App\Models\Order;
use App\Repository\OrderRepository\OrderRepositoryInterface;
use App\ToViewGenerator\MessageController;
use App\ToViewGenerator\Views\AcceptRestrauntOrderViewModel;
use App\ToViewGenerator\Views\allRestrauntOrdersViewModel;
use App\ToViewGenerator\Views\GetPayerInformationViewModel;
use App\ToViewGenerator\Views\newRestrauntOrdersViewModel;
use App\ToViewGenerator\Views\RestaurantBakeOrderViewModel;
use App\ToViewGenerator\Views\RestaurantCanselOrderViewModel;
use App\ToViewGenerator\Views\UserPayOrderViewModel;
use Illuminate\Http\Response;


class OrderController extends Controller
{


    protected $orderRepository ;



    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository ;
    }



    public function getOrders( $restrauntCode )  // TEST()
    {

        /*
        $orders = \App\Models\Order::with(['OrderItems' => function($q){
            $q->where('order_items.id' , '=' , '1');
            $q->select( 'order_id');
        }])
            ->get(['id']);
        */
        $orders = Order::with(['OrderItems' => function($q){

            // $q->where('order_items.id' , '=' , '1');

             $q->select(
                 'order_id' , 'menuproductId' , 'count' ,
                 'price' , 'discountrate' , 'totalprice'
             );

        }])
            ->where('restraunt_code' , $restrauntCode )
            ->where('isrestrauntconfirmed' , false)
            ->get([
                'id' , 'userid' , 'totalamount' , 'totalprice'
                , 'isuserrequested', 'isrestrauntaccepted', 'isCanceled' ,
                'ispaid' , 'isdelivered' , 'isrestrauntconfirmed'
            ]);


        return $orders ;
    }



    public function getNewRestrauntOrders( GetNewRestrauntOrdersRequest $request , $restrauntCode)
    {
        $getNewOrders = $this->orderRepository->getNewOrders( $restrauntCode );
        $getNewOrderItems = $this->orderRepository->getNewOrderItems( $restrauntCode );

        // $getNewRestrauntOrders = $this->orderRepository->getNewRestrauntOrders( $restrauntCode );

        return MessageController::sendMessage(200 , [] , [
            $getNewOrders , $getNewOrderItems
        ] , newRestrauntOrdersViewModel::class );

    }



    public function getAllRestrauntOrders( GetAllRestrauntOrdersRequest $request , $restrauntCode )
    {

        $getAllOrders = $this->orderRepository->getAllOrders( $restrauntCode );
        $getAllOrderItems = $this->orderRepository->getAllOrderItems( $restrauntCode );

        /*return [$getAllOrders , $getAllOrderItems];
        exit();*/

        //$getAllRestrauntOrders = $this->orderRepository->getAllRestrauntOrders( $restrauntCode );

        return MessageController::sendMessage(200 , [] , [
            $getAllOrders , $getAllOrderItems
        ] , allRestrauntOrdersViewModel::class );

    }



    public function restaurantAcceptOrder( restaurantAcceptOrderRequest $request , $restaurantCode , $orderId , $status)
    {
        $result = false ;

        if ($status == true)
            $result  = $this->orderRepository->restaurantAcceptOrder($orderId);
        else
            $result = $this->orderRepository->restaurantCanselOrder($orderId);

        if ($result)
            return MessageController::sendMessage(200 , [] , [] , AcceptRestrauntOrderViewModel::class );
        else
            return MessageController::sendMessage(Response::HTTP_INTERNAL_SERVER_ERROR , [] , [] , AcceptRestrauntOrderViewModel::class );

    }



    public function userPayOrder( UserPayOrderRequest $request , $restaurantCode , $orderId , $status )
    {

        $result = false ;

        if ($status == true)
            $result  = $this->orderRepository->userPayOrder( $orderId );
        else
            $result = $this->orderRepository->userCancelpayOrder( $orderId );

        if ($result)
            return MessageController::sendMessage(Response::HTTP_OK , [] , [] , UserPayOrderViewModel::class );
        else
            return MessageController::sendMessage(Response::HTTP_INTERNAL_SERVER_ERROR , [] , [] , UserPayOrderViewModel::class );

    }



    public function restaurantBakeOrder (RestaurantBakeOrderRequest $request , $restaurantCode , $orderId , $status)
    {
        $result = false ;

        if ($status == true)
            $result  = $this->orderRepository->restaurantBakeOrder( $orderId );
        else
            $result = false;


        if ($result)
            return MessageController::sendMessage(Response::HTTP_OK , [] , [] , RestaurantBakeOrderViewModel::class );
        else
            return MessageController::sendMessage(Response::HTTP_INTERNAL_SERVER_ERROR , [] , [] , RestaurantBakeOrderViewModel::class );

    }



    public function restaurantSendOrder (RestaurantSendOrderRequest $request , $restaurantCode , $orderId , $status)
    {
        $result = false ;

        if ($status == true)
            $result  = $this->orderRepository->restaurantSendOrder( $orderId );
        else
            $result = false;


        if ($result)
            return MessageController::sendMessage(Response::HTTP_OK , [] , [] , RestaurantBakeOrderViewModel::class );
        else
            return MessageController::sendMessage(Response::HTTP_INTERNAL_SERVER_ERROR , [] , [] , RestaurantBakeOrderViewModel::class );

    }



    public function restaurantCanselOrder ( RestaurantCanselOrderRequest $request , $restaurantCode , $orderId )
    {

        // return $request->description ."-".$restaurantCode."-".$orderId;


        $result  = $this->orderRepository->cansel( $orderId , $request->description );


        if ($result)
            return MessageController::sendMessage(Response::HTTP_OK , [] , [] , RestaurantCanselOrderViewModel::class );
        else
            return MessageController::sendMessage(Response::HTTP_INTERNAL_SERVER_ERROR , [] , [] , RestaurantCanselOrderViewModel::class );


    }



    public function getPayerInformation(GetPeyerInformationRequest $request , $restaurantCode , $orderId)
    {
        $result =  $this->orderRepository->getPayerInformation($orderId);

        if ($result)
            return MessageController::sendMessage(Response::HTTP_OK , [] , [$result] , GetPayerInformationViewModel::class );
        else
            return MessageController::sendMessage(Response::HTTP_INTERNAL_SERVER_ERROR , [] , [] , GetPayerInformationViewModel::class );

    }
}
