<?php


namespace App\Repository\UserRepository;


use App\Models\User;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\exactly;

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

        $userId = User::where('token' , '=' , $token)->get();

        if (!empty($userId->first())) {
            // Is exists
            return $userId->first()->id;
        }

        return false;


    }



    public function getUserInfoForClaims($phone, $password)
    {

        $user = DB::table('users')
            ->join('users_level' , 'users.level_id' , '=' , 'users_level.id' )
            ->where('users.phone', $phone)
            ->select('users.id' , 'users.phone' , 'users_level.level' , 'users.password')
            ->first();

        $userIsRestrauntAdmin = DB::table('users')
            ->join('restraunts' , 'restraunts.adminid' , '=' , 'users.id')
            ->where('users.phone' , $phone)
            ->select('code')
            ->first();



        if (isset($userIsRestrauntAdmin->code))
             $user->code = $userIsRestrauntAdmin->code ;
        else
            $user->code = null ;


        if ($user === null)
            return false;
        else
            return $user;

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



    public function getUserAccessLevel($userId)
    {
        return DB::table('users')
            ->where('users.id' , '=' , $userId)
            ->join('users_level', 'users_level.id', '=', 'users.level_id')
            ->get('level as accessLevel')->first()->accessLevel;
    }
}
