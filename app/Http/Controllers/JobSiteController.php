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
}
