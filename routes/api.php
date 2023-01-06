<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AnnonceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/Login',[AuthController::class,'Login']);
Route::post('/Logout',[AuthController::class,'Logout']);
Route::get('/Annonces',[AnnonceController::class,'index']);
Route::get('/Details/{id}',[AnnonceController::class,'details']);
Route::post('/Message',[AnnonceController::class,'message']);
Route::post('/Register',[AuthController::class,'create']);
Route::post('/Publier',[AnnonceController::class,'create']);
Route::get('/UserStats/{id}',[AuthController::class,'UserStats']);