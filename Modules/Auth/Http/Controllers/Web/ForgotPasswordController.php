<?php

namespace Modules\Auth\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Modules\Auth\Http\Controllers\AuthController;

class ForgotPasswordController extends AuthController
{
    public function index()
    {
        return view('auth::forgotPassword');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => "required|email|max:255"
        ]);
    }

    /**
     * Request Password Reset Link
     * @param \Iluminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function requestLink(Request $request)
    {
        $credentials = $request->only('email');
        $validator = $this->validator($credentials);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $status = Password::sendResetLink($credentials);

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
