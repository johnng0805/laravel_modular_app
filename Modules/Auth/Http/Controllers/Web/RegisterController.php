<?php

namespace Modules\Auth\Http\Controllers\Web;

use App\Http\Controllers\ApiCode;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Auth\Http\Controllers\AuthController;

class RegisterController extends AuthController
{
    public function index()
    {
        return view('auth::register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|string',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|max:255|min:8|confirmed'
        ]);
    }

    /**
     * Initialize User
     * @param array $data
     * @return \App\Models\User
     */
    protected function initUser(array $data)
    {
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_BCRYPT),
            ]);

            $user->save();

            return $user;
        } catch (\PDOException $e) {
            error_log($e);
            return response()->json($e->getMessage(), ApiCode::INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Register User
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Routing\Redirector
     */
    protected function register(Request $request)
    {
        $credentials = $request->all();
        $validator = $this->validator($credentials);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $user = $this->initUser($credentials);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('verification.notice');
    }
}
