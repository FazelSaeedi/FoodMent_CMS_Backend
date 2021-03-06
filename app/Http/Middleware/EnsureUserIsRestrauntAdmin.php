<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Repository\RestrauntRepository\RestrauntRepositoryInterface;
use App\Repository\UserRepository\UserRepositoryInterface;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnsureUserIsRestrauntAdmin
{

    protected $userId ;
    protected $restrauntCode ;
    protected $userAccessLevel   ;





    protected $userRepository ;

    public function __construct(Request $request , UserRepositoryInterface $userRepository)
    {

        $this->userId = $request->get('id') ;

        $this->restrauntCode = $request->code ;

        $this->userRepository = $userRepository ;

        $this->setUserAccessLevel($this->userRepository->getUserAccessLevel($this->userId));

    }




    // getter && setter

    /**
     * @return int
     */
    public function getUserAccessLevel(): int
    {
        return $this->userAccessLevel;
    }

    /**
     * @param int $userAccessLevel
     */
    public function setUserAccessLevel(int $userAccessLevel): void
    {
        $this->userAccessLevel = $userAccessLevel;
    }





    // Handle

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if ($this->getUserAccessLevel() >= 5)
            return $next($request);


        return response()->json([
            'errors' => [
                1 => 'Unauthenticated'
            ],
            'status' => '422' ,
        ],200);

    }




}
