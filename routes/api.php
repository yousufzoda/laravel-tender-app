<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TenderController;

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
Route::resource('tenders', TenderController::class);

Route::post('register',[AuthController::class,'registerUser']);
Route::post('login',[AuthController::class,'loginUser']);
Route::middleware('auth:api')->group(function(){
    Route::get('user', [AuthController::class,'authenticatedUser']);

});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


