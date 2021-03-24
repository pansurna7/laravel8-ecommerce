<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
    return view('welcome');
});
// ========Admin Route=========== //
Route::prefix('admin')->group(function(){
    Route::get('/show/login/form',[AdminController::class,'index'])->name('login_form');
    Route::post('/login/owner',[AdminController::class,'login'])->name('admin.sing-in');
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/dashboard/logout',[AdminController::class,'logout'])->name('admin.logout')->middleware('admin');
});
// ========End admin Route=========== //

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';