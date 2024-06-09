<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
    public function sendPasswordResetEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $token = Password::createToken($user);
            Mail::to($user->email)->send(new ResetPasswordEmail($user, $token));
            return response()->json(['message' => 'Password reset email sent'], 200);
        }

        return response()->json(['message' => 'User not found'], 404);
    }
}
