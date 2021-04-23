<?php


namespace App\Repository\OrderRepository;


use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class EloquentOrderRepository implements OrderRepositoryInterface
{

    public $ISUSERREQUEST          = "A" ;
    public $ISRESTAURANTACCEPT     = "B" ;
    public $ISPAYEDCOAST           = "C" ;
    public $ISBAKING               = "D" ;
    public $ISSENT                 = "E" ;


    // get collection of getNewRestrauntOrders ( with orderItems)
    public function getNewRestrauntOrders( $restrauntCode )
    {
        return 'this is getNewRestrauntOrders from Eloquent Repository' ;
    }



    // get collection of getAllRestrauntOrders ( with orderItems)
    public function getAllRestrauntOrders( $restrauntCode )
    {
        $getAllRestrauntOrders = Order::with(['OrderItems' => function($q){

            $q->select(
                'menu.product_id','order_id' , 'menuproductId' , 'count' ,
                'order_items.price' , 'discountrate' , 'totalprice' , 'products.name'
            );
            $q->join('menu', 'menu.id', '=', 'order_items.menuproductId');
            $q->join('products', 'products.id', '=', 'menu.id');
            //INNER JOIN `products` ON `products`.`id` = `menu`.`id`

        }])
            ->where('restraunt_code' , $restrauntCode )
            ->get([
                'id' , 'userid' , 'totalamount' , 'totalprice'
                , 'isuserrequested', 'isrestrauntaccepted', 'isCanceled' ,
                'ispaid' , 'isdelivered'
            ]);

        return $getAllRestrauntOrders ;
    }



    // get NewOrders Alone
    public function getNewOrders($restrauntCode)
    {

        return DB::select(
            "SELECT orders.id , totalamount , totalprice , refid ,
                          CASE
                               WHEN orders.isuserrequested = 1 AND orders.isrestrauntaccepted = 0 AND orders.ispaid = 0 AND orders.isbaking = 0   THEN '$this->ISUSERREQUEST'
                               WHEN orders.isuserrequested = 1 AND orders.isrestrauntaccepted = 1 AND orders.ispaid = 0 AND orders.isbaking = 0   THEN '$this->ISRESTAURANTACCEPT'
                               WHEN orders.isuserrequested = 1 AND orders.isrestrauntaccepted = 1 AND orders.ispaid = 1 AND orders.isbaking = 0   THEN '$this->ISPAYEDCOAST'
                               WHEN orders.isuserrequested = 1 AND orders.isrestrauntaccepted = 1 AND orders.ispaid = 1 AND orders.isbaking = 1   THEN '$this->ISBAKING'
                               WHEN orders.isuserrequested = 1 AND orders.isrestrauntaccepted = 1 AND orders.ispaid = 1 AND orders.isbaking = 1   THEN '$this->ISSENT'
                          ELSE 'Fail'
                          END AS status

                  FROM `orders`
                  where `orders`.`restraunt_code` = $restrauntCode
                  AND `orders`.`issend` = 0
                  ");
    }



    // get NewOrderItem Alone
    public function getNewOrderItems($restrauntCode)
    {

        return DB::select("
            select `order_id`, `menuproductId`, `count`, `order_items`.`price`, `discountrate`, `order_items`.`totalprice`
            from `order_items`
            inner join `orders` on `orders`.`id` = `order_items`.`order_id`
            where `restraunt_code` = $restrauntCode AND `orders`.`issend` = 0
        ") ;

    }



    // get all Order alone
    public function getAllOrders($restrauntCode)
    {
        $getAllOrders = Order::where('restraunt_code' , $restrauntCode )
                        ->get([
                            'id' , 'userid' , 'totalamount' , 'totalprice'
                            , 'isuserrequested', 'isrestrauntaccepted',
                            'ispaid'
                        ]);

        return $getAllOrders ;
    }



    // get all OrderItems alone
    public function getAllOrderItems($restrauntCode)
    {
        $getAllOrderItems = OrderItem::join('orders', 'orders.id', '=', 'order_items.order_id')
                                       ->where('restraunt_code' , $restrauntCode )
                                       ->get([
                                           'order_id' , 'menuproductId' , 'count' ,
                                           'order_items.price' , 'discountrate' , 'order_items.totalprice'
                                       ]);

        return $getAllOrderItems ;
    }



    // --- Order Processing



    public function userRequestOrder($orderId)
    {
        // TODO: Implement userRequestOrder() method.
    }



    public function restaurantAcceptOrder($orderId)
    {
        // TODO: Implement restrauntAcceptOrder() method.
    }



    public function userPayOrder($orderId)
    {
        // TODO: Implement userPayOrder() method.
    }



    public function restaurantBakeOrder($orderId)
    {
        // TODO: Implement restrauntBakeOrder() method.
    }



    public function restaurantSendOrder($orderId)
    {
        // TODO: Implement restrauntSendOrder() method.
    }
}
