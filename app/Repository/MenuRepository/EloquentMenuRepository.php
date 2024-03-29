<?php


namespace App\Repository\MenuRepository;


use App\Models\Menu;
use App\Models\MenuJsonInfo;
use App\Models\Product;
use App\Models\WatingToBuildMenuJson;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use function Symfony\Component\Translation\t;
use Hekmatinasser\Verta\Verta;

class EloquentMenuRepository implements MenuRepositoryInterface , WatingToBuildMenuJsonRepositoryInterface
{


    public function addProductMenu($productId, $restrauntId, $price, $discount, $makeups , $photo1 , $photo2 , $photo3)
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
                $this->uploadAddProductMenu($restrauntId , $addProductMenu->id , $photo1 , $photo2 , $photo3 );

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




    public function uploadAddProductMenu( $restrauntId , $productMenuId , $photo1 , $photo2 , $photo3 )
    {
        // Pattern
        //http://127.0.0.1:8000/images/{$restrauntId}/food/{$productMenuId}/1.jpg

        $imagePath = "/images/{$restrauntId}/food/{$productMenuId}/" ;

        // move photo
        $MP1 = $photo1->move(public_path($imagePath) , '1.jpg');
        $MP2 = $photo2->move(public_path($imagePath) , '2.jpg');
        $MP3 = $photo3->move(public_path($imagePath) , '3.jpg');

        if($MP1 && $MP2 && $MP3)
            return true ;
        else
            return true ;
    }




    public function editMenuProduct($menuProductId, $productId, $restrauntId, $price, $discount, $makeups, $editgalleryRestraunt)
    {

        $editMenuProduct = Menu::find($menuProductId);


        $editMenuProduct->product_id = $productId ;
        $editMenuProduct->restraunt_id = $restrauntId ;
        $editMenuProduct->price = $price ;
        $editMenuProduct->discount = $discount ;
        $editMenuProduct->makeup = $makeups ;


        if($editMenuProduct->save())
        {
            $getJoinableMenuProduct =  $this->getJoinAbleMenuProduct($menuProductId);

            $uploadPhoto = $this->uploadEditMenuProduct($restrauntId , $menuProductId , $editgalleryRestraunt);

            if ($uploadPhoto)
            {
                return [
                    'id' => $editMenuProduct->id ,
                    'productid' => $editMenuProduct->product_id ,
                    'restrauntid' => $editMenuProduct->restraunt_id ,
                    'price' => $editMenuProduct->price ,
                    'discount' => $editMenuProduct->discount ,
                    'makeup' => $editMenuProduct->makeup ,
                    'productname' => $getJoinableMenuProduct[0]->productname ,
                    'typename' => $getJoinableMenuProduct[0]->typename ,
                    'maingroupname' => $getJoinableMenuProduct[0]->maingroupname ,
                    'subgroupname' => $getJoinableMenuProduct[0]->subgroupname ,
                    'finalprice' => $getJoinableMenuProduct[0]->finalprice ,
                ];
            }
            else
                return false;
            //todo : remove form database
        }
        else
            return false;

    }




    public function uploadEditMenuProduct($restrauntId , $productMenuId ,  $editgalleryMenuProduct)
    {
        $imagePath = "/images/{$restrauntId}/food/{$productMenuId}/" ;

        $gallery = [ 'photo1' , 'photo2' , 'photo3'];

        $uploadStatus = true ;

        foreach ($gallery as $key => $value)
        {
            if (property_exists($editgalleryMenuProduct , $value))
            {
                $MP1 = $editgalleryMenuProduct->$value->move(public_path($imagePath) , ($key+1).'.jpg');
                if(!$MP1) $uploadStatus = false ;
            }
        }

        return $uploadStatus ;

    }




    public function deleteMenuProduct($menuProductId)
    {


        $menuRestraunt =  Menu::find($menuProductId);
        $deleteMenuProduct = Menu::destroy(intval($menuProductId));


        $menuRestrauntDir = "/images/{$menuRestraunt->restraunt_id}/food/{$menuProductId}" ;

        if ($deleteMenuProduct)
        {
            if (file_exists(public_path($menuRestrauntDir))) {
                $it = new RecursiveDirectoryIterator(public_path($menuRestrauntDir), RecursiveDirectoryIterator::SKIP_DOTS);
                $files = new RecursiveIteratorIterator($it,
                    RecursiveIteratorIterator::CHILD_FIRST);

                foreach($files as $file) {
                    if ($file->isDir()){
                        rmdir($file->getRealPath());
                    } else {
                        unlink($file->getRealPath());
                    }
                }
                rmdir(public_path($menuRestrauntDir));
                return true;
            }

            return false ;
        }

        return false ;


    }




    public function getRestrauntMenuTable($restrauntId)
    {

        return DB::select(
            "select
                        `menu`.`id`  as `menuId`,
                        `menu`.`price` as `menuprice`,
                        `menu`.`discount` as `menudiscount`,
                        `menu`.`makeup` as `menumakeup`,
                        `products`.`name` as `productname`,
                        `types`.`name` as `typename`,
                        `maingroups`.`name` as `maingroupname`,
                        `subgroups`.`name` as `subgroupname` ,
                        `menu`.`price` - ((`menu`.`price` * `menu`.`discount`)/100) as `finalprice`

                    from `menu`

                    inner join `products` on `products`.`id` = `menu`.`product_id`
                    inner join `types` on `types`.`id` = `products`.`type`
                    inner join `maingroups` on `maingroups`.`id` = `products`.`maingroup`
                    inner join `subgroups` on `subgroups`.`id` = `products`.`subgroup`

                    WHERE `menu`.`restraunt_id` = ?"
            , ["{$restrauntId}"]);

    }




    public function getMenuTable($restrauntId, $paginationnumber)
    {
        return DB::table('menu')
            ->join('products', 'products.id', '=', 'menu.product_id')
            ->join('types', 'types.id', '=', 'products.type')
            ->join('maingroups', 'maingroups.id', '=', 'products.maingroup')
            ->join('subgroups', 'subgroups.id', '=', 'products.subgroup')
            ->select([
                'menu.id as menuid' ,
                'menu.price as menuprice' ,
                'menu.discount as menudiscount',
                'menu.makeup as menumakeup',
                'products.name as productname' ,
                'menu.product_id as productid' ,
                'types.name as typename' ,
                'maingroups.name as maingroupname',
                'subgroups.name as subgroupname' ,
                'menu.isexist' ,
            ])->where('restraunt_id' ,'=' , $restrauntId)
            ->paginate($paginationnumber);
    }




    public function getJoinAbleMenuProduct($menuProductId)
    {
        return DB::select(
            "select
                        `menu`.`id`  as `menuId`,
                        `products`.`name` as `productname`,
                        `types`.`name` as `typename`,
                        `maingroups`.`name` as `maingroupname`,
                        `subgroups`.`name` as `subgroupname` ,
                        `menu`.`price` - ((`menu`.`price` * `menu`.`discount`)/100) as `finalprice`

                    from `menu`

                    inner join `products` on `products`.`id` = `menu`.`product_id`
                    inner join `types` on `types`.`id` = `products`.`type`
                    inner join `maingroups` on `maingroups`.`id` = `products`.`maingroup`
                    inner join `subgroups` on `subgroups`.`id` = `products`.`subgroup`

                    WHERE `menu`.`id` = ?"
            , ["{$menuProductId}"]);
    }




    public function insertCreateMenuJson($restrauntId)
    {


        $createMenuJsonRequest = new WatingToBuildMenuJson();


        $createMenuJsonRequest->timestamp    =   time()    ;
        $createMenuJsonRequest->restraunt_id =   $restrauntId  ;


        if ($createMenuJsonRequest->save())
            return true  ;
        else
            return false ;


    }




    public function updateCreateMenuJson($restrauntId)
    {

        $updateMenuJsonRequest = DB::table('wating_to_build_menu_jsons')
                                     ->where('restraunt_id', $restrauntId)
                                     ->update(['timestamp' => time()]);

         if ($updateMenuJsonRequest)
             return true ;
         else
             return false ;

    }




    public function IsExistCreateMenuJsonRequest($restrauntId)
    {
        return WatingToBuildMenuJson::where('restraunt_id' , '=' , $restrauntId)->exists();
    }


    public function getMenuJsonRequestList()
    {
        $getMenuJsonRequestList =  DB::table('wating_to_build_menu_jsons')
                                    ->join('restraunts', 'restraunts.id', '=', 'wating_to_build_menu_jsons.restraunt_id')
                                    ->get([
                                        'wating_to_build_menu_jsons.restraunt_id' ,
                                        'restraunts.name' ,
                                        'restraunts.code' ,
                                        'wating_to_build_menu_jsons.timestamp as menujsoncreatetimestamp' ,
                                    ]);

        if ($getMenuJsonRequestList)
            return $getMenuJsonRequestList ;
        else
            return false;
    }



    public function createMenuJsonTransaction($restrauntId)
    {

        $menuInMenuJsonInfo =  MenuJsonInfo::where('restraunt_id' , $restrauntId);


        DB::beginTransaction();

        try {

            DB::delete('delete from wating_to_build_menu_jsons where restraunt_id = ?',[$restrauntId]);


            if($menuInMenuJsonInfo->exists())
                DB::update('UPDATE `menu_json_info` SET  `restraunt_id` = ?, `create_timestamp` = ? WHERE `menu_json_info`.`restraunt_id` = ?; ' ,[  $restrauntId , time() , $restrauntId , $menuInMenuJsonInfo->get()->first()->id]);
            else
                DB::insert('INSERT INTO `menu_json_info` (`id`, `restraunt_id`, `create_timestamp`) VALUES (null ,?,?)' , [$restrauntId , time()]);


            DB::commit();
            return true ;

        } catch (\Exception $e) {

            DB::rollback();
            return false ;
        }

    }


    public function setStockStatus ( $id ,  $status )
    {
       $result =  DB::update('UPDATE `menu` SET `isexist` = ? WHERE `menu`.`id` = ?; ' ,[  $status , $id] );


       if ($result)
           return true  ;
       else
           return false ;
    }

}
