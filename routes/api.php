<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ForSaleCardController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cards/searchCard/{name}',[CardController::class,"searchCard"]);

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('/users/logout',[UserController::class,"logoutUser"]);
    Route::post('/cards/newCard',[CardController::class,"newCard"]);
   // Route::get('/cards/searchCard/{name}',[CardController::class,"searchCard"]);
    Route::post('/collections/newCollection',[CollectionController::class,"newCollection"]);
    Route::post('/collections/editCollection',[CollectionController::class,"editCollection"]);
    Route::post('/forSaleCards/newForSaleCard',[ForSaleCardController::class,"newForSaleCard"]);
    
});

Route::get('/forSaleCards/searchForSaleCard/{name}',[ForSaleCardController::class,"searchForSaleCard"]);

Route::prefix('users')->group(function () {
    Route::post('/new',[UserController::class,"newUser"]);
    Route::post('/login',[UserController::class,"loginUser"]);
    Route::post('/forgotPassword',[UserController::class,"recoverPassword"]);
});


