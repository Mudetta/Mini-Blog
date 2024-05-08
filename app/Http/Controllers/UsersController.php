<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UsersController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "name"      => "required",
            "email"     => "required|email|unique:users,email",
            "password"  => "required|min:8"
        ]);

        if ($validator->fails())
        {
            return response()->json([
                "message" => "Sorry, registration has been denied",
                "errors" => $validator->errors()
            ], 422);
        }

        $user = User::create([
            "name"      => $request->name,
            "email"     => $request->email,
            "password"  => bcrypt($request->password)
        ]);

        $token = $user->createToken("miniBlog")->accessToken;
        return response()->json([
            "message" => "Congrats, Registered successfully",
            "token"   => $token
        ], 200);
    }


    public function login(Request $request)
    {   
        $data = [
            "email"    => $request->email,
            "password" => $request->password
        ];

        if(auth()->attempt($data))
        {
            $token = auth()->user()->createToken("miniBlog")->accessToken;
            return response()->json([
                "message" => "Welcome back, Sign in successfully!",
                "token"   => $token
            ], 200);
        } else{
            return response()->json([
                "message" => "Sorry, User not found!"
            ], 401);
        }
    }


    public function userInfo()
    {
        $user = auth()->user();
        return response()->json([
            "userInfo" => $user
        ], 200);
    }
}
