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
        return 'addmenuproduct' ;
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
