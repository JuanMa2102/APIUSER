<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AplicationController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ModuleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::prefix('/user')->group(function(){
    //Route login
    Route::post('/login', [LoginController::class,'login']);
    //Route Logout
    Route::middleware('auth:api')->post('/logout', [LoginController::class, 'logout']);
    //Route para register users
    Route::post('/register', [RegisterController::class, 'register']);
    Route::apiResource('users', UserController::class)->middleware('auth:api');
    //Route CRUD Aplication
    Route::apiResource('aplications', AplicationController::class);
    // Route CRUD Business
    Route::apiResource('businesses', BusinessController::class);
    // Route CRUD Modules
    Route::apiResource('modules', ModuleController::class);
   
   
    
});