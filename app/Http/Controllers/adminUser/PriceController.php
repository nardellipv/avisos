<?php

namespace App\Http\Controllers\adminUser;

use App\Http\Controllers\Controller;
use App\Mail\NewSponsorInformationMail;
use App\Mail\PaymentMail;
use Illuminate\Support\Facades\Mail;
use App\Service;
use App\tempSponsor;
use Artesaos\SEOTools\Facades\SEOMeta;

class PriceController extends Controller
{

    public function highlightInfo()
    {
        $serviceSponsor = Service::with(['category', 'region', 'user'])
            ->where('user_id', userConnect()->id)
            ->where('status', '!=', 'Desactivo')
            ->where('status', '!=', 'Pendiente')
            ->get();

        return view('web.adminUser.price.listPrice', compact('serviceSponsor'));
    }

    public function highlightService($id)
    {
        SEOMeta::setTitle('Avisos Mendoza | Destacar Servicio');
        SEOMeta::setDescription('Llegá a más mendocinos publicando tu servicio en Avisos Mendoza totalmente gratis y en un instante.');

        $service = Service::find($id);

        $this->authorize('ownerService', $service);

        tempSponsor::create([
            'service_id' => $service->id,
            'pay' => 'N',
        ]);

        // mail al cliente
        Mail::to($service->user->email)->send(new PaymentMail($service));

        //   mail a mi
        Mail::to('info@avisosmendoza.com.ar')->send(new NewSponsorInformationMail($service));

        return view('web.adminUser.parts._pendingSponsor', compact('service'));
    }
}
