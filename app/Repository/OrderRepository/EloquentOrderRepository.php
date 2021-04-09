<?php


namespace App\Repository\OrderRepository;


use App\Models\Order;

class EloquentOrderRepository implements OrderRepositoryInterface
{



    public function getNewRestrauntOrders( $restrauntCode )
    {
        return 'this is getNewRestrauntOrders from Eloquent Repository' ;
    }



    public function getAllRestrauntOrders( $restrauntCode )
    {
        $getAllRestrauntOrders = Order::with(['OrderItems' => function($q){

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

        return $getAllRestrauntOrders ;
    }



}
