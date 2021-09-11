<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Region;
use App\Service;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class HomeController extends Controller
{
    public function index()
    {
        SEOMeta::setTitle('Avisos Mendoza ' . date('Y'));
        SEOMeta::setDescription('Llegá a más mendocinos publicando tu servicio clasificados totalmente gratis');

        SEOMeta::addKeyword([
            'Clasificados', 'Avisos Clasificados', 'Mendoza', 'Mendoza Trabajo', 'Mendoza Clasificados',
            'Avisos en Mendoza', 'Clasificados Los Andes', 'Clasificados diario uno', 'alquileres en mendoza',
            'clasificados mendoza', 'clasificados mendoza para caseros', 'clasificados alamaula mendoza',
            'clasificados mendoza empleos','avisos clasificados de mendoza','clasificados mendoza facebook',
            'clasificados de hoy mendoza','clasificados mendoza trabajo'
        ]);
        
        OpenGraph::setDescription('Llegá a más mendocinos publicando tu servicio totalmente gratis');
        OpenGraph::setTitle('Avisos Mendoza');
        OpenGraph::setUrl('https://avisosmendoza.com.ar');
        OpenGraph::addImage(['url' => 'https://avisosmendoza.com.ar/styleWeb/assets/logo.png']);
        OpenGraph::addImage(['url' => 'https://avisosmendoza.com.ar/styleWeb/assets/logo.png', 'size' => 300]);
        OpenGraph::addProperty('type', 'articles');

        $services = Service::with(['region', 'category', 'user'])
            ->withCount('Comment')
            ->where('status', 'Activo')
            ->where('end_date', '>=', now())
            ->orderBy('created_at', 'DESC')            
            ->take(6)
            ->get();

        $locations = Region::get();

        return view('web.index', compact('services', 'locations'));
    }
}
