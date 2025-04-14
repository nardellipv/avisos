<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\User;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = \App\User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'lastname' => '-', // apellido por defecto
                    'password' => bcrypt(uniqid()),
                    'type' => 'Cliente',
                    'region_id' => 1, // región por defecto ("Sin especificar")
                    'photo' => $googleUser->getAvatar(), // foto de Google
                ]
            );

            Auth::login($user);

            // Si es nuevo o tiene datos incompletos, redirigir a completar perfil
            if ($user->wasRecentlyCreated || $user->lastname === '-' || $user->region_id == 1) {
                return redirect()->route('dashboard.personalData', [$user->id, \Str::slug($user->name)]);
            }

            return redirect()->route('dashboard.index');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Error al iniciar sesión con Google.');
        }
    }
}
