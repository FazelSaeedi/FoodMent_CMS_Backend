<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\GetAllRestrauntOrdersRequest;
use App\Http\Requests\V1\GetNewRestrauntOrdersRequest;
use App\Models\Order;
use App\Repository\OrderRepository\OrderRepositoryInterface;


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
        return $this->orderRepository->getAllRestrauntOrders();
       // return 'getNewRestrauntOrders';
    }


    public function getAllRestrauntOrders( GetAllRestrauntOrdersRequest $request , $restrauntCode )
    {
        return $this->orderRepository->getNewRestrauntOrders();
        // return 'getAllRestrauntOrders';
    }

}
