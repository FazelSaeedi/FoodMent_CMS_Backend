<?php


namespace App\Repository\MenuRepository;


interface WatingToBuildMenuJsonRepositoryInterface
{


    public function insertCreateMenuJson( $restrauntId );


    public function updateCreateMenuJson( $restrauntId );


    public function IsExistCreateMenuJsonRequest( $restrauntId );


    public function getMenuJsonRequestList();

}
