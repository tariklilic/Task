<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Movies;

class MoviesController extends Controller
{
    public function viewAddMovie(){
        return view('addmovie.index');
    }

    public function getMovieById(int $id){
        $movie = Movies::find($id);

        if(!$movie){
            return response()->json(['message' => 'Movie not found'], 404);
        }
        return response()->json($movie, 200);
    }

    public function getMovies(Request $request){
       $input = $request->all();
       $pageOffset = $input['pageNumber'] * $input['pageSize'];
       $pageSize = $input['pageSize'];
       $movies = DB::select("SELECT * FROM movies LIMIT $pageSize OFFSET $pageOffset");
       return $movies;
    }

    public function getMovieBySearchParam(Request $request){
        $input = $request->all();
        $searchParam = $input['searchParam'];
        $pageOffset = $input['pageNumber'] * $input['pageSize'];
        $pageSize = $input['pageSize'];

        $countMovies = DB::select("SELECT COUNT(id) AS movieCount FROM movies WHERE title LIKE '%".$searchParam."%'");
        $movies = DB::select("SELECT * FROM movies WHERE title LIKE '%".$searchParam."%' LIMIT $pageSize OFFSET $pageOffset");

        return array_merge($movies, $countMovies);
    }
    
    public function addMovie(Request $request){
        $request->validate([
            'title'=>'required',
            'year'=>'required|number',
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
