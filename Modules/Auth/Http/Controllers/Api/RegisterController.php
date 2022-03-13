<?php

namespace Modules\Auth\Http\Controllers\Api;

use App\Http\Controllers\ApiCode;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Auth\Http\Controllers\AuthController;

class RegisterController extends AuthController
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|max:255|confirmed'
        ]);
    }

    /**
     * Initialize new User
     * 
     * @param array $data
     * @return \App\Models\User
     */
    protected function initUser(array $data)
    {
        try {
            $user = new User([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_BCRYPT)
            ]);

            $user->save();

            return $user;
        } catch (\PDOException $e) {
            error_log($e);
            return response()->json(['error' => 'Internal server error.'], ApiCode::INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Register new user
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function register(Request $request)
    {
        $credentials = $request->only(['name', 'email', 'password', 'password_confirmation']);
        $validator = $this->validator($credentials);

        if ($validator->fails()) {
            return response()->json($validator->errors(), ApiCode::BAD_REQUEST);
        }

        $user = $this->initUser($credentials);

        event(new Registered($user));

        return response()->json(['status' => 'Email verification sent!'], ApiCode::HTTP_CREATE);
    }
}
