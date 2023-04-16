<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Movies;
use DB;

class UserController extends Controller
{
    //function for user to follow a movie
    public function followMovie(Request $request){
        try{
            $input = $request->all();
    
            $userId = auth()->user()->id;
            $movieId = $input['movieId'];
    
            $user = User::find($userId);
            $movie = Movies::find($movieId);

            //check if user already follows that movie
            $hasMovie = DB::table('movies_user')->where('user_id', $userId)
                                                ->where('movies_id', $movieId)
                                                ->exists();
            if ($hasMovie) {
                return response()->json(['message'=>"You already follow that movie"], 404);
            } 

            //check if movie exists
            $movieExists = DB::table('movies')->max('id');
            if ($movieId > $movieExists || $movieId < 0) {
                return response()->json(['message'=>"That movie doesn't exist"], 404);
            } 
    
            $user->movies()->attach($movie->id);
            
            return response()->json(['message'=>"'".$movie->title."' followed successfully"], 404);
        }
        catch (Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    //returns all users and their movies 
    public function getUserMovies(Request $request){
        $input = $request->all();

        $userId = auth()->user()->id;
        $pageSize = $input['pageSize'];

        $query = DB::table('movies_user')->join('movies', 'movies_user.movies_id', '=', 'movies.id');
        $query->where('user_id', $userId);
        $movies = $query->paginate($pageSize);

        return $movies;
    }

    //returns user information by user id
    public function getUserById(int $id){
        $user = User::find($id);

        if(!$user){
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user, 200);
    }
}
