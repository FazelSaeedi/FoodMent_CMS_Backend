<?php

namespace App\Repository\TypeRepository;

use App\Models\type;
use Illuminate\Support\Facades\DB;

class ElequentTypeRepository implements TypeRepositoryInterface
{


    public function addType($name, $code)
  {
    // TODO: Implement addType() method.

      //$result = type::insert(['name' => $name, 'code' => $code]);

      $addType = new type();

      $addType->name = $name ;
      $addType->code = $code ;






      if($addType->save())
          return [
              'data' => [
                  'id' => $addType->id ,
                  'name' => $addType->name ,
                  'code' => $addType->code ,
              ]
          ];
      else
          return false;

  }


    public function editType( $id , $name, $code)
    {

        $editType = type::find($id);

        $editType->name = $name ;
        $editType->code = $code ;


        $editType->save();


        if($editType->save())
            return [
                'data' => [
                    'id' => $editType->id ,
                    'name' => $editType->name ,
                    'code' => $editType->code ,
                ]
            ];
        else
            return false;
    }


    public function getTypeTable( $paginationNumber )
    {
       // return type::get();
        return DB::table('types')->orderBy('code', 'asc')->paginate($paginationNumber);

    }


    public function deleteType($id)
    {
         $type = type::destroy(intval($id));
         return $type ;
    }


}
