<?php

namespace App\Http\Controllers;

use App\Region;
use App\Service;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        SEOMeta::setTitle('Avisos Clasificados Mendoza ' . date('Y'));
        SEOMeta::setDescription('Llegá a más mendocinos publicando tu servicio en Avisos Mendoza totalmente gratis y en un instante.');

        SEOMeta::addKeyword([
            'Mendoza Trabajo', 'Mendoza Clasificados', 'Clasificados Los Andes', 'Clasificados diario uno', 
            'avisos clasificados de mendoza', 'Clasificados Mendoza alquileres'
        ]);

        OpenGraph::setDescription('Llegá a más mendocinos publicando tu servicio totalmente gratis');
        OpenGraph::setTitle('Avisos Mendoza');
        OpenGraph::setUrl('https://avisosmendoza.com.ar');
        OpenGraph::setSiteName('Avisos Mendoza');
        OpenGraph::addImage(['url' => 'https://avisosmendoza.com.ar/styleWeb/assets/logoFace.png']);
        OpenGraph::addProperty('locale', 'es_AR');
        // OpenGraph::addImage(['url' => 'https://avisosmendoza.com.ar/styleWeb/assets/logo.png', 'size' => 300]);
        OpenGraph::addProperty('type', 'articles');

        $services = Service::with(['region', 'category', 'user'])
            ->withCount('Comment')
            ->where('status', 'Activo')
            ->where('end_date', '>=', now())
            ->orderBy('created_at', 'DESC')
            ->take(6)
            ->get();


        $servicesPublish = Service::with(['region', 'category', 'user'])
            ->withCount('Comment')
            ->where('status', 'Activo')
            ->where('publish', 'Destacado')
            ->where('end_date', '>=', now())
            ->orderBy('created_at', 'DESC')
            ->take(6)
            ->get();

        //cacheo location forever
        if (Cache::has('regionsCache')) {
            $locations = Cache::get('regionsCache');
        } else {
            $locations = Region::get();

            Cache::forever('regionsCache', $locations);
        }

        return view('web.index', compact('services', 'locations', 'servicesPublish'));
    }
}
