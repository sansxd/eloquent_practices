<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthPost;
use JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class AuthController extends Controller
{
    public function register(AuthPost $request)
    {
        $validated = $request->validated();
        if ($validated) {
            $user = User::create($request->all());
            $token = auth()->login($user);
            return $this->respondWithToken($token);
        }
    }

    public function login(Request $request)
    {

        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
