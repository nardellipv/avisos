<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Image;
use App\Mail\ActiveServiceSponsorMail;
use App\Service;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\statusServiceMail;
use App\User;
use Illuminate\Support\Facades\Storage;
use Jambasangsang\Flash\Facades\LaravelFlash;

class ServiceController extends Controller
{
    public $sponsorDays;
    public $publicDays;

    public function __construct()
    {
        $this->publicDays = Storage::disk('public')->get('dayPublic.txt');
        $this->sponsorDays = Storage::disk('public')->get('daySponsor.txt');
    }

    public function service($slug, $ref)
    {
        $service = Service::where('slug', $slug)
            ->where('ref', $ref)
            ->where('status', 'Activo')
            ->first();

        if (!$service) {
            return redirect()->action('ServiceController@desactiveService');
        }

        $title = "{$service->title} | {$service->category->name} en {$service->region->name} - Avisos Mendoza";
        $description = Str::limit(strip_tags($service->description), 160);

        // SEO META
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setCanonical(route('service', [$service->slug, $service->ref]));
        SEOMeta::addMeta('article:published_time', $service->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:section', $service->category->name, 'property');
        SEOMeta::addMeta('robots', 'index, follow');

        SEOMeta::addKeyword([
            $service->title,
            "{$service->category->name} Mendoza",
            "servicios en {$service->region->name}",
            'avisos clasificados Mendoza',
            'publicar servicio Mendoza',
            'trabajos independientes'
        ]);

        // OG
        OpenGraph::setUrl(route('service', [$service->slug, $service->ref]));
        OpenGraph::setType('article');
        OpenGraph::setTitle($title);
        OpenGraph::setSiteName('Avisos Mendoza');
        OpenGraph::setDescription($description);

        if ($service->photo) {
            OpenGraph::addImage(asset('users/' . $service->user_id . '/service/' . $service->photo), ['height' => 300, 'width' => 300]);
        }

        $images = Image::where('service_id', $service->id)->get();

        // Cookie + visitas
        if (!Cookie::get('service' . $service->id)) {
            Cookie::queue('service' . $service->id, '1', 60 * 24); // 1 día
            $service->increment('visit');
        }

        $feedbackCount = Comment::where('service_id', $service->id)->count();

        $comments = Comment::with(['user'])
            ->where('comments.service_id', $service->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        $services = Service::with(['region', 'user'])
            ->where('status', 'Activo')
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
            LaravelFlash::withWarning('Ya votaste este servicio');
            return back();
        }

        Service::find($id)->increment('like');

        LaravelFlash::withInfo('Gracias por Votar');
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
        $service->end_date = now()->addDays((int)$this->publicDays);
        $service->save();

        Mail::to($service->user->email)->send(new statusServiceMail($service));
    }

    public function serviceActiveEmailSponsor($id, $ref)
    {
        $service = Service::where('id', $id)
            ->where('ref', $ref)
            ->first();

        $service->status = 'Activo';
        $service->end_date = now()->addDays($this->sponsorDays);
        $service->publish = 'Destacado';
        $service->save();

        Mail::to($service->user->email)->send(new ActiveServiceSponsorMail($service));
    }

    public function desactiveService()
    {
        $services = Service::with(['region', 'category', 'user'])
            ->withCount('Comment')
            ->where('status', 'Activo')
            ->where('end_date', '>=', now())
            ->orderBy('publish', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('web.services.desactiveSevice', compact('services'));
    }

    public function getPhone(Service $service, $ref)
    {
        if ($service->ref !== $ref || $service->status !== 'Activo') {
            return response()->json(['error' => 'Servicio no encontrado o inactivo.'], 404);
        }

        return response()->json([
            'phone' => $service->phone,
            'phoneWsp' => (bool) $service->phoneWsp 
        ]);
    }

}
