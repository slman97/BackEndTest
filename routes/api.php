<?php
use App\Http\Controllers\API\userController;
use App\Http\Controllers\API\adminController;
use Illuminate\Http\Request;
use App\Http\Middleware\TwoFactorMiddleware;
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



Route::middleware(['auth:sanctum',TwoFactorMiddleware::class])->group(function(){
    Route::post('/logout', [userController::class ,'logoutUser']);
    Route::post('/userproduct', [userController::class ,'userProduct']);
    Route::post('/editpassword', [userController::class ,'editPassword']);
});

Route::middleware(['auth:sanctum',AdminMiddleware::class,TwoFactorMiddleware::class])->group(function(){
    Route::controller(adminController::class)->group(function(){
    Route::get('/admin/userproduct/{id}' ,'usersProduct');
    Route::get('/admin/alluserproduct','allUserProduct');
    Route::get('/admin/alluser','allUser');
    Route::post('/admin/adduser','addUser');
    Route::post('/admin/addproduct','addProduct');
    Route::post('/admin/edituser','editUser');
    Route::post('/admin/editproduct','editProduct');
    Route::post('/admin/deleteuser','deleteUser');
    Route::post('/admin/deleteproduct','deleteProduct');
    Route::post('/admin/addprofile','addProfile');
    });
    });
    
