<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login','register']]);
    }
    public function login()
    {
        $credentials = request(['dni', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'No estas Autorizado'], 401);
        }

        return $this->respondWithToken($token);
    }
    public function me()
    {
        return response()->json(auth()->user());
    }
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Logout']);
    }
}
