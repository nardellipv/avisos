<?php

namespace App\Http\Controllers;

use App\Category;
use App\Region;
use App\Service;
use App\Subcategory;
use Artesaos\SEOTools\Facades\SEOMeta;

class CategoryController extends Controller
{
    public function index()
    {
        SEOMeta::setTitle('Listado Servicios');
        SEOMeta::setDescription('Listado completo de servicios ofrecidos en Mendoza');
        SEOMeta::setCanonical('https://avisosmendoza.com.ar/listado');

        SEOMeta::addKeyword([
            'Clasificados', 'Avisos Clasificados', 'Mendoza', 'Mendoza Trabajo', 'Mendoza Clasificados',
            'Avisos en Mendoza', 'Clasificados Los Andes', 'Clasificados diario uno', 'alquileres en mendoza',
            'clasificados mendoza', 'clasificados mendoza para caseros', 'clasificados alamaula mendoza',
            'clasificados mendoza empleos', 'avisos clasificados de mendoza', 'clasificados mendoza facebook',
            'clasificados de hoy mendoza', 'clasificados mendoza trabajo'
        ]);

        $categories = Category::get();

        $services = Service::with(['region', 'category', 'user'])
            ->withCount('Comment')
            ->where('status', 'Activo')
            ->where('end_date', '>=', now())
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        $serviceCount = Service::where('status', 'Activo')
            ->count();

        return view('web.categories.index', compact('categories', 'services', 'serviceCount'));
    }

    public function listCategory($slug)
    {
        $category = Category::where('slug', $slug)
            ->first();

        SEOMeta::setTitle('Listado Servicios - ' . $category->name);
        SEOMeta::setDescription('Listado completo de servicios ofrecidos en Mendoza');
        SEOMeta::setCanonical('https://avisosmendoza.com.ar/listado/' . $category->slug);

        SEOMeta::addKeyword([
            'Clasificados', 'Avisos Clasificados', 'Mendoza', 'Mendoza Trabajo', 'Mendoza Clasificados',
            'Avisos en Mendoza', 'Clasificados Los Andes', 'Clasificados diario uno', 'alquileres en mendoza',
            'clasificados mendoza', 'clasificados mendoza para caseros', 'clasificados alamaula mendoza',
            'clasificados mendoza empleos', 'avisos clasificados de mendoza', 'clasificados mendoza facebook',
            'clasificados de hoy mendoza', 'clasificados mendoza trabajo'
        ]);


        $categories = Category::get();

        $services = Service::with(['region', 'category', 'user'])
            ->withCount('Comment')
            ->where('status', 'Activo')
            ->where('category_id', $category->id)
            ->where('end_date', '>=', now())
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
        $category = Category::where('slug', $slug)
            ->first();

        SEOMeta::setTitle('Listado Servicios - ' . $category->name);
        SEOMeta::setDescription('Listado completo de servicios ofrecidos en Mendoza');
        SEOMeta::setCanonical('https://avisosmendoza.com.ar/listado/' . $category->slug);

        SEOMeta::addKeyword([
            'Clasificados', 'Avisos Clasificados', 'Mendoza', 'Mendoza Trabajo', 'Mendoza Clasificados',
            'Avisos en Mendoza', 'Clasificados Los Andes', 'Clasificados diario uno', 'alquileres en mendoza',
            'clasificados mendoza', 'clasificados mendoza para caseros', 'clasificados alamaula mendoza',
            'clasificados mendoza empleos', 'avisos clasificados de mendoza', 'clasificados mendoza facebook',
            'clasificados de hoy mendoza', 'clasificados mendoza trabajo'
        ]);


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
