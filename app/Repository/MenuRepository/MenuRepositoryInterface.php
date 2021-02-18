<?php


namespace App\Repository\MenuRepository;


interface MenuRepositoryInterface
{
    public function addProductMenu($productId , $restrauntId , $price , $discount , $makeups);
}
