<?php

namespace Modules\Auth\Http\Controllers\Api;

use App\Http\Controllers\ApiCode;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
     * Send verification email
     * 
     * @param \App\Models\User $user
     * @param string $token
     * @return bool
     */
    public function sendEmail(User $user, string $token)
    {
        try {
            $data = [
                'user_id' => $user->id,
                'token' => $token
            ];

            Mail::send('auth::emailVerificationEmail', $data, function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Laravel Verification Email');
            });
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return false;
        }

        return true;
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

        $token = sha1(time());

        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);


        $this->sendEmail($user, $token);

        #event(new Registered($user));

        return response()->json(['status' => 'Email verification sent!'], ApiCode::HTTP_CREATE);
    }
}
