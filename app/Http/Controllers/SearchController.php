<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Service;

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


        return view('web.search.search', compact('services'));
    }
}
