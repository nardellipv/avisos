<?php

namespace App\Http\Controllers\adminSite;

use App\Blog;
use App\Http\Controllers\Controller;
use App\Service;
use App\User;
use File;
use Illuminate\Support\Facades\App;
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

        $services = Service::orderBy('created_at', 'DESC')
            ->paginate(30);

        $servicePending = Service::where('status', 'PENDIENTE')
            ->get();

        return view('admin.indexAdminSite', compact(
            'userClientCount',
            'userAnunCount',
            'serviceActiveCount',
            'users',
            'services',
            'servicePending'
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
        $posts = Blog::orderBy('created_at', 'desc')->get();
        // listado de servicios
        foreach ($services as $service) {
            $sitemap->add("https://avisosmendoza.com.ar/servicio/" . $service->slug . '/referencia/' . $service->ref, $service->created_at);
        }

        // listado de post
        foreach ($posts as $post) {
            $sitemap->add("https://avisosmendoza.com.ar/blog/" . $post->slug, $service->created_at);
        }

        $sitemap->store('xml', 'sitemap', base_path('../public_html'));
        // $sitemap->store('xml', 'sitemap');
        return back();
    }
}
