<?php


namespace App\Repository\MenuRepository;


interface MenuRepositoryInterface
{
    public function addProductMenu($productId , $restrauntId , $price , $discount , $makeups , $photo1 );

    public function uploadAddProductMenu( $restrauntId , $productMenuId , $photo1 ) ;

    public function editMenuProduct($menuProductId , $productId , $restrauntId , $price , $discount , $makeups , $editgalleryRestraunt );

    public function uploadEditMenuProduct($restrauntId , $productMenuId , $editgalleryMenuProduct);

    public function deleteMenuProduct($menuProductId);

    public function getRestrauntMenuTable( $restrauntId );

}
