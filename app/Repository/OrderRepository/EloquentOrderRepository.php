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
                'order_id' , 'menuproductId as 7' , 'count as 5' ,
                'price as 0' , 'discountrate as 4' , 'totalprice as 3'
            );

        }])
            ->where('restraunt_code' , $restrauntCode )
            ->where('isrestrauntconfirmed' , false)
            ->get([
                'id' , 'userid' , 'totalamount as 0' , 'totalprice as 1'
                , 'isuserrequested as 6', 'isrestrauntaccepted as 5', 'isCanceled as 3' ,
                'ispaid as 8' , 'isdelivered as 7' , 'isrestrauntconfirmed as 9'
            ]);

        return $getAllRestrauntOrders ;
    }



}
