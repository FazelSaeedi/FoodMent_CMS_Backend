<?php

namespace App\Repository\MainGroupRepository;

interface MainGroupRepositoryInterface
{

    public function addMainGroup($name , $code);

    public function editMainGroup( $id , $name , $code );

    public function getMainGroupTable( $paginationNumber );

    public function deleteMainGroup( $id );

}
