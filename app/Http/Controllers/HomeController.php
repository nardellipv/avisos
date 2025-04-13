<?php

namespace App\Http\Controllers;

use App\Region;
use App\Service;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        SEOMeta::setTitle('Avisos Mendoza | Publicá Gratis tu Servicio en Mendoza ' . date('Y'));
        SEOMeta::setDescription('¿Ofrecés oficios o servicios en Mendoza? Subí tu aviso gratis y conseguí más clientes. Electricistas, plomeros, técnicos, limpieza y más rubros disponibles.');
        SEOMeta::addKeyword([
            'avisos clasificados Mendoza',
            'publicar servicio gratis Mendoza',
            'servicios Mendoza',
            'trabajos independientes Mendoza',
            'plomero Mendoza',
            'electricista Mendoza',
            'avisos gratis ' . date('Y'),
            'avisos online Mendoza'
        ]);
        SEOMeta::setCanonical(route('home'));
        SEOMeta::addMeta('robots', 'index, follow');

        OpenGraph::setTitle('Avisos Mendoza | Publicá Gratis tu Servicio y Conseguí Clientes');
        OpenGraph::setDescription('Promocioná tus servicios GRATIS en Mendoza. Llega a miles de personas que buscan oficios como el tuyo. Avisos fáciles, rápidos y efectivos.');
        OpenGraph::setUrl(route('home'));
        OpenGraph::setSiteName('Avisos Mendoza');
        OpenGraph::addImage(asset('styleWeb/assets/logo.png'));
        OpenGraph::addProperty('locale', 'es_AR');
        OpenGraph::addProperty('type', 'website');

        TwitterCard::setTitle('Publicá tu Servicio Gratis en Mendoza | Avisos Mendoza');
        TwitterCard::setDescription('Subí tu aviso gratis y conseguí más clientes. Ideal para oficios como plomería, electricidad, albañilería, limpieza y más.');
        TwitterCard::setImage(asset('styleWeb/assets/logo.png'));

        $services = Service::with(['region', 'category', 'user'])
            ->withCount('Comment')
            ->where('status', 'Activo')
            ->where('end_date', '>=', now())
            ->orderBy('updated_at', 'DESC')
            ->take(10)
            ->get();

        $serviceVisit = Service::where('status', 'Activo')
            ->orderBy('visit', 'DESC')
            ->first();

        $serviceLike = Service::where('status', 'Activo')
            ->orderBy('like', 'DESC')
            ->first();

        $servicesPublish = Service::with(['region', 'category', 'user'])
            ->withCount('Comment')
            ->where('status', 'Activo')
            ->where('publish', 'Destacado')
            ->where('end_date', '>=', now())
            ->orderBy('created_at', 'DESC')
            ->take(6)
            ->get();

        $locations = Cache::rememberForever('regionsCache', function () {
            return Region::get();
        });

        return view('web.index', compact('services', 'locations', 'servicesPublish', 'serviceVisit', 'serviceLike'));
    }
}
