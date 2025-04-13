<?php

namespace App\Http\Controllers;

use App\Category;
use App\Region;
use App\Service;
use App\Subcategory;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class CategoryController extends Controller
{
    public function index()
    {
        SEOMeta::setTitle('Oficios y servicios en Mendoza | Buscá o publicá gratis');
        SEOMeta::setDescription('Buscá servicios por categoría: plomería, electricidad, mantenimiento, limpieza, fletes, técnicos y más en toda Mendoza.');
        SEOMeta::setCanonical(route('category.index'));
        SEOMeta::addMeta('robots', 'index, follow');

        OpenGraph::setTitle('Servicios clasificados por categoría en Mendoza');
        OpenGraph::setDescription('Explorá las categorías más buscadas y encontrá el servicio que necesitás en Mendoza. Avisos gratuitos y actualizados.');
        OpenGraph::setUrl(route('category.index'));
        OpenGraph::addImage(['url' => asset('styleWeb/assets/logo.png')]);
        OpenGraph::addProperty('locale', 'es_AR');
        OpenGraph::addProperty('type', 'website');

        $categories = Category::get();

        $services = Service::with(['region', 'category', 'user'])
            ->withCount('Comment')
            ->where('status', 'Activo')
            ->where('end_date', '>=', now())
            ->orderBy('publish', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        $serviceCount = Service::where('status', 'Activo')->count();

        return view('web.categories.index', compact('categories', 'services', 'serviceCount'));
    }

    public function listCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        SEOMeta::setTitle("{$category->name} en Mendoza | Servicios y Profesionales");
        SEOMeta::setDescription("Publicá o contratá servicios de {$category->name} en Mendoza. Ofrecé tu oficio o encontrá a quien necesitás sin intermediarios.");
        SEOMeta::setCanonical(request()->url());
        SEOMeta::addMeta('robots', 'index, follow');
        SEOMeta::addKeyword([
            'servicios Mendoza', 'oficios Mendoza', "publicar {$category->name} Mendoza", 
            "contratar {$category->name} Mendoza", 'trabajos independientes en Mendoza'
        ]);

        OpenGraph::setTitle("Servicios de {$category->name} en Mendoza");
        OpenGraph::setDescription("Accedé a una lista actualizada de personas que ofrecen {$category->name} en Mendoza. Publicá el tuyo gratis.");
        OpenGraph::setUrl(request()->url());
        OpenGraph::addImage(['url' => asset('styleWeb/assets/logo.png')]);
        OpenGraph::addProperty('locale', 'es_AR');
        OpenGraph::addProperty('type', 'website');

        $categories = Category::get();

        $services = Service::with(['region', 'category', 'user'])
            ->withCount('Comment')
            ->where('status', 'Activo')
            ->where('category_id', $category->id)
            ->where('end_date', '>=', now())
            ->orderBy('publish', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        $serviceCount = Service::where('category_id', $category->id)
            ->where('status', 'Activo')
            ->count();

        $subcategories = Subcategory::where('category_id', $category->id)
            ->withCount('service')
            ->get();

        return view('web.categories.index', compact('categories', 'services', 'serviceCount', 'category', 'subcategories'));
    }

    public function listSubCategory($slug, $id)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $subcategory = Subcategory::findOrFail($id);

        SEOMeta::setTitle("{$subcategory->name} en Mendoza | Servicios específicos");
        SEOMeta::setDescription("Listado actualizado de servicios de {$subcategory->name} en Mendoza. Publicá el tuyo o encontrá a quien necesitás.");
        SEOMeta::setCanonical(request()->url());
        SEOMeta::addMeta('robots', 'index, follow');
        SEOMeta::addKeyword([
            "servicio {$subcategory->name} Mendoza", "{$category->name} Mendoza", 
            "{$subcategory->name} económico Mendoza", 'clasificados de servicios Mendoza'
        ]);

        OpenGraph::setTitle("Oficios de {$subcategory->name} en Mendoza");
        OpenGraph::setDescription("Ofrecé o contratá servicios de {$subcategory->name} en toda Mendoza. Visibilidad gratuita y efectiva.");
        OpenGraph::setUrl(request()->url());
        OpenGraph::addImage(['url' => asset('styleWeb/assets/logo.png')]);
        OpenGraph::addProperty('locale', 'es_AR');
        OpenGraph::addProperty('type', 'website');

        $categories = Category::get();

        $services = Service::with(['region', 'category', 'user'])
            ->withCount('Comment')
            ->where('status', 'Activo')
            ->where('end_date', '>=', now())
            ->where('subcategory_id', $id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        $serviceCount = Service::where('category_id', $category->id)
            ->where('status', 'Activo')
            ->count();

        $subcategories = Subcategory::where('category_id', $category->id)
            ->withCount('service')
            ->get();

        return view('web.categories.index', compact('categories', 'services', 'serviceCount', 'category', 'subcategories'));
    }
}
