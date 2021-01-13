<?php

namespace App\Repository\TypeRepository;

interface TypeRepositoryInterface
{

    public function addType($name , $code);

    public function editType( $id , $name , $code );


}
