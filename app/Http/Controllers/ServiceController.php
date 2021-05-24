<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Service;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\SEOTools;

class ServiceController extends Controller
{
    public function service($slug, $ref)
    {
        $service = Service::where('slug', $slug)
            ->where('ref', $ref)
            ->where('status', 'Activo')
            ->first();

        // SEO
        SEOMeta::setTitle($service->title);
        SEOMeta::setDescription(Str::limit($service->description, 150));
        SEOMeta::setCanonical('https://avisosmendoza.com.ar/listado');
        SEOMeta::addMeta('Servicio Creado', $service->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('Categoría', $service->category->name, 'property');

        OpenGraph::setUrl('htts://avisosmendoza.com.ar/servicio/'. $service->slug .'/referencia/'. $service->ref);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::setTitle($service->title);
        OpenGraph::setSiteName('Avisos Mendoza');
        OpenGraph::setDescription(Str::limit($service->description, 150));
        OpenGraph::addImage('http://avisosmendoza.test/users/'. $service->user_id .'/service/'.$service->photo, ['height' => 300, 'width' => 300]);


        //cookie si ya lo visito
        $visit = Cookie::queue('service' . $service->id, '1');

        if (Cookie::get('service' . $service->id) != 1) {
            Service::where('id', $service->id)->increment('visit');
        }

        $feedbackCount = Comment::where('service_id', $service->id)
            ->count();

        $comments = Comment::with(['user'])
            ->where('comments.service_id', $service->id)
            ->get();

        return view('web.services.service', compact('service', 'feedbackCount', 'comments'));
    }

    public function vote($id)
    {
        Service::find($id);

        //cookie si ya voto
        Cookie::queue('vote' . $id, '1');

        if (Cookie::get('vote' . $id) == 1) {
            toastr()->warning('Ya votaste este servicio');
            return back();
        }

        Service::find($id)->increment('like');

        toastr()->success('Gracias por Votar');
        return back();
    }
}
