<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\todoController;

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


Route::post('register' , [AuthController::class , 'register']);
Route::post('login' , [AuthController::class , 'login']);
Route::get('/todo' , [todoController::class , 'index']);
Route::post('/todo' , [todoController::class , 'store']);
Route::get('/todo/{id}' , [todoController::class , 'show']);
Route::get('/todo/{id}/edit' , [todoController::class , 'edit']);
Route::put('/todo/{id}' , [todoController::class , 'update']);
Route::delete('/todo/{id}' , [todoController::class , 'destroy']);

