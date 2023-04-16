<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function _construct(){
        $this->middleware('auth:api', ['except'=>['login', 'register']]);
    }

    public function register(Request $request, User $user){
        $validator = Validator::make($request->all(), [
            'username'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5',
        ]);

        if($validator->fails()){
            $response = response()->json($validator->errors()->toJson(), 400);
            return $response;
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password'=>bcrypt($request->password)]
        ));

        $response = response()->json([
            'message'=>'User successfully registered',
            'user'=>$user 
        ], 200);
        return $response;
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
            'password'=>'required|min:5',
        ]);

        if($validator->fails()){
            $response = response()->json($validator->errors(), 422);
            return $response;
        }

        if(!$token=auth()->attempt($validator->validated())){
            $response = response()->json([
                'error'=>'Unauthorized',
                ], 401);
            return $response;
        }

        $newToken = $this->createNewToken($token);
        return $newToken;
    }

    public function createNewToken($token){
        $newToken = response()->json([
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>auth()->factory()->getTTL()*60*24,
        ]);
        
        return $newToken;
    }

    public function profile(Request $request){
        $user = auth()->user();
        $user->makeHidden('password');
        $response = response()->json($user);
        return $response;
    }

    public function logout(){
        auth()->logout();
        $response = response()->json([
            'message'=>'User logged out'
        ]);
        return $response;
    }
}
