<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AddRestrauntRequest;
use App\Repository\RestrauntRepository\RestrauntRepositoryInterface;
use Illuminate\Http\Request;

class RestrauntController extends Controller
{
    protected $restrauntRepository;



    public function __construct(RestrauntRepositoryInterface $restrauntRepository)
    {
        $this->restrauntRepository = $restrauntRepository ;
    }


    public function addRestraunt(AddRestrauntRequest $request)
    {

        $photo1 =  $request->file('photo1');
        $photo2 =  $request->file('photo2');
        $photo3 =  $request->file('photo3');

        $code = $request->code;
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;
        $adminId = $request->adminid;



        $addRestraunt =  $this->restrauntRepository->addRestraunt($photo1 , $photo2 , $photo3 , $code , $name , $address , $phone , $adminId);



        if ($addRestraunt)
        {
            return response()->json([
                'data' => $addRestraunt
                ,
                'message' => 'success'
            ],200);
        }else{
            return response()->json([
                'message' => 'Error'
            ],409);
        }

    }


    public function addImageRestraunt(Request $request)
    {

        $this->validate($request , [
            'image' => 'required|mimes:jpge,bmp,png|max:10000' ,
            'code' => 'required|numeric'
        ]);


        $file = $request->file('image');
        $imagePath = "/gallery/{$request->code}/";
        $file->move(public_path($imagePath) , 'banner_325_254.png' );

        return response([
            'data' => [
                'image-url' => url($imagePath .'banner_325_254.png' )
            ] ,
            'status' => 'success'
        ]);

    }


    public function editRestraunt()
    {

    }


}
