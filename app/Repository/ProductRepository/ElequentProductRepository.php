<?php

namespace App\Repository\ProductRepository;


use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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


        $editProduct->save();
        return $editProduct ;


        $isValidEdit =  Product::where('type' , $typeID )
                        ->where('name' , $name )
                        ->where('maingroup' , $mainGroupID )
                        ->where('subgroup' , $subGroupID )
                        ->where('code' , $code )
                        ->get()->first();

        /*if($isValidEdit)
            return false;
        else{
            $editProduct->save();
            return $editProduct ;
        }*/



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


    public function getProductTable($paginationNumber)
    {
        /*return DB::table('products')
            ->join('types', 'products.type', '=', 'types.id')
            ->orderBy('code', 'asc')->paginate($paginationNumber);*/

        return DB::table('products')
            ->join('types', 'types.id', '=', 'products.type')
            ->join('maingroups', 'maingroups.id', '=', 'products.maingroup')
            ->join('subgroups', 'subgroups.id', '=', 'products.subgroup')
            ->select([
                'products.id as productid' ,
                'products.name as productname' ,
                'products.code as productcode' ,
                'types.name as typename' ,
                'maingroups.name as maingroupname' ,
                'subgroups.name as subgroupname' ,
                'types.id as typeid' ,
                'maingroups.id as maingroupid' ,
                'subgroups.id as subgroupid'
            ])
            ->orderBy('products.code', 'asc')
            ->paginate($paginationNumber);

    }


    public function deleteProduct($id)
    {
        $existMenuItenByThisProductId = Menu::where('product_id', '=', $id )->exists();

        if ($existMenuItenByThisProductId)
            return false;
        else{
            return Product::destroy(intval($id));
        }

    }

    public function getProductList()
    {
        return Product::all('id' , 'name');
    }
}
