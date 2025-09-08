<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

class GoogleController extends Controller
{
    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (\Exception $e) {
            \Log::error('Google OAuth Redirect Error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Erro ao redirecionar para Google. Tente novamente.');
        }
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            // Configure HTTP client options for SSL issues in local environment
            $httpClient = new Client([
                'verify' => config('app.env') === 'local' ? false : true,
                'timeout' => 30,
            ]);
            
            $googleUser = Socialite::driver('google')
                ->setHttpClient($httpClient)
                ->user();
            
            // Check if user already exists
            $user = User::where('email', $googleUser->getEmail())->first();
            
            if ($user) {
                // User exists, update google_id if not set
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->getId()]);
                }
                Auth::login($user);
            } else {
                // Create new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(Str::random(24)), // Random password since they're using Google
                    'google_id' => $googleUser->getId(),
                    'profile_picture' => $googleUser->getAvatar(),
                    'is_admin' => 0, // Default to regular user
                ]);
                
                Auth::login($user);
            }
            
            return redirect()->intended(route('dashboard'));
            
        } catch (\Exception $e) {
            \Log::error('Google OAuth Callback Error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Erro ao fazer login com Google: ' . $e->getMessage());
        }
    }
}
