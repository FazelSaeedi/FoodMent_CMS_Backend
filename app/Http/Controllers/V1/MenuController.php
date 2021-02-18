<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function __construct()
    {

    }


    public function addmenuproduct()
    {
        return 'addmenuproduct' ;
    }

    public function editmenuproduct()
    {
        return 'editmenuproduct' ;
    }
}
