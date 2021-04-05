<?php

namespace App\Http\Middleware;

use App\Repository\UserRepository\UserRepositoryInterface;
use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */



    protected $_token;
    protected $_userId;
    protected $userRepository ;

    // Claims
    protected $userId ;
    protected $userphone ;
    protected $userLevel ;
    protected $restrauntCode ;

    public function __construct(Request $request , UserRepositoryInterface $userRepository)
    {

        $this->_token = $this->setToken($request->header('Authorization'));

        $this->userRepository = $userRepository ;

    }



    public function getToken()
    {
        return $this->_token;
    }

    public function setToken($token)
    {
        return $this->_token = $token;
    }

    public function getUserId()
    {
        return $this->_userId;
    }

    public function setUserId($userId)
    {
        return $this->_userId = $userId;
    }


    /*
    |--------------------------------------------------------------------------
    | EnsureTokenIsValid MiddleWare
    |--------------------------------------------------------------------------
    |
    | 1 - get token
    | 2 - parse token and validate form
    | 3 - validation token and add user_id to request
    |
    */


    public function handle(Request $request, Closure $next)
    {



        if ($this->checkToken($this->_token))
        {
            if ( $this->checkValidToken($this->parsToken($this->_token))) {



                $request->attributes->add(['id' => $this->userId]);
                $request->attributes->add(['userPhone' => $this->userphone]);
                $request->attributes->add(['userLevel' => $this->userLevel]);
                $request->attributes->add(['restrauntCode' => $this->restrauntCode]);


                return $next($request) ;
            }
        }

        return response()->json([
            'errors' => 'Unauthenticated'
        ],401);

    }



    // check format of token
    public function checkToken($token)
    {
        if (strpos($token, 'Bearer ') !== false)
        {
            $this->setToken($this->parsToken($token));
            return true;
        }
    }



    // pars Token
    public function parsToken($token)
    {
        return str_replace("Bearer ","",$token);
    }



    // get from DB
    public function checkValidToken($token)
    {


        $key =  config('app.jwt_secret_key') ;

        $decoded = JWT::decode($token, $key, array('HS256'));


        $this->userId        =  $decoded->userId ;
        $this->userphone     =  $decoded->userId ;
        $this->userLevel     =  $decoded->userId ;
        $this->restrauntCode =  $decoded->userId ;


        return true ;

        //todo : later we should attend to in line comments
        // this was a traditional method that now it become Obsolete

        /*$userid = $this->userRepository->getUserId($token);

        if ($userid)
        {
            $this->setUserId($userid);
            return true;
        }


        return false;*/
    }




}
