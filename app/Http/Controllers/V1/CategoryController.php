<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repository\CategoryRepositiry\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $categoryRepository ;


    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository ;
    }



    public function getMainCategoryList()
    {

        $mainCategoryList = $this->categoryRepository->getCategory();


        return response()->json([
            'data' => $mainCategoryList
             ,
            'message' => 'success'
        ],200);
    }



    public function getChild(Request $category)
    {
        $childCategory = $this->categoryRepository->getChildCategory($category->id);


        return response()->json([
            'data' => $childCategory
            ,
            'message' => 'success'
        ],200);
    }



    public function getParents(Request $categoryId)
    {
        $categoryInfo = $this->categoryRepository->getCategoryInfo($categoryId->id);
        $parents = $this->categoryRepository->getParents($categoryId->id);


        return response()->json([
            'data' => [
                'categoryInfo' => $categoryInfo ,
                'parents' => $parents
            ]
            ,
            'message' => 'success'
        ],200);
    }




}
