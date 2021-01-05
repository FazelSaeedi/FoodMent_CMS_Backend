<?php

namespace App\Repository\CategoryRepositiry;

interface CategoryRepositoryInterface
{
    public function getCategory();


    public function getChildCategory($categoryId);


    public function getParents($id);


    public function addCategory($title ,$parentId);


    public function editCategory($id);


    public function deleteCategory($id);


    public function getCategoryInfo($id);

}
