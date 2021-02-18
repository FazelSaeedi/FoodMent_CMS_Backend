<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AddMenuProductRequest;
use App\Repository\MenuRepository\MenuRepositoryInterface;
use Illuminate\Http\Request;

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

    public function editMenuProduct()
    {
        return 'editmenuproduct' ;
    }

    public function deleteMenuProduct()
    {
        return 'deletemenuproduct' ;
    }

    public function getRestrauntMenu()
    {
        return 'getrestrauntmenu' ;
    }
}
