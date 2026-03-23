<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Throwable $e) {
            return redirect()->route('login')
                ->with('success', 'Logowanie przez Google nie powiodło się.');
        }

        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            $user->google_id = $googleUser->getId();
            $user->email_verified_at = $user->email_verified_at ?? now();
            $user->save();
        } else {
            $user = User::create([
                'name' => $googleUser->getName() ?: 'Użytkownik Google',
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => Hash::make(Str::random(24)),
                'email_verified_at' => now(),
                'address' => null,
                'phone' => null,
            ]);
        }

        Auth::login($user, true);

        return redirect()->route('shoes.index');
    }
}
