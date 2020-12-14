<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repository\CategoryRepositiry\CategoryRepositoryInterface;
use App\Repository\UserRepository\UserRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $categoryRepository ;


    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->$categoryRepository = $categoryRepository ;
    }

    public function index()
    {
        return 'test is ok';
    }

}
