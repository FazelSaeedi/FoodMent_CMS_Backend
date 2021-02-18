<?php


namespace App\Repository\MenuRepository;


interface MenuRepositoryInterface
{
    public function addProductMenu($productId , $restrauntId , $price , $discount , $makeups , $photo1 );

    public function uploadAddProductMenu( $restrauntId , $productMenuId , $photo1 ) ;
}
