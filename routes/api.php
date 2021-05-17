<?php


use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Crud\FormController;
use App\Http\Controllers\Api\Crud\ScoreController;
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
    // crud student
    Route::post('/create',[FormController::class,'create']);
    Route::get('/edit/{id}',[FormController::class,'edit']);
    Route::post('/update/{id}',[FormController::class,'update']);
    Route::get('/delete/{id}',[FormController::class,'delete']);

    // crud multiple relation to student
    Route::post('/create-nilai',[ScoreController::class,'create']);
    Route::get('/data-student/{id}',[ScoreController::class,'getStudent']);
    Route::post('/update-student/{id}',[ScoreController::class,'updateStudent']);

    Route::get('/logout',[AuthController::class,'logout']);



});
Route::post('/login',[AuthController::class,'login']);
