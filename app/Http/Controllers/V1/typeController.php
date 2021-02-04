<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\addTypeRequest;
use App\Http\Requests\V1\DeleteTypeRequest;
use App\Http\Requests\V1\editTypeRequest;
use App\Repository\TypeRepository\TypeRepositoryInterface;

class typeController extends Controller
{


    protected $typeRepository ;


    public function __construct(TypeRepositoryInterface $typeRepository)
    {
        $this->typeRepository = $typeRepository ;
    }


    public function addType(addTypeRequest $addTypeRequest)
    {
        $addType = $this->typeRepository->addType($addTypeRequest->name , $addTypeRequest->code);


        if ($addType)
             return response()->json([
                 'data' => [
                     'id'   => $addType['data']['id'],
                     'name' => $addType['data']['name'],
                     'code' => $addType['data']['code'],
                 ],
                 'message' => 'success'
             ],200);

    }


    public function editType(editTypeRequest $editTypeRequest)
    {
        $editType = $this->typeRepository->editType($editTypeRequest->id , $editTypeRequest->name , $editTypeRequest->code);

        // todo : implement editType
        if ($editType)
            return response()->json([
                'data' => [
                    'id'   => $editType['data']['id'],
                    'name' => $editType['data']['name'],
                    'code' => $editType['data']['code'],
                ],
                'message' => 'success'
            ],200);

    }


    public function getTypesTable($paginationnumber)
    {
        $typeTableList =  $this->typeRepository->getTypeTable( $paginationnumber );


        return response()->json([
            'data' => $typeTableList ,
            'message' => 'success'
        ],200);
    }


    public function deleteType(DeleteTypeRequest $id)
    {

        $deleteType =  $this->typeRepository->deleteType($id->id);

        if ($deleteType) {
            return response()->json([
                'message' => 'success'
            ],200);
        }

    }



}
