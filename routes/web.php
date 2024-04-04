<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorcontroller;
use App\Http\Controllers\Admin\Admincontroller;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Auth\RigisterByPhoneController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\twoFactorMiddleware;



Auth::routes();

// register by phone
Route::get('/registerbyphone',[RigisterByPhoneController::class,'registerByPhone'])->name('registerbyphone');
Route::post('/registerphone',[RigisterByPhoneController::class,'create'])->name('RegisterPhone');

//password reset

Route::post('/forgotpassword',[twoFactorcontroller::class,'forgotpassword'])->name('forgot/password');
Route::post('/resetcodecheck/{user_id}',[twoFactorcontroller::class,'resetcodecheck'])->name('reset.code');
Route::post('/resetpassword',[twoFactorcontroller::class,'resetpassword'])->name('reset.password');

// verify email
Route::middleware(['auth'])->group(function(){
Route::get('/verify',[twoFactorcontroller::class,'index'])->name('verfiy.index');
Route::post('/verifycheck',[twoFactorcontroller::class,'store'])->name('verfiy.store');

});


Route::middleware(['auth',TwoFactorMiddleware::class])->group(function(){
   
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Product
Route::controller(ProductController::class)->group(function () {
    Route::get('/p/show/{user}', 'index',)->name('Product.index');
});


//profile 
Route::controller(ProfileController::class)->group(function () {
    Route::get('/change-password','changePassword')->name('changePassword');
    Route::post('/change-password','changePasswordSave')->name('postChangePassword');
    Route::get('/profile/{user}','index')->name('profile.show');
   
});

//adnin route
Route::middleware(AdminMiddleware::class)->group(function () {

    Route::controller(Admincontroller::class)->group(function () {
        Route::get('/dashbord', 'dashInfo')->name('dash.info');
        Route::get('/user/{user}/Product','userProduct')->name('admin.userProduct');
        Route::post('/admin/adduserprofile/{user_id}','addUserProfile')->name('admin.userProfile');
       
    });
    Route::controller(ProductAdminController::class)->group(function () {
        Route::get('/showallProduct', 'index')->name('admin.showProduct');
        Route::get('/admin/p/create', 'create')->name('admin.addProduct');
        Route::post('/admin/p','store')->name('admin.storeProduct');
        Route::delete('/admin/destroyProduct/{id}','destroy')->name('admin.ProductDestroy');
        Route::get('/admin/Product/{id}/edit', 'edit')->name('admin.ProductEdit');
        Route::patch('/admin/Product/{id}/update','update')->name('admin.ProductUpdate');
       
    });
    Route::controller(UserAdminController::class)->group(function () {
        Route::get('/showalluser', 'index')->name('admin.showUser');
        Route::get('/admin/user/create', 'create')->name('admin.addUser');
        Route::post('/admin/user','store')->name('admin.storeUser');
        Route::delete('/admin/destroyUser/{id}','delete')->name('admin.userDestroy');
        Route::get('/user/{id}/edit', 'edit')->name('admin.userEdit');
        Route::patch('/user/{id}/update','update')->name('admin.userUpdate');
       
    });

    });

});
