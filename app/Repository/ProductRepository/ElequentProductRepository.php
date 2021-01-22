<?php

namespace App\Repository\ProductRepository;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ElequentProductRepository implements ProductRepositoryInterface
{


    public function addProduct( $name , $typeID , $mainGroupID , $subGroupID , $code )
    {

        $addProduct = new Product();



        $addProduct->name = $name ;
        $addProduct->type = $typeID ;
        $addProduct->subGroup = $subGroupID ;
        $addProduct->mainGroup = $mainGroupID ;
        $addProduct->code = $code ;



         if($addProduct->save())
         {
            return $addProduct;
         }
         else
             return false;

    }


    public function editProduct($id, $name, $typeID, $mainGroupID, $subGroupID, $code)
    {

        $editProduct = Product::find($id);

        $editProduct->name = $name ;
        $editProduct->type = $typeID ;
        $editProduct->maingroup = $mainGroupID ;
        $editProduct->subgroup = $subGroupID ;
        $editProduct->code = $code ;



        $isValidEdit =  Product::where('type' , $typeID )
                        ->where('name' , $name )
                        ->where('maingroup' , $mainGroupID )
                        ->where('subgroup' , $subGroupID )
                        ->where('code' , $code )
                        ->get()->first();

        if($isValidEdit)
            return false;
        else{
            $editProduct->save();
            return $editProduct ;
        }



        // print_r($test);

        // return $editProduct->save() ;


    }


    public function selectOneProduct($by = false , $id = 0 , $detailArray = [])
    {


        if($by and $id > 0)
            return Product::find($id)->get();



        return Product::where('type' , $detailArray['typeID'])
                      ->where('maingroup' , $detailArray['mainGroupID'])
                      ->where('subgroup' , $detailArray['subGroupID'])
                      ->where('code' , $detailArray['code'])
                      ->get()->first();

    }
}
