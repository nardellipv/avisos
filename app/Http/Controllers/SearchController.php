<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Region;
use App\Service;
use Artesaos\SEOTools\Facades\SEOMeta;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->service ?? 'Servicios';
        $location = $request->location ?? 'Mendoza';

        $services = Service::with(['region', 'category', 'user'])
            ->withCount('Comment')
            ->where('status', 'Activo')
            ->where('end_date', '>=', now())
            ->regions($request->location)
            ->service($request->service)
            ->get();

        SEOMeta::setTitle("Buscá $keyword en $location | Servicios y Oficios - Avisos Mendoza");
        SEOMeta::setDescription("Encontrá profesionales y oficios como $keyword en $location. Publicá o buscá gratis en nuestra plataforma de clasificados mendocinos.");
        SEOMeta::setCanonical(route('search') . '?service=' . urlencode($keyword) . '&location=' . urlencode($location));
        SEOMeta::addMeta('robots', 'index, follow');

        SEOMeta::addKeyword([
            'avisos clasificados Mendoza',
            'servicios en Mendoza',
            "buscar $keyword en $location",
            'oficios Mendoza',
            'publicar servicio gratis',
            'trabajo independiente Mendoza'
        ]);

        return view('web.search.search', compact('services'));
    }

    public function listLocation($slug)
    {
        $region = Region::where('slug', $slug)->firstOrFail();

        $services = Service::with(['region', 'category', 'user'])
            ->withCount('Comment')
            ->where('status', 'Activo')
            ->where('end_date', '>=', now())
            ->where('region_id', $region->id)
            ->get();

        SEOMeta::setTitle("Servicios en {$region->name} | Oficios en Mendoza - Avisos Clasificados");
        SEOMeta::setDescription("Explorá todos los servicios disponibles en {$region->name}, Mendoza. Encontrá plomeros, electricistas, técnicos, y más cerca tuyo.");
        SEOMeta::setCanonical(route('list.location', $region->slug));
        SEOMeta::addMeta('robots', 'index, follow');

        SEOMeta::addKeyword([
            'clasificados en ' . $region->name,
            'servicios en ' . $region->name,
            'oficios ' . $region->name,
            'trabajo independiente Mendoza',
            'avisos Mendoza gratis',
            'publicar servicio gratis Mendoza'
        ]);

        return view('web.search.search', compact('services'));
    }
}
