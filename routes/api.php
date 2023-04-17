<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Models\Movies;


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

Route::group(['middleware'=>'api', 'prefix'=>'auth'], function($router){
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});


Route::middleware('auth.token')->group(function () {
    //movie endpoints
    Route::post('/addMovie', [MoviesController::class, 'addMovie']);
    Route::get('/movie/{id}', [MoviesController::class, 'getMovieById']);
    Route::get('/searchMovie', [MoviesController::class, 'searchMovie']);

    //user endpoints
    Route::post('/followMovie', [UserController::class, 'followMovie']);
    Route::get('/getUserMovies', [UserController::class, 'getUserMovies']);
    Route::get('/user/{id}', [UserController::class, 'getUserById']);
    Route::get('/profile', [UserController::class, 'profile']);
    Route::get('/logout', [UserController::class, 'logout']);

    //movie and user slug endpoints
    Route::get('user/slug/{user:slug}', function (User $user) {
        return $user;
    });
    Route::get('movie/slug/{movie:slug}', function (Movies $movie) {
        return $movie;
    });
});
