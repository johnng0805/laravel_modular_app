<?php

namespace Modules\Auth\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Http\Controllers\AuthController;

class LogoutController extends AuthController
{
    /**
     * Log user out of application
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect("/");
    }
}