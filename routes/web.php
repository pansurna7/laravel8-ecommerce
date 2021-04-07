<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ParmissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;

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
// // ===========route  ini untuk memisahkan login admin dan tamu===========//
// Route::get('/', function () {
//     return view('welcome');
// });
// ===========route  ini untuk memisahkan login admin dan tamu===========//

// =================aktifkan route ini untuk aplikasi yang tidak butuh login tamu==============================//
// ini route home jika tidak memisahkan user dan admin

Route::get('/',[AdminController::class,'index'])->name('login_form');

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
        Route::get('/show/form',[CategoryController::class, 'show'])->name('category.add');
        Route::post('/store/data',[CategoryController::class,'store'])->name('category.store');
        Route::get('/manage',[CategoryController::class,'manage'])->name('category.manage');
        Route::get('/destroy/{id}',[CategoryController::class,'destroy'])->name('category.destroy');
        Route::get('/hide/{id}',[CategoryController::class,'hide'])->name('category.hide');
        Route::get('/public/{id}',[CategoryController::class,'public'])->name('category.public');
        Route::post('/update/{id}',[CategoryController::class,'update'])->name('category.update');
    });

    Route::prefix('items')->group(function(){
        Route::get('/show/form',[ItemController::class,'index'])->name('show.items.form');
        Route::get('/manage',[ItemController::class,'manage'])->name('items.manage');

    });


});

//===========================ACL=====================================//
Route::prefix('user')->group(function(){
    Route::get('/show-all-user',[AdminController::class,'users'])->name('all-user');
    Route::get('/user-create',[AdminController::class,'create'])->name('user.create');
    Route::post('/store',[AdminController::class,'store'])->name('user.store');
    Route::get('/edit-{admin}',[AdminController::class,'edit'])->name('user-edit');
    Route::get('/destroy/{id}',[AdminController::class,'destroy'])->name('user.destroy');
    Route::post('/update/{admin}',[AdminController::class,'update'])->name('user.update');

});

Route::prefix('role')->group(function(){
    Route::get('/show-all-role',[RoleController::class,'index'])->name('role.index');
    Route::get('/role-create',[RoleController::class,'create'])->name('role.create');
    Route::post('/store',[RoleController::class,'store'])->name('role.store');
    Route::get('/destroy/{id}',[RoleController::class,'destroy'])->name('role.destroy');
    Route::post('/update/{id}',[RoleController::class,'update'])->name('role.update');

});
Route::prefix('parmission')->group(function(){
    Route::get('/show-all-parmission',[ParmissionController::class,'index'])->name('parmission.index');
    Route::get('/parmission-create',[ParmissionController::class,'create'])->name('parmission.create');
    Route::post('/store',[ParmissionController::class,'store'])->name('parmission.store');
    Route::get('/destroy/{id}',[ParmissionController::class,'destroy'])->name('parmission.destroy');
    Route::get('/edit/{id}',[ParmissionController::class,'edit'])->name('parmission.edit');
    Route::post('/update/{id}',[ParmissionController::class,'update'])->name('parmission.update');

});

Route::prefix('menu')->group(function(){
    Route::get('/show-all-menu',[MenuController::class,'index'])->name('menu.index');
    // Route::get('/menu-create',[MenuController::class,'create'])->name('menu.create');
    Route::post('/store',[MenuController::class,'store'])->name('menu.store');
    Route::get('/destroy/{id}',[MenuController::class,'destroy'])->name('menu.destroy');
    Route::post('/update/{id}',[MenuController::class,'update'])->name('menu.update');

});

Route::prefix('profile')->group(function(){
    Route::get('/show-profile',[ProfileController::class,'index'])->name('profile.index');
    Route::post('/update/{admin}',[ProfileController::class,'update'])->name('profile.update');

});

//==============P============END ACL=====================================//





// ========End admin Route=========== //

// // =============route ini untuk dashboard login tamu klu tidak ada login tamu non aktifkan saja======//
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


// require __DIR__.'/auth.php';

