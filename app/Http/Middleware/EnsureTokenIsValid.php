<?php

namespace App\Http\Middleware;

use App\Repository\UserRepository\UserRepositoryInterface;
use Closure;
use Illuminate\Http\Request;

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

                $request->attributes->add(['id' => $this->getUserId()]);
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
        $userid = $this->userRepository->getUserId($token);

        if ($userid)
        {
            $this->setUserId($userid);
            return true;
        }


        return false;
    }




}
