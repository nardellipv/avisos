<?php

namespace App\Http\Controllers\adminSite;

use App\Http\Controllers\Controller;
use App\Service;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

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

        $users = User::with(['region'])
            ->get();

        $services = Service::paginate(10);

        return view('admin.indexAdminSite', compact(
            'userClientCount',
            'userAnunCount',
            'serviceActiveCount',
            'users',
            'services'
        ));
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

        $services = Service::orderBy('created_at', 'desc')->get();
        
        $priorityService = '0.80';

        // listado de comercios
        foreach ($services as $service) {
            $sitemap->add("https://avisosmendoza.com.ar/servicio/" . $service->slug .'/referencia/'. $service->ref, $service->created_at, $priorityService);
        }

        $sitemap->store('xml', 'sitemap');
        return back();
    }
}
