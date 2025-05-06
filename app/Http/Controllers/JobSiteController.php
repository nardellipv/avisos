<?php

namespace App\Http\Controllers;

use App\Mail\highlightServiceMail;
use App\Mail\MessageNotReadMail;
use App\Mail\MissYouMail;
use App\Mail\RegisterUserMail;
use App\Mail\ResumeClientMail;
use App\Message;
use App\Service;
use App\User;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class JobSiteController extends Controller
{
    public function serviceEndDate()
    {
        $end_date = \Carbon\Carbon::parse(now()->addDay(10));

        $serviceEndDate = Service::with(['user'])
            ->where('end_date', $end_date->format('Y-m-d'))
            ->get();

        foreach ($serviceEndDate as $service) {
            Mail::send('emails.jobSite.serviceEndDateMail', ['service' => $service], function ($msj) use ($service) {
                $msj->from('no-responder@avisosmendoza.com.ar', 'Avisos Mendoza');
                $msj->subject('Servicio por vencer');
                $msj->to($service->user->email, $service->user->name);
            });
        }
    }

    public function serviceChangeStatus()
    {
        $serviceChangeStatus = Service::where('end_date', now()->format('Y-m-d'))
            ->where('status', 'Activo')
            ->get();

        foreach ($serviceChangeStatus as $service) {
            $service->status = 'Pausado';
            $service->save();

            Mail::send('emails.jobSite.serviceEndingMail', ['service' => $service], function ($msj) use ($service) {
                $msj->from('no-responder@avisosmendoza.com.ar', 'Avisos Mendoza');
                $msj->subject('Servicio vencido');
                $msj->to($service->user->email, $service->user->name);
            });
        }
    }

    public function completeProfile()
    {
        $services = Service::with(['user'])
            ->photo('NULL')
            ->phone('NULL')
            ->phoneWsp('N')
            ->get();

        foreach ($services as $service) {
            Mail::send('emails.jobSite.completeProfileServiceMail', ['service' => $service], function ($msj) use ($service) {
                $msj->from('no-responder@avisosmendoza.com.ar', 'Avisos Mendoza');
                $msj->subject('Completa tu Servicio');
                $msj->to($service->user->email, $service->user->name);
            });
        }
    }

    public function messageNotRead()
    {
        $messages = Message::where('read', 'N')
            ->get();

        foreach ($messages as $message) {
            $name = User::where('id', $message->user_id)
                ->first();

            Mail::to($message->user->email)->send(new MessageNotReadMail($name));
        }
    }

    public function resumeClient()
    {
        $services = Service::with(['user'])
            ->get();

        foreach ($services as $service) {
            $name = User::where('id', $service->user_id)
                ->first();

            Mail::to($service->user->email)->send(new ResumeClientMail($service));
        }
    }

    public function registerUser()
    {
        $users = User::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->orderBy('created_at', 'DESC')
            ->get();

        Mail::to('info@avisosmendoza.com.ar')->send(new RegisterUserMail($users));
    }

    public function highlightService()
    {
        $users = User::get();

        $servicesPromotion = Service::where('publish', 'Destacado')
            ->where('sendPromotion', '0')
            ->where('status', 'Activo')
            ->take(2)
            ->get();

        if (!$servicesPromotion->isEmpty()) {
            $services = $servicesPromotion;
        } else {
            $services = Service::where('sendPromotion', '0')
                ->where('status', 'Activo')
                ->take(2)
                ->get();
        }

        foreach ($services as $service) {
            $service->sendPromotion = 1;
            $service->save();
        }

        if (!$services->isEmpty()) {
            foreach ($users as $user) {
                Mail::send('emails.jobSite.highlightServiceMail', ['services' => $services, 'user' => $user], function ($msj) use ($services, $user) {
                    $msj->from('no-responder@avisosmendoza.com.ar', 'Avisos Mendoza');
                    $msj->subject('Destacados del Mes');
                    $msj->to($user->email, $user->name);
                });
            }
        }
    }

    public function missYou()
    {
        $users = User::where('lastLogin', '<=', Date::parse('-30days'))
            ->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new MissYouMail($user));
        }
    }

    public function publishIG()
    {
        // --- 1. Obtener Credenciales y Configuración ---
        $accessToken = config('services.instagram.token');
        $igUserId = config('services.instagram.user_id');
        $apiVersion = 'v19.0';
        $baseUrl = "https://graph.facebook.com/{$apiVersion}";
        $appUrl = rtrim(config('app.url'), '/');

        // --- 2. Seleccionar UN Servicio al Azar ---
        $service = Service::with(['user', 'category']) // Eager load user y category
                           ->where('status', 'Activo')
                           ->whereNotNull('photo')
                           ->where('photo', '!=', '')
                           ->inRandomOrder()
                           ->first();
        
        // --- 3. Preparar datos para el Contenedor de Imagen Única ---
        $filename = $service->photo;
        $encodedFilename = rawurlencode($filename);
        $imageUrl = $appUrl . '/users/' . $service->user->id . '/service/' . $encodedFilename;
        
        // --- Construcción del Caption Modificada ---
        $caption = $service->title; // Título del servicio
        $caption .= "\n\n" . strip_tags($service->description); // Descripción del servicio (quitando etiquetas HTML)
        
        $categoryName = $service->category ? str_replace(' ', '', $service->category->name) : 'Servicio';
        $caption .= "\n\nEncuentra más en avisosmendoza.com.ar\n#AvisosMendoza #" . $categoryName;
        // --- Fin Construcción del Caption ---

        // Crear Contenedor
        $responseCreate = Http::asForm()->post("{$baseUrl}/{$igUserId}/media", [
            'image_url' => $imageUrl,
            'caption' => $caption, // Aquí se usa el caption modificado
            'access_token' => $accessToken,
        ]);

        // Esta comprobación es importante para asegurar que tenemos un ID de contenedor
        if (!$responseCreate->successful() || !isset($responseCreate->json()['id'])) {
            $apiErrorMsg = $responseCreate->json()['error']['error_user_msg'] ?? ('Error al crear contenedor. Status: ' . $responseCreate->status());
            return back()->with('error', "Instagram API (Crear Contenedor): " . $apiErrorMsg);
        }
        $imageContainerId = $responseCreate->json()['id'];

        // --- 4. Publicar Contenedor de Imagen ---
        $responsePublish = Http::asForm()->post("{$baseUrl}/{$igUserId}/media_publish", [
            'creation_id' => $imageContainerId,
            'access_token' => $accessToken,
        ]);
    }
}
