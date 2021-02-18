<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AddMenuProductRequest;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function __construct()
    {

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
