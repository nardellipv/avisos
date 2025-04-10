<?php

namespace App\Http\Controllers\AdminUser;

use App\Http\Controllers\Controller;
use App\Mail\NewSponsorInformationMail;
use App\Mail\PaymentMail;
use Illuminate\Support\Facades\Mail;
use App\Service;
use App\tempSponsor;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Storage;

class PriceController extends Controller
{

    public function highlightInfo()
    {
        SEOMeta::setTitle('Avisos Mendoza | Listado de Servicios');

        $serviceSponsor = Service::with(['category', 'region', 'user'])
            ->where('user_id', userConnect()->id)
            ->where('status', '!=', 'Desactivo')
            ->where('status', '!=', 'Pendiente')
            ->get();

        $sponsorDays = Storage::disk('public')->get('daySponsor.txt');

        return view('web.adminUser.price.listPrice', compact('serviceSponsor','sponsorDays'));
    }

    public function highlightService($id)
    {
        SEOMeta::setTitle('Avisos Mendoza | Destacar Servicio');

        $service = Service::find($id);

        $this->authorize('ownerService', $service);

        tempSponsor::Create([
            'service_id' => $service->id,
            'pay' => 'N',
        ]);

        $days = Storage::disk('public')->get('daySponsor.txt');

        // mail al cliente
        Mail::to($service->user->email)->send(new PaymentMail($service, $days));

        //   mail a mi
        Mail::to('info@avisosmendoza.com.ar')->send(new NewSponsorInformationMail($service));

        return view('web.adminUser.parts._pendingSponsor', compact('service'));
    }
}
