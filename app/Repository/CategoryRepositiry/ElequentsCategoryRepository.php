<?php

namespace App\Repository\CategoryRepositiry;

use App\Models\Category;

class ElequentsCategoryRepository implements CategoryRepositoryInterface
{


    /**
     *
     * get Main Category
     *
     * @return mixed
     */
    public function getCategory()
    {
        return Category::where('parent_id', 0)->get([ 'id' , 'title' , 'parent_id']);
    }



    /**
     *
     * get all children of category
     *
     * @param $categoryId
     * @return mixed
     */
    public function getChildCategory($categoryId)
    {
        return Category::where('parent_id', $categoryId)->get(['title' , 'parent_id']);
    }



    /**
     *
     * get info of Category
     *
     * @param $id
     * @return mixed
     */
    public function getCategoryInfo($id)
    {
        return Category::find($id);
    }



    /**
     *
     * get parents of category
     *
     * @param $id
     * @return array
     */
    public function getParents($id)
    {
        $categoryInfo = $this->getCategoryInfo($id);
        $parentId = $categoryInfo->parent_id;

        $allParent = [];

        while ($parentId != 0) {

            $nextCategory = $this->getCategoryInfo($parentId);

            array_push($allParent, $nextCategory);

            $parentId = $nextCategory->parent_id;
        }

        return $allParent;

    }




    public function addCategory($parentId)
    {
        // TODO: Implement addCategory() method.
    }




    public function editCategory($id)
    {
        // TODO: Implement editCategory() method.
    }




    public function deleteCategory($id)
    {
        // TODO: Implement deleteCategory() method.
    }


}
