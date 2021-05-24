<?php

namespace App\Http\Controllers;

use App\Category;
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

        $categories = Category::get();

        $services = Service::with(['region', 'category', 'user'])
            ->withCount('Comment')
            ->where('status', 'Activo')
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

        $categories = Category::get();

        $services = Service::with(['region', 'category', 'user'])
            ->withCount('Comment')
            ->where('status', 'Activo')
            ->where('category_id', $category->id)
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

        $categories = Category::get();

        $services = Service::with(['region', 'category', 'user'])
            ->withCount('Comment')
            ->where('status', 'Activo')
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
