<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    // Artisan::call('migrate');
    // return view('welcome');
     abort(404);
});

Route::prefix('v1.0')->group(function () {

    Route::get('templateExample' , function (){return view('V1.templateExample');});

    Route::prefix('auth')->group(function () {
        Route::get('/login' , function (){return view('V1.auth.login');});
        Route::get('/register' , function (){return view('V1.auth.login');});
    });


        Route::prefix('profile')->group(function () {
        Route::get('/home' , function (){return view('V1.profile.home');});
        // Route::get('/home' , function (){return view('V1.templateExample');});


        Route::get('/types' , function (){return view('V1.profile.types.type');});
        Route::get('/maingroups' , function (){return view('V1.profile.mainGroups.mainGroup');});
        Route::get('/subgroups' , function (){return view('V1.profile.subGroups.subGroup');});
        Route::get('/products' , function (){return view('V1.profile.products.product');});


        Route::get('/restraunts' , function (){return view('V1.profile.restraunts.restraunt');});


    });



});
