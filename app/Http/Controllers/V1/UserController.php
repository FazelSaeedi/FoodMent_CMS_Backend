<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ConfirmSmsCode;
use App\Http\Requests\V1\loginRequest;
use App\Http\Requests\V1\RegisterRequest;
use App\Models\User;
use App\Repository\RestrauntRepository\RestrauntRepositoryInterface;
use App\Repository\UserRepository\UserRepositoryInterface;
use App\ToViewGenerator\MessageController;
use App\ToViewGenerator\Views\LoginView;
use App\ToViewGenerator\Views\userInfoViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Firebase\JWT\JWT;

class UserController extends Controller

{
    protected $userRepository ;
    protected $restrauntRepository;


    protected $userId ;
    protected $userphone ;
    protected $userLevel ;
    protected $restrauntCode ;


    /**
     * UserController constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository , RestrauntRepositoryInterface $restrauntRepository)
    {
        $this->userRepository = $userRepository ;
        $this->restrauntRepository = $restrauntRepository ;
    }



    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {

         /*
         |--------------------------------------------------------------------------
         | register Function
         |--------------------------------------------------------------------------
         |
         | 0 - Validate Request
         | 1 - check phone number from userRepository
         | 2 - gnerate sms code
         | 3 - setSmsCode in database from userRepository
         |
         */


         $phoneNumber = $request->phonenumber;
         $checkPhoneNumber = $this->userRepository->checkPhoneNumber($phoneNumber);


         if ($checkPhoneNumber != true)
            $this->userRepository->createUser($phoneNumber);


        $smsCode = $this->genarateSmsCode();
        $setSmsCode = $this->userRepository->setSmsCode($smsCode , $phoneNumber);


        if($setSmsCode == true)
        {
            return response()->json([
                'data' => [
                    'smscode' => $smsCode
                ] ,
                'message' => 'success'
            ],200);
        }
        else{
            return response()->json([
                'message' => ' request fail '
            ],408);
        }
    }



    /**
     * @param ConfirmSmsCode $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirmSmsCode(ConfirmSmsCode $request)
    {
        /*
         |--------------------------------------------------------------------------
         | register Function
         |--------------------------------------------------------------------------
         |
         | 0 - Validate Request
         | 1 - check sms code
         | 2 - genarate token code
         | 3 - setTokenCode
         |
         */

        // todo : validate $request ;

        $phoneNumber = $request -> phonenumber;
        $smsCode = $request -> smscode;

        $checkSmsCode = $this->userRepository->checkSmsCode($smsCode , $phoneNumber);

        if($checkSmsCode)
        {
            $token = $this->genarateToken();
            $this->userRepository->setTokenCode($phoneNumber , $token);

            return response()->json([
                'data' => [
                    'token' => $token
                ] ,
                'message' => 'success'
            ],200);
        }else
            return response()->json([
                'message' => 'your information is invalid'
            ],422);

    }



    /**
     * @return int
     */
    public function genarateSmsCode()
    {
        // echo 'genarateSmsCode done ';
        return rand ( 1001 , 9999 );
    }



    /**
     * @return string
     */
    public function genarateToken()
    {
        $JWT_SECRET_KEY = config('app.jwt_secret_key') ;

        $payload = array(
            /*"iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => 1356999524,
            "nbf" => 1357000000,*/
            "userId" => $this->userId ,
            "userPhone" => $this->userphone ,
            "userLevel" => $this->userLevel ,
            "restrauntCode" => $this->restrauntCode ,
            //"exp" => time() + 10 ,
            "time" => time()
        );
        return $jwt = JWT::encode($payload, $JWT_SECRET_KEY);

    }



    public function getUserInfo(Request $request)
    {
        $user_id =  $request->get('id');


        return MessageController::sendMessage(200 , [] , [
            'id' => $user_id ,
            'restrauntCode' => $this->getUserRestraunt($user_id)
        ] , userInfoViewModel::class );


        return response()->json([
            'data' => [
                'id' => $user_id ,
                'restrauntsCode' => $this->getUserRestraunt($user_id)
            ]
        ],200);
    }



    public function login(loginRequest $request)
    {


        $phone = $request->phone;
        $password = $request->password;



        $checkUserIsValid = $this->checkUserIsValid($phone , $password);



        if ($checkUserIsValid)
        {
            $token = $this->genarateToken();


            $this->userRepository->setTokenCode($phone , $token);

            return MessageController::sendMessage(200 , [] , [
               'token' => $token
            ] , LoginView::class );
        }
        else
            return response()->json([
                'errors' => [
                    1 => 'your information is invalid'
                ],
                'status' => '422' ,
            ],200);

    }



    public function checkUserIsValid($phone , $password)
    {

        // checkUserIsValid -> return info of user for claims
        $userInfoForClaims = $this->userRepository->getUserInfoForClaims($phone , $password);


        if ($userInfoForClaims and strlen($userInfoForClaims->password) > 1)
        {
            if (Hash::check($password, $userInfoForClaims->password) == 1)
            {
                $this->userId = $userInfoForClaims->id ;
                $this->userphone = $userInfoForClaims->phone ;
                $this->userLevel = $userInfoForClaims->level ;
                $this->restrauntCode= $userInfoForClaims->code ;

                return true;
            }
            else
                return false;
        }
        else
            return false;



    }



    public function setUserPassword(loginRequest $request)
    {
        $phone = $request->phone;
        $password = $request->password ;


        $hashPassword = Hash::make($password);

        $setUserPassword = $this->userRepository->setUserPassword($phone , $hashPassword);

        return response()->json([
            'message' => 'success'
        ],200);
    }



    public function getusers()
    {
        $getUsers = $this->userRepository->getusers();


        return response()->json([
            'data' => $getUsers
            ,'message' => 'success'
        ],200);
    }



    public function getUserRestraunt($user_id)
    {

        return $this->restrauntRepository->getRestrauntId($user_id);
    }
}
