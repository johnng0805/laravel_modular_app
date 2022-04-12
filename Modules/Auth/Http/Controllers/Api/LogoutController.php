<?php

namespace Modules\Auth\Http\Controllers\Api;

use App\Http\Controllers\ApiCode;
use Illuminate\Http\Request;
use Modules\Auth\Http\Controllers\AuthController;

class LogoutController extends AuthController
{
    protected function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['status' => 'Logout Successfully'], ApiCode::HTTP_OK);
    }

    protected function logoutAll(Request $request)
    {
        $request->user()->delete();

        return response()->json(['status' => 'Logout Successfully'], ApiCode::HTTP_OK);
    }
}