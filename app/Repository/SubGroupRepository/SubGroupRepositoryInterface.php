<?php

namespace App\Repository\SubGroupRepository;

interface SubGroupRepositoryInterface
{

    public function addSubGroup($name , $code);

    public function editSubGroup( $id , $name , $code );

}
