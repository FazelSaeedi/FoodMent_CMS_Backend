<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AddMainGroupRequest;
use App\Http\Requests\V1\EditMainGroupRequest;
use App\Repository\MainGroupRepository\MainGroupRepositoryInterface;
use Illuminate\Http\Request;

class MainGroupController extends Controller
{
    protected $mainGroupRepository ;

    public function __construct(MainGroupRepositoryInterface $mainGroupRepository)
    {
        $this->mainGroupRepository = $mainGroupRepository ;
    }


    public function addMainGroup(AddMainGroupRequest $addMainGroupRequest)
    {
        $addMainGroup = $this->mainGroupRepository->addMainGroup($addMainGroupRequest->name , $addMainGroupRequest->code);


        if ($addMainGroup)
            return response()->json([
                'data' => [
                    'id'   => $addMainGroup['data']['id'],
                    'name' => $addMainGroup['data']['name'],
                    'code' => $addMainGroup['data']['code'],
                ],
                'message' => 'success'
            ],200);

    }


    public function editMainGroup(EditMainGroupRequest $editMainGroupRequest)
    {
        $editMainGroup = $this->mainGroupRepository->editMainGroup($editMainGroupRequest->id , $editMainGroupRequest->name , $editMainGroupRequest->code);


        if ($editMainGroup)
            return response()->json([
                'data' => [
                    'id'   => $editMainGroup['data']['id'],
                    'name' => $editMainGroup['data']['name'],
                    'code' => $editMainGroup['data']['code'],
                ],
                'message' => 'success'
            ],200);

    }

}
