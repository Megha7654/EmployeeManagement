<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmpAuthController;
use App\Http\Controllers\PostController;
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
Route::get('/register',[EmpAuthController::class,'register'])->name('register');
Route::get('/dashboard',[EmpAuthController::class,'dashboard'])->name('dashboard');
Route::get('/login',[EmpAuthController::class,'login'])->name('login');
Route::get('/logout',[EmpAuthController::class,'logout'])->name('logout');

Route::resource('/post',PostController::class);


Route::post('/createemp',[EmpAuthController::class,'create'])->name('createemp');
Route::post('/authemp',[EmpAuthController::class,'authemp'])->name('authemp');