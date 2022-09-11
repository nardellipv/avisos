<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Route;
use Artesaos\SEOTools\Facades\SEOMeta;

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
  // protected $redirectTo = '/dashboard';


  public function showLoginForm()
  {
    SEOMeta::setTitle('Avisos Clasificados Mendoza Gratis ' . date('Y'));
    SEOMeta::setDescription('Ingresa al sitio para poder publicar tus avisos en un instante y totalmente gratis');

    SEOMeta::addKeyword([
      'Mendoza Trabajo', 'Mendoza Clasificados', 'Clasificados Los Andes', 'Clasificados diario uno',
      'avisos clasificados de mendoza', 'Clasificados Mendoza alquileres'
    ]);

    if (!session()->has('url.intended')) {
      session(['url.intended' => url()->previous()]);
      return redirect('/dashboard');
    }
    return view('auth.login');
  }

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
    if (url()->previous() != '*/login') {
      $this->redirectTo = url()->previous();
    }
  }
}
