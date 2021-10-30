<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Image;
use App\Service;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\statusServiceMail;

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
        SEOMeta::addKeyword([
            'Clasificados', 'Avisos Clasificados', 'Mendoza', 'Mendoza Trabajo', 'Mendoza Clasificados',
            'Avisos en Mendoza', 'Clasificados Los Andes', 'Clasificados diario uno', 'alquileres en mendoza',
            'clasificados mendoza', 'clasificados mendoza para caseros', 'clasificados alamaula mendoza',
            'clasificados mendoza empleos', 'avisos clasificados de mendoza', 'clasificados mendoza facebook',
            'clasificados de hoy mendoza', 'clasificados mendoza trabajo'
        ]);

        OpenGraph::setUrl('htts://avisosmendoza.com.ar/servicio/' . $service->slug . '/referencia/' . $service->ref);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::setTitle($service->title);
        OpenGraph::setSiteName('Avisos Mendoza');
        OpenGraph::setDescription(Str::limit($service->description, 150));
        OpenGraph::addImage('https://avisosmendoza.com.ar/users/' . $service->user_id . '/service/' . $service->photo, ['height' => 300, 'width' => 300]);


        $images = Image::where('service_id', $service->id)
            ->get();

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

        $services = Service::with(['region','user'])
            ->take(3)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('web.services.service', compact('service', 'feedbackCount', 'comments', 'images', 'services'));
    }

    public function vote($id)
    {
        Service::find($id);

        //cookie si ya voto
        Cookie::queue('vote' . $id, '1');

        if (Cookie::get('vote' . $id) == 1) {
            toast()->warning('Ya votaste este servicio');
            return back();
        }

        Service::find($id)->increment('like');

        toast()->success('Gracias por Votar');
        return back();
    }

    public function servicePending($slug, $ref)
    {
        $service = Service::where('slug', $slug)
            ->where('ref', $ref)
            ->first();

        $images = Image::where('service_id', $service->id)
            ->get();

        $feedbackCount = Comment::where('service_id', $service->id)
            ->count();

        $comments = Comment::with(['user'])
            ->where('comments.service_id', $service->id)
            ->get();

        return view('web.services.service', compact('service', 'feedbackCount', 'comments', 'images'));
    }

    public function serviceActiveEmail($id, $ref)
    {
        $service = Service::where('id', $id)
            ->where('ref', $ref)
            ->first();

        $service->status = 'Activo';
        $service->save();

        Mail::to($service->user->email)->send(new statusServiceMail($service));
    }
}
