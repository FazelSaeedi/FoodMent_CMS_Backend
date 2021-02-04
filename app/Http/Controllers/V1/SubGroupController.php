<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AddSubGroupRequest;
use App\Http\Requests\V1\DeleteMainGroupRequest;
use App\Http\Requests\V1\DeleteSubGroupRequest;
use App\Http\Requests\V1\EditSubGroupRequest;
use App\Repository\SubGroupRepository\SubGroupRepositoryInterface;
use Illuminate\Http\Request;

class SubGroupController extends Controller
{

    protected $subGroupRepository ;



    public function __construct(SubGroupRepositoryInterface $subGroupRepository)
    {
        $this->subGroupRepository = $subGroupRepository ;
    }

    public function addSubGroup(AddSubGroupRequest $addSubGroupRequest)
    {
        $addsubGroup = $this->subGroupRepository->addSubGroup($addSubGroupRequest->name , $addSubGroupRequest->code);


        if ($addsubGroup)
            return response()->json([
                'data' => [
                    'id'   => $addsubGroup['data']['id'],
                    'name' => $addsubGroup['data']['name'],
                    'code' => $addsubGroup['data']['code'],
                ],
                'message' => 'success'
            ],200);

    }

    public function editSubGroup(EditSubGroupRequest $editSubGroupRequest)
    {
        $editSubGroup = $this->subGroupRepository->editSubGroup($editSubGroupRequest->id , $editSubGroupRequest->name , $editSubGroupRequest->code);


        if ($editSubGroup)
            return response()->json([
                'data' => [
                    'id'   => $editSubGroup['data']['id'],
                    'name' => $editSubGroup['data']['name'],
                    'code' => $editSubGroup['data']['code'],
                ],
                'message' => 'success'
            ],200);

    }

    public function getSubGroupTable($paginationnumber)
    {
        $subGroupTableList =  $this->subGroupRepository->getSubGroupTable( $paginationnumber );


        return response()->json([
            'data' => $subGroupTableList ,
            'message' => 'success'
        ],200);
    }

    public function deleteSubGroup(DeleteSubGroupRequest $id)
    {
        $deleteSubGroup =  $this->subGroupRepository->deleteSubGroup($id->id);

        if ($deleteSubGroup) {
            return response()->json([
                'message' => 'success'
            ],200);
        }
    }


}
