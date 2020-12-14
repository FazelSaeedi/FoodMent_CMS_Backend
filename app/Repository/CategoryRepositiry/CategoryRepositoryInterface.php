<?php

namespace App\Repository\CategoryRepositiry;

interface CategoryRepositoryInterface
{
    public function getCategory();


    public function getChildren($categoryId);


    public function getParent($categoryId);


    public function addCategory($parentId);


    public function editCategory($id);


    public function deleteCategory($id);
}
