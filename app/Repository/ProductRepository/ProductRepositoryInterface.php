<?php

namespace App\Repository\ProductRepository;

interface ProductRepositoryInterface
{

    public function addProduct($name , $typeID , $mainGroupID , $subGroupID , $code );


    public function editProduct( $id , $name , $typeID , $mainGroupID , $subGroupID , $code );


    public function selectOneProduct( $byID = false , $id = 0 , $detailArray = []);


    public function getProductTable( $paginationNumber ) ;


    public function deleteProduct( $id );


    public function getProductList();
}
