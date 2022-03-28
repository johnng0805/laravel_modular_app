<?php

namespace Modules\Auth\Http\Controllers\Web;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Modules\Auth\Http\Controllers\AuthController;

class ResetPasswordController extends AuthController
{
    /**
     * Return reset form
     * @param string $tokens
     * @return Renderable
     */
    public function form(string $token)
    {
        return view('auth::passwordReset', ['token' => $token]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:4|max:255|confirmed',
            'token' => 'required'
        ]);
    }

    protected function reset(Request $request)
    {
        $credentials = $request->except(['_token']);
        $validator = $this->validator($credentials);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $status = Password::reset($credentials, function ($user, $password) {
            $user->forcefill([
                'password' => password_hash($password, PASSWORD_BCRYPT)
            ]);

            $user->save();

            event(new PasswordReset($user));
        });

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
