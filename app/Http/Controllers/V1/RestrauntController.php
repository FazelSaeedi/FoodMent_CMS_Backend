<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AddRestrauntRequest;
use App\Http\Requests\V1\DeleteRestrauntRequest;
use App\Http\Requests\V1\EditRestrauntRequest;
use App\Http\Requests\V1\GetRestrauntInfoRequest;
use App\Repository\RestrauntRepository\RestrauntRepositoryInterface;
use App\ToViewGenerator\MessageController;
use App\ToViewGenerator\Views\GetRestaurantListViewModel;
use App\ToViewGenerator\Views\restrauntInfoViewModel;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Object_;

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


    public function editRestraunt(EditRestrauntRequest $request)
    {
        $galleryPhoto = [$request->file('photo1') ,$request->file('photo2') ,$request->file('photo3') ];
        $gallerySrC   = [$request->srcphoto1 ,$request->srcphoto2 ,$request->srcphoto3 ];
        $ValidateEditRestrauntArray = $this->editPhotoRestrauntValidate($galleryPhoto , $gallerySrC);

        $editgalleryRestraunt = new Object_();

        if ($ValidateEditRestrauntArray['status'] == true )
        {
            foreach ($ValidateEditRestrauntArray['data'] as $key => $value){
                if (isset($value['file']))
                    $editgalleryRestraunt->$key = $value['file'] ;
            }

            $id = $request->id;
            $code = $request->code;
            $name = $request->name;
            $address = $request->address;
            $phone = $request->phone;
            $adminId = $request->adminid;

            $editRestrant = $this->restrauntRepository->editRestraunt($id , $code , $name , $address , $phone , $adminId , $editgalleryRestraunt);


            if ($editRestrant)
            {
                return response()->json([
                    'data' => $editRestrant
                    ,
                    'message' => 'success'
                ],200);
            }else{
                return response()->json([
                    'message' => 'Error'
                ],409);
            }

        }else{
            return response()->json([
                'message' => 'Error' ,
                'errors' => [
                    'photo' => "خطا در آ‍پلود عکس" ,
                ]
            ],409);
        }





    }


    public function editPhotoRestrauntValidate($galleryPhoto , $gallerySrC)
    {

        $ValidateEditRestrauntArray = [
            'status' => true ,
            'data' => [
                'photo1' => [] ,
                'photo2' => [] ,
                'photo3' => [] ,
            ],
            'message' => ''
        ];



        for ($i = 0 ; $i < 3 ; $i++)
        {
            if (file_exists($galleryPhoto[$i]))
                $ValidateEditRestrauntArray['data']['photo'.($i+1)]['file'] = $galleryPhoto[$i];
            else if (isset($gallerySrC[$i]))
                $ValidateEditRestrauntArray['data']['photo'.($i+1)]['src'] = $gallerySrC[$i];
            else
                $ValidateEditRestrauntArray['status'] = false ;
        }


        return $ValidateEditRestrauntArray;
    }


    public function deleteRestraunt(DeleteRestrauntRequest $request)
    {
        $deleteRestraunt =  $this->restrauntRepository->deleteRestraunt($request->id);


       if ($deleteRestraunt)
        {
            return response()->json([
                'message' => 'success'
            ],200);
        }else{
            return response()->json([
                'message' => 'Error'
            ],409);
        }

    }


    public function getrestraunttable($paginationnumber)
    {
        $restrauntTableList =  $this->restrauntRepository->getRestrauntTable( $paginationnumber );


        return MessageController::sendMessage(200 , [] , [
            $restrauntTableList
        ] , GetRestaurantListViewModel::class );

        return response()->json([
            'data' => $restrauntTableList ,
            'message' => 'success'
        ],200);
    }


    public function getRestrauntInfo(GetRestrauntInfoRequest $request , $restrauntCode)
    {
        $restrauntInformation =  $this->restrauntRepository->getRestrauntInfo($restrauntCode);

        $menuURL  = "api(v1.0(menu(getmenutable(${restrauntInformation['id']}(10000";

        $restrauntInformation['menuURL'] = $menuURL ;

        return MessageController::sendMessage(200 , [] , [
            $restrauntInformation
        ] , restrauntInfoViewModel::class );


        if ($restrauntInformation)
            return response()->json([
                'data' => [
                    $restrauntInformation
                ] ,
                'status' => '200'
            ],200);
        else
            return response()->json([
                'errors' => [
                    1 => 'Error in database'
                ],
                'status' => '500' ,
            ],200);

    }

}
