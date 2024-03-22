<?php
use App\Http\Controllers\API\userController;
use App\Http\Controllers\API\adminController;
use Illuminate\Http\Request;
use App\Http\Middleware\twoFactorMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;


Route::controller(userController::class)->group(function(){
    Route::post('/register', 'registerUser');
    Route::post('/verfiycheck','userVerifyCodeCheck');
    Route::post('/login','loginUser');
    Route::post('/forgotpassword','forgotPassword');
    Route::post('/resetcodecheck','verfiycheck');
    Route::post('/resetpassword','resetpassword');
});



Route::middleware(['auth:sanctum',twoFactorMiddleware::class])->group(function(){
    Route::post('/logout', [userController::class ,'logoutUser']);
    Route::post('/userpost', [userController::class ,'userPost']);
    Route::post('/editpassword', [userController::class ,'editPassword']);
});

Route::middleware(['auth:sanctum',AdminMiddleware::class,twoFactorMiddleware::class])->group(function(){
    Route::controller(adminController::class)->group(function(){
    Route::get('/admin/userpost/{id}' ,'userspost');
    Route::get('/admin/alluserpost','allUserPost');
    Route::get('/admin/alluser','allUser');
    Route::post('/admin/adduser','addUser');
    Route::post('/admin/addpost','addPost');
    Route::post('/admin/edituser','editUser');
    Route::post('/admin/editpost','editPost');
    Route::post('/admin/deleteuser','deleteuser');
    Route::post('/admin/deletepost','deletepost');
    Route::post('/admin/addprofile','addProfile');
    });
    });
    
