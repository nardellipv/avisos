<?php

namespace App\Http\Controllers;

use App\Region;
use App\Service;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class HomeController extends Controller
{
    public function index()
    {
        SEOMeta::setDescription('Llegá a más mendocinos publicando tu servicio clasificados totalmente gratis');

        OpenGraph::setDescription('Llegá a más mendocinos publicando tu servicio totalmente gratis');
        OpenGraph::setTitle('Avisos Mendoza');
        OpenGraph::setUrl('https://avisosmendoza.com.ar');
        SEOMeta::addKeyword([
            'Clasificados', 'Avisos Clasificados', 'Mendoza', 'Mendoza Trabajo', 'Mendoza Clasificados',
            'Avisos en Mendoza', 'Clasificados Los Andes', 'Clasificados diario uno', 'alquileres en mendoza'
        ]);
        OpenGraph::addProperty('type', 'articles');

        $services = Service::with(['region', 'category', 'user'])
            ->withCount('Comment')
            ->where('status', 'Activo')
            ->orderBy('created_at', 'DESC')
            ->take(6)
            ->get();

        $locations = Region::get();

        return view('web.index', compact('services', 'locations'));
    }
}
