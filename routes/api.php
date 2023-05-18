<?php

use App\Http\Controllers\productController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/signup',[UserController::class,'Signup']);
Route::post('/login',[UserController::class,'Login']);
Route::middleware('login')->group(function(){
Route::get('/test',[UserController::class,'test']);
});
Route::get('intent',[productController::class,'show']);
Route::post('pur',[productController::class,'purchase']);
