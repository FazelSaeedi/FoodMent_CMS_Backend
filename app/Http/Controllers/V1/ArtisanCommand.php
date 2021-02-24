<?php


namespace App\Http\Controllers\V1;
use App\Repository\UserRepository\UserRepositoryInterface;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ArtisanCommand extends Controller
{
    //
    protected $userRepository ;


    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository ;
    }


    public function initialize()
    {
    	$this->migrate();
        $this->createUser();
    }

    public function reInitialize()
    {
        $this->remigrate();
        $this->createUser();
    }


    public function migrate()
    {
        $this->optimize();
    	return Artisan::call('migrate');
    }


    public function remigrate()
    {
        $this->optimize();
        Artisan::call('migrate:fresh');
    }


    public function createUser()
    {
        $phoneNumber = '09112223333' ;
        $password = '111' ;
        $creatUser_Level = DB::statement("INSERT INTO `users_level` (`id`, `level`, `title`) VALUES ('1', '10', 'admin')");
        $createUser =  $this->userRepository->createUser($phoneNumber);
        $smsCode = rand ( 1001 , 9999 );
        $setSmsCode = $this->userRepository->setSmsCode($smsCode , $phoneNumber);
        $hashPassword = Hash::make($password);
        $setUserPassword = $this->userRepository->setUserPassword($phoneNumber , $hashPassword);
        return 'done';
    }

    public function optimize()
    {
        Artisan::call('cache:clear');
        Artisan::call('optimize');
        Artisan::call('route:cache');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('config:cache');
    }
}
