<?php

namespace App\Repository\SubGroupRepository;

use App\Models\MainGroup;
use App\Models\SubGroup;
use Illuminate\Support\Facades\DB;

class ElequentSubGroupRepository implements SubGroupRepositoryInterface
{

    public function addSubGroup($name, $code)
  {
      $addSubGroup = new SubGroup();

      $addSubGroup->name = $name ;
      $addSubGroup->code = $code ;


      if($addSubGroup->save())
          return [
              'data' => [
                  'id' => $addSubGroup->id ,
                  'name' => $addSubGroup->name ,
                  'code' => $addSubGroup->code ,
              ]
          ];
      else
          return false;
  }

    public function editSubGroup($id, $name, $code)
  {
      $editSubGroup = SubGroup::find($id);

      $editSubGroup->name = $name ;
      $editSubGroup->code = $code ;


      $editSubGroup->save();


      if($editSubGroup->save())
          return [
              'data' => [
                  'id' => $editSubGroup->id ,
                  'name' => $editSubGroup->name ,
                  'code' => $editSubGroup->code ,
              ]
          ];
      else
          return false;
  }

    public function getSubGroupTable($paginationNumber)
    {
        return DB::table('subgroups')->orderBy('code', 'asc')->paginate($paginationNumber);
    }

    public function deleteSubGroup($id)
    {
        $deleteSubGroup = SubGroup::destroy(intval($id));
        return $deleteSubGroup ;
    }
}
