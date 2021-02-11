<?php

namespace App\Repository\RestrauntRepository;

use App\Models\Restraunt;

class EloquentRestrauntRepository implements RestrauntRepositoryInterface
{


    public function addRestraunt($photo1, $photo2, $photo3, $code, $name, $address, $phone, $adminId)
    {
        $addRestraunt = new Restraunt();


        $addRestraunt->name = $name ;
        $addRestraunt->code = $code ;
        $addRestraunt->address = $address ;
        $addRestraunt->adminid = $adminId ;
        $addRestraunt->phone = $phone ;



        if($addRestraunt->save())
        {
            $uploadPhoto = $this->uploadRestrauntPhoto($addRestraunt->id, $photo1, $photo2, $photo3);
            if ($uploadPhoto)
            {
                return [
                    'id' =>   $addRestraunt->id ,
                    'name' =>   $addRestraunt->name ,
                    'code' =>   $addRestraunt->code ,
                    'address' =>   $addRestraunt->address ,
                    'adminid' =>   $addRestraunt->adminid ,
                    'phone' =>   $addRestraunt->phone ,
                ];
            }
            else
                return false;
        }
        else
            return false;



    }

    public function editRestraunt()
    {
        // TODO: Implement editRestraunt() method.
    }


    public function uploadRestrauntPhoto($restrauntId, $photo1, $photo2, $photo3)
    {

        $imagePath = "/images/{$restrauntId}/banner/";

        // move photo
        $MP1 = $photo1->move(public_path($imagePath) , 'banner1.jpg');
        $MP2 = $photo2->move(public_path($imagePath) , 'banner2.jpg');
        $MP3 = $photo3->move(public_path($imagePath) , 'banner3.jpg');

        if($MP1 && $MP2 && $MP3)
            return true ;
        else
            return false;
    }
}
