<?php

namespace App\Http\Controllers\AdminUser;

use App\Favorite;
use App\Http\Controllers\Controller;
use App\NewsLetter;
use App\Notification;
use App\Region;
use App\Service;
use App\User;
use Illuminate\Support\Facades\Cookie;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Jambasangsang\Flash\Facades\LaravelFlash;

class DashboardController extends Controller
{
    public function index()
    {
        SEOMeta::setTitle('Avisos Mendoza | Dashboard');
        SEOMeta::setDescription('Llegá a más mendocinos publicando tu servicio en Avisos Mendoza totalmente gratis y en un instante.');

        OpenGraph::setDescription('Llegá a más mendocinos publicando tu servicio en Avisos Mendoza totalmente gratis y en un instante.');
        OpenGraph::setTitle('Avisos Mendoza');

        $user = User::where('id', userConnect()->id)
            ->first();

        $countVisit = Service::where('user_id', $user->id)
            ->sum('visit');

        $countService = Service::where('user_id', $user->id)
            ->count();

        $countFavorite = Favorite::where('user_id', $user->id)
            ->count();

        $countServiceSponsor = Service::where('user_id', userConnect()->id)
            ->where('status', 'Activo')
            ->where('publish', 'Destacado')
            ->count();

        $notificationList = Notification::where('date', '>=', now())
            ->orderBy('created_at', 'DESC')
            ->get();


        if (!Cookie::get('lastLogin')) {
            $lastLogin = User::find($user->id);
            $lastLogin->lastLogin = now();
            $lastLogin->save();
            Cookie::queue('lastLogin', 'ultimoIngreso', '10');
        }

        Cookie::queue('login', 'ingreso', '2628000');

        return view('web.adminUser.dashboard.indexUser', compact(
            'user',            
            'countVisit',
            'countFavorite',
            'countService',
            'countServiceSponsor',
            'notificationList'
        ));
    }

    public function personalData($id, $name)
    {
        $user = User::where('id', $id)
            ->where('name', $name)
            ->first();

        $this->authorize('updateClient', $user);

        $regions = Region::all();

        return view('web.adminUser.profile.editProfile', compact('user','regions'));
    }

    public function changeType($id)
    {
        $user = User::find($id);

        $this->authorize('updateClient', $user);

        $user->type = 'Anunciante';
        $user->save();

        LaravelFlash::withInfo('Cambiaste el tipo de usuario a Anunciante');
        return back();
    }
}
