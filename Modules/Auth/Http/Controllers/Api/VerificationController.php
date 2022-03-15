<?php

namespace Modules\Auth\Http\Controllers\Api;

use App\Http\Controllers\ApiCode;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Modules\Auth\Http\Controllers\AuthController;

class VerificationController extends AuthController
{
    /**
     * Verify Email Address
     * 
     * @param \Illuminate\Http\Request 
     * @return \Illuminate\Http\Response
     */
    protected function verify(Request $request)
    {
        $userVerify = UserVerify::where('user_id', $request->user_id)->first();

        if (!hash_equals((string) $request->token, $userVerify->token)) {
            #throw new AuthorizationException();
            return response()->json([
                "error" => "Unauthorized"
            ], ApiCode::UNAUTHENTICATED);
        }

        $user = User::where('id', $request->user_id)->first();

        if (!$user->markEmailAsVerified()) {
            event(new Verified($user));
        } else {
            return response()->json([
                "status" => "Email already verified!"
            ], ApiCode::METHOD_NOT_ALLOWED);
        }

        return response()->json([
            "status" => "Email verified!"
        ], ApiCode::HTTP_OK);
    }
}
