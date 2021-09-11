<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;

class JobSiteController extends Controller
{
    public function serviceEndDate()
    {

        $serviceEndDate = Service::with(['user'])
            ->where('end_date', '<=', \Carbon\Carbon::parse(now()->addDay(10)))
            ->get();

        foreach ($serviceEndDate as $service) {
            Mail::send('emails.jobSite.serviceEndDateMail', ['service' => $service], function ($msj) use ($service) {
                $msj->from('no-responder@avisosmendoza.com.ar', 'Avisos Mendoza');
                $msj->subject('Servicio por vencer');
                $msj->to($service->user->email, $service->user->name);
            });
        }
    }
}
