<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account']) // Optional: force account selection
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            $user = User::updateOrCreate(
                ['email' => $googleUser->email],
                [
                    'name' => $googleUser->name,
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'password' => encrypt(Str::random(16)),
                    'email_verified_at' => now(),
                ]
            );

            // Login with "remember me" for 30 days
            Auth::login($user, true);
            
            // Regenerate session to prevent fixation
            request()->session()->regenerate();
            
            return redirect()->intended('/');

        } catch (\Exception $e) {
            Log::error('Google Auth Error: '.$e->getMessage());
            return redirect('/login')->with('error', 'Google login failed. Please try again.');
        }
    }
}