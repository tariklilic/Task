<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Movies;
use App\Models\User;
use Validator;

class MoviesController extends Controller
{
    //function to search for a movie
    public function searchMovie(Request $request){
        $input = $request->all();

        $searchParam = $input['searchParam'];
        $pageSize = $input['pageSize'];
        $type = $input['type'];
        $yearFrom = $input['yearFrom'];
        $yearTo = $input['yearTo'];

        $match = array();
        if($searchParam != ''){
            $searchParamArray = array('title', 'LIKE', '%'.$searchParam.'%');
            array_push($match, $searchParamArray);
        }

        switch($type){
            case 1:
                $match['type'] = 'movie';
                break;
            case 2:
                $match['type'] = 'series';
                break;
            case 3:
                $match['type'] = 'game';
                break;
            default:
                return response()->json(['message' => 'Type must be between 1 and 3'], 400);
                break;
        }

        if($yearFrom != 0){
            $yearFromArray = array('year', '>', $yearFrom);
            array_push($match, $yearFromArray);
        } 

        if($yearTo != 0 && $yearTo > $yearFrom){
            $yearToArray = array('year', '<', $yearTo);
            array_push($match, $yearToArray);
        } else if ($yearTo != 0 && $yearTo < $yearFrom){
            return response()->json(['message' => 'Please insert greater year to parameter'], 400);
        }

        $movies = Movies::where($match)->paginate($pageSize);

        return $movies;
    }
    
    //function to add a new movie
    public function addMovie(Request $request, Movies $movie){
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'year'=>'required',
            'imdbID'=>'required',
            'type'=>'required',
            'poster'=>'required:movies',
        ]);

        if($validator->fails()){
            $response = response()->json($validator->errors()->toJson(), 400);
            return $response;
        }

        $input = $request->all();
        $existingTitle = Movies::where('title', '=', $input['title'])->first();
        
        if($existingTitle){
            return response()->json(['message' => 'That movie already exists'], 404);
        }

        $movie = Movies::create(array_merge(
            $validator->validated()
        ));

        $response = response()->json([
            'message'=>'Movie added successfully',
            'movie'=>$movie 
        ], 200);

        return $response;
    }

    //returns movie information by movie id
    public function getMovieById(int $id){
        $movie = Movies::find($id);

        if(!$movie){
            return response()->json(['message' => 'Movie not found'], 404);
        }

        return response()->json($movie, 200);
    }
}
