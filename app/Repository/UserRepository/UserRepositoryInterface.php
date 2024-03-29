<?php

namespace App\Repository\UserRepository;

interface UserRepositoryInterface
{

    public function checkPhoneNumber($phoneNumber);


    public function checkSmsCode($smsCode , $phoneNumber);


    public function setSmsCode($smsCode , $phoneNumber);


    public function setTokenCode($phoneNumber , $token);


    public function createUser($phoneNumber);


    public function getUserId($token);


    public function getUserInfoForClaims($username , $password);


    public function setUserPassword($phone , $password);


    public function getusers();


    public function getUserAccessLevel( $userId );

}
