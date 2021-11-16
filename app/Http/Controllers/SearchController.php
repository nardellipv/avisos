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
        $services = Service::with(['region', 'category', 'user'])
            ->withCount('Comment')
            ->where('status', 'Activo')
            ->where('end_date', '>=', now())
            ->regions($request->location)
            ->service($request->service)
            ->get();

        SEOMeta::setTitle('Listado Servicios - ' . $request->service);
        SEOMeta::setDescription('Listado completo de servicios ofrecidos en Mendoza');

        SEOMeta::addKeyword([
            'Clasificados', 'Avisos Clasificados', 'Mendoza', 'Mendoza Trabajo', 'Mendoza Clasificados',
            'Avisos en Mendoza', 'Clasificados Los Andes', 'Clasificados diario uno', 'alquileres en mendoza',
            'clasificados mendoza', 'clasificados mendoza para caseros', 'clasificados alamaula mendoza',
            'clasificados mendoza empleos', 'avisos clasificados de mendoza', 'clasificados mendoza facebook',
            'clasificados de hoy mendoza', 'clasificados mendoza trabajo'
        ]);

        return view('web.search.search', compact('services'));
    }

    public function listLocation($slug)
    {
        $region = Region::where('slug', $slug)
            ->first();

        SEOMeta::setTitle('Listado Servicios - ' . $region->name);
        SEOMeta::setDescription('Listado completo de servicios ofrecidos en Mendoza');
        SEOMeta::setCanonical('https://avisosmendoza.com.ar/listado/localidad/' . $region->slug);

        SEOMeta::addKeyword([
            'Clasificados', 'Avisos Clasificados', 'Mendoza', 'Mendoza Trabajo', 'Mendoza Clasificados',
            'Avisos en Mendoza', 'Clasificados Los Andes', 'Clasificados diario uno', 'alquileres en mendoza',
            'clasificados mendoza', 'clasificados mendoza para caseros', 'clasificados alamaula mendoza',
            'clasificados mendoza empleos', 'avisos clasificados de mendoza', 'clasificados mendoza facebook',
            'clasificados de hoy mendoza', 'clasificados mendoza trabajo'
        ]);

        $services = Service::with(['region', 'category', 'user'])
            ->withCount('Comment')
            ->where('status', 'Activo')
            ->where('end_date', '>=', now())
            ->where('region_id', $region->id)
            ->get();

        return view('web.search.search', compact('services'));
    }
}
