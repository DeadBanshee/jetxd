<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $username = $request->username;

        $password = $request->password;

        $user = User::where('name', $username)->first();

        if($user && password_verify($password, $user->password)){

            $token = JWTAuth::fromUser($user);

            return response()->json([
                'message' => 'User logged in successfully',
                'user' => $user,
                'token' => $token
            ], 201);

        }

        return response()->json(
            ['message' => 'Error: Something went wrong during login'],
            409 // conflict status
        );
        
    }
    
    public function signUp(Request $request)
    {
        $username = $request->username;
        $email = $request->email;

        $checkUsername = User::where('username', $username)->first();
        $checkEmail = User::where('email', $email)->first();

        if ($checkUsername || $checkEmail) {
            return response()->json(
                ['message' => 'Error: you cannot use the same Username or Email'],
                409 // conflict status
            );
        }

        $password = password_hash($request->password, PASSWORD_BCRYPT);

        $newUser = new User;
        $newUser->name = $username;
        $newUser->email = $email;
        $newUser->password = $password;
        $newUser->save();
        $token = JWTAuth::fromUser($newUser);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $newUser,
            'token' => $token
        ], 201);
    }

    public function ping()
    {
        $user = auth()->user();

        return response()->json([
            'message' => 'Pong! You are authenticated.',
            'user' => $user
        ]);
    }

}
