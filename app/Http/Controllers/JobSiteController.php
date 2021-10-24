<?php

namespace App\Http\Controllers;

use App\Mail\MessageNotReadMail;
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
        $services = Service::get();

        foreach ($services as $service) {
            $name = User::where('id', $service->user_id)
                ->first();

            Mail::to($service->user->email)->send(new ResumeClientMail($service));
        }
    }
}
