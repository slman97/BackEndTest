<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\twoFactorcontroller;
use App\Http\Controllers\Admin\Admincontroller;
use App\Http\Controllers\Admin\userAdminController;
use App\Http\Controllers\Admin\postAdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\twoFactorMiddleware;



Auth::routes();


//password reset
Route::post('/forgotpassword',[twoFactorcontroller::class,'forgotpassword'])->name('forgot/password');
Route::post('/resetcodecheck/{user_id}',[twoFactorcontroller::class,'resetcodecheck'])->name('reset.code');
Route::post('/resetpassword',[twoFactorcontroller::class,'resetpassword'])->name('reset.password');

// verify email
Route::middleware(['auth'])->group(function(){
Route::get('/verify',[twoFactorcontroller::class,'index'])->name('verfiy.index');
Route::post('/verifycheck',[twoFactorcontroller::class,'store'])->name('verfiy.store');

});


Route::middleware(['auth',twoFactorMiddleware::class])->group(function(){
   
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// post
Route::controller(PostsController::class)->group(function () {
    Route::get('/p/show/{user}', 'index')->name('post.index');
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
        Route::get('/user/{user}/post','userPost')->name('admin.userPost');
        Route::post('/admin/adduserprofile/{user_id}','addUserProfile')->name('admin.userProfile');
       
    });
    Route::controller(postAdminController::class)->group(function () {
        Route::get('/showallpost', 'index')->name('admin.showPost');
        Route::get('/admin/p/create', 'create')->name('admin.addPost');
        Route::post('/admin/p','store')->name('admin.storePost');
        Route::delete('/admin/destroyPost/{id}','destroy')->name('admin.PostDestroy');
        Route::get('/admin/post/{id}/edit', 'edit')->name('admin.postEdit');
        Route::patch('/admin/post/{id}/update','update')->name('admin.postUpdate');
       
    });
    Route::controller(userAdminController::class)->group(function () {
        Route::get('/showalluser', 'index')->name('admin.showUser');
        Route::get('/admin/user/create', 'create')->name('admin.addUser');
        Route::post('/admin/user','store')->name('admin.storeUser');
        Route::delete('/admin/destroyUser/{id}','delete')->name('admin.userDestroy');
        Route::get('/user/{id}/edit', 'edit')->name('admin.userEdit');
        Route::patch('/user/{id}/update','update')->name('admin.userUpdate');
       
    });

    });

});
