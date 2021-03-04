<?php

use App\Http\Controllers\V1\ArtisanCommand;
use App\Http\Controllers\v1\CategoryController;
use App\Http\Controllers\V1\MenuController;
use App\Http\Controllers\V1\ProductController;
use App\Http\Controllers\V1\RestrauntController;
use App\Http\Controllers\V1\UserController;
use App\Http\Controllers\V1\typeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\MainGroupController;
use App\Http\Controllers\V1\SubGroupController;

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
        return 'Welcome To FoodMent_CMS_Backend.ir' ;
    });


    Route::prefix('user')->group(function (){

        Route::post('register' , [UserController::class , 'register']);
        Route::post('checksmscode' , [UserController::class , 'confirmSmsCode']);
        Route::post('getuserinfo' , [UserController::class , 'getUserInfo'])->middleware('authentication');
        Route::post('login' , [UserController::class , 'login']);
        Route::post('setuserpassword' , [UserController::class , 'setUserPassword']);
        Route::get('getusers' , [UserController::class , 'getusers'])->middleware('authentication');

    });


    Route::prefix('category')->middleware('authentication')->group(function (){


        Route::get('getmaincategorylist' , [CategoryController::class , 'getMainCategoryList']);
        Route::get('getchild/{id}' , [CategoryController::class , 'getChild']);
        Route::get('getparents/{id}' , [CategoryController::class , 'getParents']);
        Route::post('addCategory' , [CategoryController::class , 'addCategory']);



        Route::post('addtype' , [typeController::class , 'addType']);
        Route::post('edittype' , [typeController::class , 'editType']);
        Route::post('deletetype' , [typeController::class , 'deleteType']);
        Route::get( 'gettypestable/{paginationNumber}' , [typeController::class , 'getTypesTable']);


        Route::post('addmaingroup' , [MainGroupController::class , 'addMainGroup']);
        Route::post('editmaingroup' , [MainGroupController::class , 'editMainGroup']);
        Route::get( 'getmaingrouptable/{paginationNumber}' , [MainGroupController::class , 'getMainGroupTable']);
        Route::post('deletemaingroup' , [MainGroupController::class , 'deleteMainGroup']);


        Route::post('addsubgroup' , [SubGroupController::class , 'addSubGroup']);
        Route::post('editsubgroup' , [SubGroupController::class , 'editSubGroup']);
        Route::get( 'getsubgrouptable/{paginationNumber}' , [SubGroupController::class , 'getSubGroupTable']);
        Route::post('deletesubgroup' , [SubGroupController::class , 'deleteSubGroup']);





    });


    Route::prefix('product')->middleware('authentication')->group(function (){

        Route::post('addproduct'  , [ProductController::class , 'addProduct']);
        Route::post('editproduct' , [ProductController::class , 'editProduct']);
        Route::get( 'getproducttable/{paginationNumber}' , [ProductController::class , 'getProductTable']);
        Route::post('deleteproduct' , [ProductController::class , 'deleteProduct']);

        // just get id & name
        Route::get('getproductlist' , [ProductController::class , 'getproductlist']);

    });


    Route::prefix('restraunt')->middleware('authentication')->group(function (){

        Route::post('addrestraunt'  , [RestrauntController::class , 'addRestraunt']);
        Route::post('editrestraunt' , [RestrauntController::class , 'editRestraunt']);
        Route::get( 'getrestraunttable/{paginationNumber}' , [RestrauntController::class , 'getrestraunttable']);
        Route::post('deleterestraunt' , [RestrauntController::class , 'deleteRestraunt']);

    });


    Route::prefix('menu')->middleware('authentication')->group(function (){

        Route::post('addmenuproduct ' , [MenuController::class , 'addMenuProduct']);
        Route::post('editmenuproduct ' , [MenuController::class , 'editMenuProduct']);
        Route::post('deletemenuproduct ' , [MenuController::class , 'deleteMenuProduct']);
        Route::post('getrestrauntmenutable ' , [MenuController::class , 'getRestrauntMenuTable']);
        Route::post('createmenujson' , [MenuController::class , 'createMenuJson']);
        Route::get( 'getmenutable/{restrauntid}/{paginationNumber}' , [MenuController::class , 'getMenuTable']);

    });


    // Get Test Ajax JavaScript
    Route::get('testgetajax' , function (Request $request){
        return 'get test is ok ' ;
    });
    // Post Test Ajax JavaScript
    Route::post('testpostajax' , function (Request $request){
        return response([
            'code' => $request->code ,
            'name' => $request->name
        ]);
    });
    // Test upload
    Route::post('upload/image' , function (Request $request){


         $photo1 =  $request->file('photo1');
         $photo2 =  $request->file('photo2');
         $photo3 =  $request->file('photo3');

         $code = $request->code;
         $name = $request->name;
         $address = $request->address;
         $phone = $request->phone;

         return  print_r([$photo1 , $photo2 , $photo3 , $code , $name , $address , $phone]);

    });




    Route::get('test' , function (Request $request){
        return 'get test is ok ' ;
    });

    Route::prefix('artisan')->group(function (){

        Route::get('initialize'  , [ArtisanCommand::class , 'initialize']);
        Route::get('reinitialize'  , [ArtisanCommand::class , 'reInitialize']);
        Route::get('optimize'  , [ArtisanCommand::class , 'optimize']);

    });

});

