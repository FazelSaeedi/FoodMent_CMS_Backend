<?php

namespace App\Repository\RestrauntRepository;

use App\Models\Restraunt;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

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
                //todo : remove form database
        }
        else
            return false;



    }



    public function editRestraunt($id , $code , $name , $address , $phone , $adminId , $editgalleryRestraunt)
    {
        $editRestraunt = Restraunt::find($id);

        $editRestraunt->name = $name ;
        $editRestraunt->code = $code ;
        $editRestraunt->address = $address ;
        $editRestraunt->adminid = $adminId ;
        $editRestraunt->phone = $phone ;


        if($editRestraunt->save())
        {
            $uploadPhoto = $this->uploadeditRestraunt($editRestraunt->id, $editgalleryRestraunt);

            if ($uploadPhoto)
            {
                return [
                    'id' =>   $editRestraunt->id ,
                    'name' =>   $editRestraunt->name ,
                    'code' =>   $editRestraunt->code ,
                    'address' =>   $editRestraunt->address ,
                    'adminid' =>   $editRestraunt->adminid ,
                    'phone' =>   $editRestraunt->phone ,
                ];
            }
            else
                return false;
            //todo : remove form database
        }
        else
            return false;


        return $editgalleryRestraunt->photo1;
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

    public function uploadeditRestraunt($restrauntId, $editgalleryRestraunt)
    {

        $imagePath = "/images/{$restrauntId}/banner/";

        $gallery = [ 'photo1' , 'photo2' , 'photo3' ];

        $uploadStatus = true ;
        foreach ($gallery as $key => $value)
        {
            if (property_exists($editgalleryRestraunt , $value))
            {
                $MP1 = $editgalleryRestraunt->$value->move(public_path($imagePath) , 'banner'.($key+1).'.jpg');
                if(!$MP1) $uploadStatus = false ;
            }
        }

        return $uploadStatus ;

    }


    public function getRestrauntTable($paginationNumber)
    {

        return DB::table('restraunts')
            ->join('users', 'users.id', '=', 'restraunts.adminid')
            ->orderBy('restraunts.code', 'asc')
            ->select([
                'restraunts.id as id' ,
                'restraunts.name as name' ,
                'users.phone as adminName' ,
                'restraunts.adminid as adminid',
                'restraunts.code as code',
                'restraunts.address as address',
                'restraunts.phone as phone'
            ])
            ->paginate($paginationNumber);

    }


    public function deleteRestraunt($id)
    {
        $deleteRestraunt = Restraunt::destroy(intval($id));

        $restrauntDir = public_path("/images/{$id}");



        if ($deleteRestraunt)
        {
            if (file_exists(public_path("/images/{$id}"))) {
                $it = new RecursiveDirectoryIterator($restrauntDir, RecursiveDirectoryIterator::SKIP_DOTS);
                $files = new RecursiveIteratorIterator($it,
                    RecursiveIteratorIterator::CHILD_FIRST);

                foreach($files as $file) {
                    if ($file->isDir()){
                        rmdir($file->getRealPath());
                    } else {
                        unlink($file->getRealPath());
                    }
                }
                rmdir($restrauntDir);
                return true;
            }

            return false;
        }

        return false;

    }

}
