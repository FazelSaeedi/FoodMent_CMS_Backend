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
use App\Models\Address;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repository\OrderRepository\OrderRepositoryInterface;
use App\ToViewGenerator\MessageController;
use App\ToViewGenerator\Views\AcceptRestrauntOrderViewModel;
use App\ToViewGenerator\Views\allRestrauntOrdersViewModel;
use App\ToViewGenerator\Views\GetPayerInformationViewModel;
use App\ToViewGenerator\Views\newRestrauntOrdersViewModel;
use App\ToViewGenerator\Views\RestaurantBakeOrderViewModel;
use App\ToViewGenerator\Views\RestaurantCanselOrderViewModel;
use App\ToViewGenerator\Views\UserPayOrderViewModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


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



    public function buyProduct(Request $request)
    {

        $array = $this->getOrderItemIdListArray($request->orderItemList);
        $result = $this->orderRepository->getOrderItemsInfo($array , $request->restaurantId);




        // todo : badan bayad ino bebaram dakhel repository
        $transactionStatus = false;
        if (count($result) == count($request->orderItemList) )
        {
            DB::beginTransaction();
            try
            {

                $addressesId = DB::table('addresses')->insertGetId([
                    'address'     => $request->address,
                    'location'    => $request->location,
                    'city_id'     => $request->city_id,
                    'province_id' => $request->province_id,
                ]);
                $createAndGetOrderId = DB::table('orders')->insertGetId([
                    'userid' => $request->Claimid ,
                    'totalamount' => 0 ,
                    'totalprice' => 0 ,
                    'discountprice' => 0 ,
                    'taxprice' => 0 ,
                    'finalprice' => 0 ,
                    'deliveryprice' => 0 ,
                    'userdescription' => $request->description ,
                    'restraunt_id' => $request->restaurantId ,
                    'restraunt_code' => $request->restaurantCode ,
                    'address_id' => $addressesId ,
                    'isuserrequested' => 1 ,
                    'created_at' => Carbon::now() ,
                    'updated_at' => Carbon::now()
                ]);

                $finalResult = [];
                $totalamount = 0 ;
                $wholePrice = 0 ;
                $wholeDiscountPrice = 0 ;
                $wholeTaxPrice = 0 ;
                $deliveryPrice = 0 ;
                $wholeFinalPrice = $deliveryPrice ;


                foreach ($result as $key => $item)
                {

                    $count = $request->orderItemList[$item->id];
                    $price = $item->price ;
                    $discountRate = $item->discount ;
                    $taxRate = 0 ;

                    $totalPrice     =  $this->calculateTotalPrice($price , $count) ;
                    $discountPrice  =  $this->calculateDiscountPrice($totalPrice , $discountRate);
                    $taxPrice       =  $this->calculateTaxPrice(($totalPrice - $discountPrice) , $taxRate);
                    $finalprice     =  $this->calculateFinalPrice($totalPrice ,  $discountPrice , $taxPrice) ;




                    $result[$key]->count = $request->orderItemList[$item->id];

                    $wholePrice =  $wholePrice  + $totalPrice   ;
                    $totalamount = $totalamount + $request->orderItemList[$item->id] ;
                    $wholeDiscountPrice = $wholeDiscountPrice + $discountPrice ;
                    $wholeTaxPrice = $wholeTaxPrice + $taxPrice ;
                    $wholeFinalPrice = $wholeFinalPrice + $finalprice ;

                    $resultArray = [
                        'order_id' => $createAndGetOrderId ,
                        'menuproductid' => $item->id ,
                        'count' => $request->orderItemList[$item->id] ,
                        'price' => $item->price ,
                        'discountrate'=> $item->discount,
                        'totalprice' => $totalPrice ,
                        'finalprice' => $finalprice ,
                        'taxrate' => $taxRate ,
                        'created_at' => Carbon::now() ,
                        'updated_at' => Carbon::now()
                    ] ;

                    array_push($finalResult , $resultArray );

                }



                DB::update('UPDATE `orders` SET `totalamount` = ? , `totalprice` = ? , `discountprice` = ? , `taxPrice` = ? , `finalprice` = ? WHERE `orders`.`id` = ?;' , [$totalamount , $wholePrice , $wholeDiscountPrice , $wholeTaxPrice , $wholeFinalPrice , $createAndGetOrderId]);
                DB::table('order_items')->insert($finalResult); // Query Builder approach*/
                DB::commit();

                $transactionStatus = true ;
            }
            catch (\Exception $e)
            {

                DB::rollback();
                $transactionStatus = false ;

            }
        }


        if ($transactionStatus)
            return $finalResult ;
        else
            return 'false';

    }



    public function getOrderItemIdListArray( $orderItemJsonRequest )
    {
        $array = array();

        foreach ($orderItemJsonRequest as $key => $item)
        {
            array_push($array, $key);
        }

        return $array ;
    }



    public function calculateDiscountPrice ( $price , $discountRate)
    {
        if ($discountRate > 0 )
            return  ($price * ($discountRate / 100)) ;

        return 0;
    }



    public function calculateTaxPrice ( $price  , $taxRate )
    {

        if ($taxRate > 0 )
            return   ($price * ($taxRate / 100)) ;

        return 0;
    }



    public function calculateTotalPrice ( $price , $count  )
    {
        return $price * $count ;
    }



    public function calculateFinalPrice ( $totalPrice , $discountPrice ,  $taxPrice  )
    {
        return ( $totalPrice - $discountPrice ) + $taxPrice ;
    }



}
