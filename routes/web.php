<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//pages
Route::get('/addmovie', [MoviesController::class, 'viewAddMovie']);

//movie endpoints
Route::get('api/movies', [MoviesController::class, 'getMovies']);
Route::post('api/addMovie', [MoviesController::class, 'addMovie']);
Route::get('api/movie/{id}', [MoviesController::class, 'getMovieById']);
Route::get('api/movieByName', [MoviesController::class, 'getMovieBySearchParam']);