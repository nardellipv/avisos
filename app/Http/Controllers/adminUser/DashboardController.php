<?php

namespace App\Http\Controllers\AdminUser;

use App\Favorite;
use App\Http\Controllers\Controller;
use App\NewsLetter;
use App\Region;
use App\Service;
use App\User;
use Illuminate\Support\Facades\Cookie;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::where('id', userConnect()->id)
            ->first();

        $regions = Region::all();

        $newsLetter = NewsLetter::where('email', $user->email)
            ->first();

        $countVisit = Service::where('user_id', $user->id)
            ->sum('visit');

        $countService = Service::where('user_id', $user->id)
            ->count();

        $countFavorite = Favorite::where('user_id', $user->id)
            ->count();


        if (!Cookie::get('lastLogin')) {
            $lastLogin = User::find($user->id);
            $lastLogin->lastLogin = now();
            $lastLogin->save();
            Cookie::queue('lastLogin', 'ultimoIngreso', '10');
        }

        Cookie::queue('login', 'ingreso', '2628000');

        return view('web.adminUser.dashboard.indexUser', compact(
            'user',
            'regions',
            'newsLetter',
            'countVisit',
            'countFavorite',
            'countService'
        ));
    }

    public function changeType($id)
    {
        $user = User::find($id);

        $this->authorize('updateClient', $user);

        $user->type = 'Anunciante';
        $user->save();

        toast()->success('Cambiaste el tipo de usuario a Anunciante');
        return back();
    }
}
