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


    public function chechUserIsValid($username , $password);


    public function setUserPassword($phone , $password);

}
