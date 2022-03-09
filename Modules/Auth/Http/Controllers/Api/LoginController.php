<?php

namespace Modules\Auth\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Validator;

class LoginController extends AuthController
{
    /**
     * Validate incoming request's data.
     *  
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:255'
        ]);
    }

    /**
     * Login user
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        $validator = $this->validator($credentials);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Email or password incorrect.'], 403);
        }

        $token = $request->user()->createToken('laravel-token', ['user:basic'])->plainTextToken;

        return response()->json([
            'user' => $request->user(),
            'token' => $token
        ], 200);
    }
}
