<?php

namespace App\Repository\RestrauntRepository;

interface RestrauntRepositoryInterface
{

    public function addRestraunt($photo1 , $photo2 , $photo3 , $code , $name , $address , $phone , $adminId);

    public function editRestraunt($id , $code , $name , $address , $phone , $adminId , $editgalleryRestraunt);

    public function uploadRestrauntPhoto( $restrauntId , $photo1 , $photo2 , $photo3 );

    public function uploadeditRestraunt( $restrauntId , $editgalleryRestraunt);

    public function getRestrauntTable($paginationNumber);
}
