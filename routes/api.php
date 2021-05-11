<?php


use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Crud\FormController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::post('/create',[FormController::class,'create']);
    Route::get('/edit/{id}',[FormController::class,'edit']);
    Route::post('/update/{id}',[FormController::class,'update']);
    Route::get('/delete/{id}',[FormController::class,'delete']);
    Route::get('/logout',[AuthController::class,'logout']);

});
Route::post('/login',[AuthController::class,'login']);
