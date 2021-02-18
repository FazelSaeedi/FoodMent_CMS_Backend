<?php


namespace App\Repository\MenuRepository;


use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\Translation\t;

class EloquentMenuRepository implements MenuRepositoryInterface
{

    public function addProductMenu($productId, $restrauntId, $price, $discount, $makeups , $photo1)
    {

        $addProductMenu = new Menu();

        $addProductMenu->product_id   =   $productId   ;
        $addProductMenu->restraunt_id =   $restrauntId ;
        $addProductMenu->price        =   $price       ;
        $addProductMenu->discount     =   $discount    ;
        $addProductMenu->makeup       =   $makeups     ;


        $isProductExist = Menu::where( 'product_id'   ,  '='  , $productId  )
                              ->where( 'restraunt_id' ,  '='  , $restrauntId)
                              ->get();






        if ($isProductExist->isEmpty())
            if($addProductMenu->save())
            {
                $this->uploadAddProductMenu($restrauntId , $addProductMenu->id , $photo1 );

                $prodcutInfo =  DB::table('products')
                    ->join('types', 'types.id', '=', 'products.type')
                    ->join('maingroups', 'maingroups.id', '=', 'products.maingroup')
                    ->join('subgroups', 'subgroups.id', '=', 'products.subgroup')
                    ->select([
                        'products.name as productname' ,
                        'types.name as typename' ,
                        'maingroups.name as maingroupname' ,
                        'subgroups.name as subgroupname' ,
                    ])
                    ->where( 'products.id'   ,  '='  , $productId  )
                    ->get();



                return [
                    'data' => [
                        'id' => $addProductMenu->id ,
                        'productid' => $addProductMenu->product_id ,
                        'restrauntid' => $addProductMenu->restraunt_id ,
                        'price' => $addProductMenu->price ,
                        'discount' => $addProductMenu->discount ,
                        'makeup' => $addProductMenu->makeup ,
                        'productname' => $prodcutInfo[0]->productname ,
                        'typename' => $prodcutInfo[0]->typename ,
                        'maingroupname' => $prodcutInfo[0]->maingroupname ,
                        'subgroupname' => $prodcutInfo[0]->subgroupname ,
                    ]
                ];
            }
            else
                return false;
        else return false ;


    }


    public function uploadAddProductMenu( $restrauntId , $productMenuId , $photo1 )
    {
        // Pattern
        //http://127.0.0.1:8000/images/{$restrauntId}/food/{$productMenuId}/1.jpg

        $imagePath = "/images/{$restrauntId}/food/{$productMenuId}/" ;

        // move photo
        $MP1 = $photo1->move(public_path($imagePath) , '1.jpg');

        if ($MP1)
            return true ;
        else
            return true ;
    }
}
