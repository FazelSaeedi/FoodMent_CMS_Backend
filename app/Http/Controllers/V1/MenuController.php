<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AddMenuProductRequest;
use App\Http\Requests\V1\CreateMenuJsonRequest;
use App\Http\Requests\V1\DeleteMenuProductRequest;
use App\Http\Requests\V1\EditMenuProductRequest;
use App\Http\Requests\V1\getRestrauntMenuTable;
use App\Http\Requests\V1\getRestrauntMenuTableRequest;
use App\Repository\MenuRepository\MenuRepositoryInterface;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Object_;

class MenuController extends Controller
{

    protected $menuRepository ;



    public function __construct(MenuRepositoryInterface $menuRepository)
    {
        $this->menuRepository = $menuRepository ;
    }



    public function addMenuProduct(AddMenuProductRequest $request)
    {



        $addMenuProduct = $this->menuRepository->addProductMenu($request->productid , $request->restrauntid , $request->price , $request->discount , $request->makeups , $request->file('photo')) ;


        if ($addMenuProduct)
            return response()->json([
                'data' => [
                    $addMenuProduct['data']
                ],
                'message' => 'success'
            ],200);
        else
            return response()->json([
                'message' => 'محصول مورد نظر موجود میباشد'
            ],409);
    }



    public function editMenuProduct(EditMenuProductRequest $request)
    {



        $galleryPhoto = [$request->file('photo1')];
        $gallerySrC   = [$request->srcphoto1 ];
        $ValidateEditMenuProductArray = $this->editPhotoMenuProductValidate($galleryPhoto , $gallerySrC);

        $editgalleryMenuProduct = new Object_();
        if ($ValidateEditMenuProductArray['status'] == true )
        {

            foreach ($ValidateEditMenuProductArray['data'] as $key => $value){
                if (isset($value['file']))
                    $editgalleryMenuProduct->$key = $value['file'] ;
            }


            $editMenuProduct =  $this->
                                menuRepository->
                                editMenuProduct(
                                    $request->id ,
                                    $request->productid ,
                                    $request->restrauntid ,
                                    $request->price ,
                                    $request->discount ,
                                    $request->makeups ,
                                    $editgalleryMenuProduct
                                );

            if ($editMenuProduct)
            {
                return response()->json([
                    'data' => $editMenuProduct
                    ,
                    'message' => 'success'
                ],200);
            }else{
                return response()->json([
                    'message' => 'Error'
                ],409);
            }

        }else{
            return response()->json([
                'message' => 'Error' ,
                'errors' => [
                    'photo' => "خطا در آ‍پلود عکس" ,
                ]
            ],409);
        }


    }



    public function deleteMenuProduct(DeleteMenuProductRequest $request)
    {
        $deleteMenuRestraunt =  $this->menuRepository->deleteMenuProduct($request->id) ;

        if ($deleteMenuRestraunt)
        {
            return response()->json([
                'message' => 'success'
            ],200);
        }else{
            return response()->json([
                'message' => 'Error'
            ],409);
        }
    }



    public function getRestrauntMenuTable(getRestrauntMenuTableRequest $request )
    {
        $getRestrauntMenuTable =  $this->menuRepository->getRestrauntMenuTable($request->restrauntid);




        if ($getRestrauntMenuTable)
        {
            return response()->json([
                'data' => $getRestrauntMenuTable,
                'message' => 'success'
            ],200);
        }else{
            return response()->json([
                'message' => 'Error'
            ],409);
        }

    }



    public function editPhotoMenuProductValidate($galleryPhoto , $gallerySrC)
    {

        $ValidateEditMenuProductArray = [
            'status' => true ,
            'data' => [
                'photo1' => [] ,
            ],
            'message' => ''
        ];



        for ($i = 0 ; $i < count($galleryPhoto) ; $i++)
        {
            if (file_exists($galleryPhoto[$i]))
                $ValidateEditMenuProductArray['data']['photo'.($i+1)]['file'] = $galleryPhoto[$i];
            else if (isset($gallerySrC[$i]))
                $ValidateEditMenuProductArray['data']['photo'.($i+1)]['src'] = $gallerySrC[$i];
            else
                $ValidateEditMenuProductArray['status'] = false ;
        }


        return $ValidateEditMenuProductArray;
    }



    public function getMenuJson( $restrauntid )
    {

         $getRestrauntMenuTable =  $this->menuRepository->getRestrauntMenuTable($restrauntid);

         $menuJson = [];

        foreach ($getRestrauntMenuTable as $key => $value ){
            $menuJson[$value->typename][$value->maingroupname][$value->subgroupname][$value->menuId] = $value ;
         }


        return json_encode($menuJson);

    }



    public function createMenuJson(CreateMenuJsonRequest $request)
    {
        $menuJson = $this->getMenuJson($request->restrauntid);

        $data = [
            'information' => [
                'restrauntid' => 1 ,
                'create_at' => 132654984,
                'key' => '$851das2e12651'
            ],
            'data' => json_decode($menuJson)
        ];


        $fp = fopen("../public/images/{$request->restrauntid}/menu.json", 'w');
        fwrite($fp, json_encode($data) );
        fclose($fp);

        return $data ;

    }

}
