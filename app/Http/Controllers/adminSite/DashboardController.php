<?php

namespace App\Http\Controllers\adminSite;

use App\Http\Controllers\Controller;
use App\Region;
use App\Service;
use App\TempSponsor;
use App\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $userClientCount = User::where('type', 'Cliente')
            ->count();

        $userAnunCount = User::where('type', 'Anunciante')
            ->count();

        $serviceActiveCount = Service::where('status', 'Activo')
            ->count();

        $servicePausedCount = Service::where('status', 'Pausado')
            ->count();

        $users = User::with(['region'])
            ->get();

        $servicePending = Service::where('status', 'PENDIENTE')
            ->get();

        $serviceSponsorPending = TempSponsor::with(['service'])
            ->where('pay', 'N')
            ->get();

        $publicDays = Storage::disk('public')->get('dayPublic.txt');
        $sponsorDays = Storage::disk('public')->get('daySponsor.txt');

        return view('admin.indexAdminSite', compact(
            'userClientCount',
            'userAnunCount',
            'serviceActiveCount',
            'users',
            'servicePending',
            'servicePausedCount',
            'publicDays',
            'sponsorDays',
            'serviceSponsorPending'
        ));
    }

    public function incrementService()
    {
        $services = Service::get();

        foreach ($services as $service) {
            $visitRand = $service->visit + rand('20', '50');
            $votePositve = $service->like + rand('6', '15');
            $service->visit = $visitRand;
            $service->like = $votePositve;
            $service->save();
        }

        return back();
    }

    public function sitemap()
    {
        /* $files = storage_path('public');
        dd($files); */
        // eliminamos el archivo
        /* $siteMap = 'https://guiaceliaca.com.ar/sitemap.xml';
        // dd($siteMap);
        unlink($siteMap); */
        $sitemap = App::make("sitemap");

        $sitemap->add(URL::to('/'), \Carbon\Carbon::now(), '1.0', 'daily');
        $sitemap->add(URL::to('https://avisosmendoza.com.ar/listado'), \Carbon\Carbon::now(), '0.50', 'daily');

        $services = Service::where('status', 'Activo')->orderBy('created_at', 'desc')->get();
        $regions = Region::get();

        // listado de servicios
        foreach ($services as $service) {
            $sitemap->add("https://avisosmendoza.com.ar/servicio/" . $service->slug . '/referencia/' . $service->ref, $service->created_at);
        }

        // listado de regiones
        foreach ($regions as $region) {
            $sitemap->add("https://avisosmendoza.com.ar/listado/localidad/" . $region->slug);
        }

        $sitemap->store('xml', 'sitemap', base_path('../public_html'));
        // $sitemap->store('xml', 'sitemap');
        return back();
    }

    public function changeDaysService(Request $request)
    {
        Storage::disk('public')->put('dayPublic.txt', $request->publicDays);
        Storage::disk('public')->put('daySponsor.txt', $request->sponsorDays);
        return back();
    }
}
