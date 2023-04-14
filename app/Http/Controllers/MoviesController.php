<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MoviesController extends Controller
{
    public function getMovies(){
       $movies = DB::select('SELECT * FROM movies');
       // return view('movies/getMovies', ['movies'=>$movies]);
       return $movies;
    }
}
