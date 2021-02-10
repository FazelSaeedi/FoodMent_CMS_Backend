<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AddProductRequest;
use App\Http\Requests\V1\DeleteProductRequest;
use App\Http\Requests\V1\EditProductRequest;
use App\Repository\ProductRepository\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $productRepository;



    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository ;
    }


    public function addProduct(AddProductRequest $addProductRequest)
    {


        $addProductIsValid = $this->addProductIsValid($addProductRequest) ;


        if($addProductIsValid)
        {

            $addProduct = $this->productRepository->addProduct($addProductRequest->name,
                                                               $addProductRequest->type,
                                                               $addProductRequest->maingroup ,
                                                               $addProductRequest->subgroup ,
                                                               $addProductRequest->code);


            return response()->json([
                'data' => [
                    'id' =>  $addProduct->id ,
                    'name' =>  $addProduct->name ,
                    'typeid' =>  $addProduct->type ,
                    'maingroupid' => $addProduct->mainGroup ,
                    'subgroupid' => $addProduct->subGroup ,
                    'code' => $addProduct->code ,
                ],
                'message' => 'success'
            ],200);
        }else{
            return response()->json([
                'message' => ' محصول مورد نظر موجود است '
            ],409);
        }

    }


    public function editProduct(EditProductRequest $editProductRequest)
    {

        $editProduct = $this->productRepository->editProduct(
            $editProductRequest->id ,
            $editProductRequest->name ,
            $editProductRequest->type ,
            $editProductRequest->maingroup ,
            $editProductRequest->subgroup ,
            $editProductRequest->code ,
        );


        if ($editProduct) {

            return response()->json([
                'data' => [
                    'id' =>  $editProduct->id ,
                    'name' =>  $editProduct->name ,
                    'typeid' =>  $editProduct->type ,
                    'maingroupid' => $editProduct->maingroup ,
                    'subgroupid' => $editProduct->subgroup ,
                    'code' => $editProduct->code ,
                ],
                'message' => 'success'
            ],200);


        }else{
            return response()->json([
                'message' => 'مقادیر شما برای ویرایش تکراری است'
            ],409);
        }

    }


    public function addProductIsValid(AddProductRequest $addProductRequest)
    {

         // check if there is a row with same typeId,mainGroup,SubGroupID,code or not


         $selectOneProduct = $this->productRepository
                                  ->selectOneProduct(
                                      false ,
                                      0 , [
                                          'typeID' =>  $addProductRequest->type ,
                                          'mainGroupID' => $addProductRequest->maingroup ,
                                          'subGroupID' => $addProductRequest->subgroup ,
                                          'code' => $addProductRequest->code ,
                                      ]
                                  );


        if( $selectOneProduct != null )
            return false;    // there is same row
        else
            return true;     // it is a new Row

    }


    public function getProductTable($paginationnumber)
    {

        $productTableList =  $this->productRepository->getProductTable( $paginationnumber );

        return response()->json([
            'data' => $productTableList ,
            'message' => 'success'
        ],200);
    }


    public function deleteProduct(DeleteProductRequest $id)
    {

        $deleteProduct =  $this->productRepository->deleteProduct($id->id);

        if ($deleteProduct) {
            return response()->json([
                'message' => 'success'
            ],200);
        }

    }



}
