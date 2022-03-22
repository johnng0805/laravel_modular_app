<?php

namespace Modules\Auth\Http\Controllers\Web;

use App\Http\Controllers\ApiCode;
use Modules\Auth\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends AuthController
{
    public function index()
    {
        return view('auth::login');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:255|min:8'
        ]);
    }

    /**
     * Validate and login user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Routing\Redirector
     */
    protected function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $val = $this->validator($credentials);

        if ($val->fails()) {
            return back()->withErrors($val->errors());
        }

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], ApiCode::FORBIDDEN);
        }

        $request->session()->regenerate();

        Auth::login($request->user(), false);

        return redirect()->back();
    }
}
