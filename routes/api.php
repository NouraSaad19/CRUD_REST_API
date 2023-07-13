<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/todo' , [todoController::class , 'index']);
Route::post('/todo' , [todoController::class , 'store']);
Route::get('/todo/{id}' , [todoController::class , 'show']);
Route::get('/todo/{id}/edit' , [todoController::class , 'edit']);
