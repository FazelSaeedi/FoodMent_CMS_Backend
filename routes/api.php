<?php

use App\Http\Controllers\v1\CategoryController;
use App\Http\Controllers\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::prefix('v1')->group(function () {

    Route::get('/welcome', function (){
        return 'Welcome To foodment.ir' ;
    });


    Route::prefix('user')->group(function (){
        Route::post('register' , [UserController::class , 'register']);
        Route::post('checksmscode' , [UserController::class , 'confirmSmsCode']);
        Route::post('getuserinfo' , [UserController::class , 'getUserInfo'])->middleware('authentication');
        Route::post('login' , [UserController::class , 'login']);
        Route::post('setuserpassword' , [UserController::class , 'setUserPassword']);
    });

    Route::prefix('category')->middleware('authentication')->group(function (){

        Route::get('getmaincategorylist' , [CategoryController::class , 'getMainCategoryList']);
        Route::get('getchild/{id}' , [CategoryController::class , 'getChild']);
        Route::get('getparents/{id}' , [CategoryController::class , 'getParents']);
        Route::post('addCategory' , [CategoryController::class , 'addCategory']);

    });


    // Test upload
    Route::post('upload/image' , function (Request $request){

        echo $request-> file('edit-file1');
        echo $request['edit-restaurant-Popup'];
        echo 'hi';

    });

});

