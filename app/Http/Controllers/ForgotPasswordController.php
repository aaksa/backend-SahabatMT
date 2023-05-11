<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Passwords\PasswordBroker;


class ForgotPasswordController extends Controller
{
    //

    public function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $response = $this->broker()->sendResetLink($request->only('email'));

    return $response == Password::RESET_LINK_SENT
        ? response()->json(['message' => 'Reset password email sent successfully'])
        : response()->json(['message' => 'Failed to send reset password email'], 500);
}

 protected function broker()
    {
        return Password::broker();
    }

public function reset(Request $request)
{

    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:8',
    ]);

    $response = $this->broker()->reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill(['password' => Hash::make($password)])->save();
        }
    );

    return $response == Password::PASSWORD_RESET
        ? response()->json(['message' => 'Password reset successfully'])
        : response()->json(['message' => 'Failed to reset password'], 500);
}
}
