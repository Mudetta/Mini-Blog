<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UsersController extends Controller
{
    public function register(Request $request)
    {
        $input = $request->all();
        $validate = Validator::make($input,[
            "name" => "required",
            "email" => "required|email",
            "password" => "required|min:8"
        ]);
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);

        $token = $user->createToken('miniBlog')->accessToken;

        return response()->json([
            "token" => $token
        ]);
    }

    public function login(Request $request)
    {
        $data = [
            "email" => $request->email,
            "password" => $request->password
        ];

        if (auth()->attempet($data))
        {
            $token = auth()->user()->createToken('miniBlog')->accessToken;
            return resposne()->json([
                "token" => $token
            ]);
            }

            else {
                return response()->json([
                    "error" => "user not found"
                ]);
            }
       
    }

    public function userInfo()
    {
        $user = auth()->user();
        return resonse()->json([
            "user" => $user
        ]);
    }


}
