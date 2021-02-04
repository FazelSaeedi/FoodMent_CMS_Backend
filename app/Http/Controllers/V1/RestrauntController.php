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

         $this->restrauntRepository->addRestraunt();
         return 'addRestraunt';

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
