<?php

namespace App\Repository\MainGroupRepository;

interface MainGroupRepositoryInterface
{

    public function addMainGroup($name , $code);

    public function editMainGroup( $id , $name , $code );

}
