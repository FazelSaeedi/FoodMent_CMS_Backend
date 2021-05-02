<?php


namespace App\Repository\MenuRepository;


interface MenuRepositoryInterface
{
    public function addProductMenu($productId , $restrauntId , $price , $discount , $makeups , $photo1 , $photo2 , $photo3 );

    public function uploadAddProductMenu( $restrauntId , $productMenuId , $photo1 , $photo2 , $photo3 ) ;

    public function editMenuProduct($menuProductId , $productId , $restrauntId , $price , $discount , $makeups , $editgalleryRestraunt );

    public function uploadEditMenuProduct($restrauntId , $productMenuId , $editgalleryMenuProduct);

    public function deleteMenuProduct($menuProductId);

    // this is for create menu json
    public function getRestrauntMenuTable( $restrauntId );


    // this is for CMS that return with pagination
    public function getMenuTable($restrauntId , $paginationnumber );

    public function getJoinAbleMenuProduct( $menuProductId );

    public function createMenuJsonTransaction( $restrauntId );

    public function setStockStatus ( $id ,  $status );

}
