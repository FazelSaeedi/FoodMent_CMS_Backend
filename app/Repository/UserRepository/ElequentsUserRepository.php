<?php


namespace App\Repository\UserRepository;


use App\Models\User;
use Illuminate\Support\Facades\DB;

class ElequentsUserRepository implements UserRepositoryInterface
{


    /**
     * @param $phoneNumber
     * @return bool
     */
    public function checkPhoneNumber($phoneNumber)
    {
        /*
         *  |----------------------------------------
         *  | 1 - check phone number is exist or not
         *  | 2 - return true or false
         *  |----------------------------------------
         */

        $userExist = User::where('phone', $phoneNumber)->exists();

        if ($userExist)
            return true ;
        else
            return false;
    }



    /**
     * @param $smsCode
     * @param $phoneNumber
     * @return bool
     */
    public function checkSmsCode($smsCode , $phoneNumber)
    {
        $userExist = User::where('sms_code' , $smsCode)->where('phone', $phoneNumber)->exists();

        if ($userExist)
            return true ;
        else
            return false;
    }



    /**
     * @param $phoneNumber
     * @param $token
     * @return mixed
     */
    public function setTokenCode($phoneNumber , $token)
    {
        $setTokenCode = User::where('phone', $phoneNumber)
            ->update(['token' => $token]);

        return $setTokenCode;
    }



    /**
     * @param $smsCode
     * @param $phoneNumber
     * @return mixed
     */
    public function setSmsCode( $smsCode , $phoneNumber )
    {
        $setSmsCode = User::where('phone', $phoneNumber)
            ->update(['sms_code' => $smsCode]);

        return $setSmsCode;
    }



    /**
     * @param $phoneNumber
     * @return mixed
     */
    public function createUser($phoneNumber)
    {
        $NewUser = User::create([
            'phone' => $phoneNumber,
            'sms_code' => 'NULL',
            'registerd' => 0 ,
            'level_id' => 1
        ]);

        return $NewUser;
    }



    public function getUserId($token)
    {

        $userId = User::where('token', $token)->first();

        if ($userId) {
            // It exists
            return $userId->get(['id']);
        } else {
            // It does not exist
            return false;

        }


    }



    public function chechUserIsValid($phone, $password)
    {

        $user = DB::table('users')->where('phone', $phone)->first();


        if ($user === null)
            return false;
        else
            return $user->password;

    }



    public function setUserPassword($phone, $password)
    {
        $setUserPassword = User::where('phone', $phone)
            ->update(['password' => $password]);

        return $setUserPassword;
    }

    public function getusers()
    {
        return User::get(['id' , 'phone'])->all();
    }
}
