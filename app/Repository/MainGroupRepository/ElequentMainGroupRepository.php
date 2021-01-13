<?php

namespace App\Repository\MainGroupRepository;

use App\Models\MainGroup;

class ElequentMainGroupRepository implements MainGroupRepositoryInterface
{

    public function addMainGroup( $name , $code )
    {

        $addMainGroup = new MainGroup();

        $addMainGroup->name = $name ;
        $addMainGroup->code = $code ;


        if($addMainGroup->save())
            return [
                'data' => [
                    'id' => $addMainGroup->id ,
                    'name' => $addMainGroup->name ,
                    'code' => $addMainGroup->code ,
                ]
            ];
        else
            return false;
    }



    public function editMainGroup( $id , $name , $code )
    {

        $editMainGroup = MainGroup::find($id);

        $editMainGroup->name = $name ;
        $editMainGroup->code = $code ;


        $editMainGroup->save();


        if($editMainGroup->save())
            return [
                'data' => [
                    'id' => $editMainGroup->id ,
                    'name' => $editMainGroup->name ,
                    'code' => $editMainGroup->code ,
                ]
            ];
        else
            return false;

    }



}


