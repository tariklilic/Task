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
        //return view('movies/getMovies', ['movies'=>$movies]);
       return $movies;
    }

    public function viewAddMovie(){
        return view('addMovie.index');
    }

    public function addMovie(Request $request){
        $request->validate([
            'title'=>'required',
            'year'=>'required',
            'imdbID'=>'required',
            'type'=>'required',
            'poster'=>'required:movies',
        ]);

        $query = DB::table('movies')->insert([
            'title'=>$request->input('title'),
            'year'=>$request->input('year'),
            'imdbID'=>$request->input('imdbID'),
            'type'=>$request->input('type'),
            'poster'=>$request->input('poster'),
        ]);

        if($query){
            return back()->with('success', 'Movie has been added');
        } else {
            return back()->with('error', 'Something went wrong with adding your movie');
        }
    }

}
