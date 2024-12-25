<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(AuthController::class)->group(function () {
   
    Route::post('login','login');
    Route::post('signup','signup');
    Route::get('check_Auth_phone_number/{contact_number}','check_Auth_phone_number');
    
    
});


Route::controller(HomeController::class)->group(function () {
   
Route::get('category','category');
Route::get('district','district');
Route::post('affiliation_product_insert','affiliation_product_insert');
Route::post('affiliation_product_img_path_insert','affiliation_product_img_path_insert');

Route::get('getAllOrder','getAllOrder');
Route::get('getOneOrder/{id}','getOneOrder');
Route::get('order_card_holder/{id}','order_card_holder');
Route::get('order_card_holder_by_tid/{id}','order_card_holder_by_tid');
Route::post('order_confirmation_history','order_confirmation_history');


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

});




