<?php

namespace App\Http\Controllers\adminSite;

use App\Http\Controllers\Controller;
use App\Mail\statusServiceMail;
use App\Service;
use Illuminate\Support\Facades\Mail;

class ServiceController extends Controller
{
    public function serviceActive($id)
    {
        $service = Service::find($id);
        $service->status = 'Activo';
        $service->save();

        Mail::to($service->user->email)->send(new statusServiceMail($service));

        toast()->success('Servicio Activado');
        return back();
    }


    public function serviceDesactive($id)
    {
        $service = Service::find($id);
        $service->status = 'Desactivo';
        $service->save();

        toast()->success('Servicio Desactivado');
        return back();
    }

    public function serviceDelete($id)
    {
        $service = Service::find($id);
        $service->delete();

        toast()->success('Servicio eliminado');
        return back();
    }
}
