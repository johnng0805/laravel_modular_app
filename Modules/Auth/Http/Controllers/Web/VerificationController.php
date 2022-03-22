<?php

namespace Modules\Auth\Http\Controllers\Web;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Modules\Auth\Http\Controllers\AuthController;

class VerificationController extends AuthController
{
    /**
     * Return email notice
     * @return Renderable
     */
    protected function notice()
    {
        return view('auth::emailNotice');
    }

    /**
     * Verify email
     * @param \Illuminate\Foundation\Auth\EmailVerificationRequest $request
     * @return \Illuminate\Routing\Redirector
     */
    protected function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route("welcome");
    }

    /**
     * Resend verification email
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification Link Sent!');
    }
}
