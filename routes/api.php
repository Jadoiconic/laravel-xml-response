<?php

use App\Http\Controllers\CategoriesController;
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


Route::get('/categories', [CategoriesController::class,'index']);
Route::get('/categories/{id}', [CategoriesController::class,'show']);
Route::post('/categories', [CategoriesController::class,'store']);
Route::put('/categories/{id}', [CategoriesController::class,'update']);
Route::delete('/categories/{id}', [CategoriesController::class,'destroy']);
