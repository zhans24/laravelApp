<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',function (){
    return view('login');
});

Route::get('/register',function (){
    return view('register');
});

Route::post('/login',[UserController::class,'login']);
Route::post('/register',[UserController::class,'register']);

Route::middleware(['auth'])->group(function (){
   Route::get('/profile',function (){
       return view('profile');
   });
});
