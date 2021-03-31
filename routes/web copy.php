<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;

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
// ===========route  ini untuk memisahkan login admin dan tamu===========//
Route::get('/', function () {
    return view('welcome');
});
// ===========route  ini untuk memisahkan login admin dan tamu===========//

// =================aktifkan route ini untuk aplikasi yang tidak butuh login tamu==============================//
// ini route home jika tidak memisahkan user dan admin
    // Route::get('/',[AdminController::class,'index'])->name('login_form');
// =================aktifkan route ini untuk aplikasi yang tidak butuh login tamu==============================//

// ========Admin Route=========== //
Route::prefix('admin')->group(function(){
    Route::get('/show/login/form',[AdminController::class,'index'])->name('login_form');
    Route::post('/login/owner',[AdminController::class,'login'])->name('admin.sing-in');
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/dashboard/logout',[AdminController::class,'logout'])->name('admin.logout')->middleware('admin');
});



Route::group(['middleware'=>'admin'],function(){

    Route::prefix('category')->group(function(){
        Route::post('showform',[CategoryController::class,'index'])->name('show.category.form');
        Route::get('/manage',[CategoryController::class,'manage'])->name('category.manage');
    });

});





// ========End admin Route=========== //

// =============route ini untuk dashboard login tamu klu tidak ada login tamu non aktifkan saja======//
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';
