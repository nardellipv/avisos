<?php

namespace App\Http\Controllers\adminSite;

use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function serviceActive($id)
    {
        $service = Service::find($id);
        $service->status = 'Activo';
        $service->save();

        toastr()->success('Servicio Activado');
        return back();
    }


    public function serviceDesactive($id)
    {
        $service = Service::find($id);
        $service->status = 'Desactivo';
        $service->save();

        toastr()->success('Servicio Desactivado');
        return back();
    }

    public function serviceDelete($id)
    {
        $service = Service::find($id);
        $service->delete();

        toastr()->success('Servicio eliminado');
        return back();
    }
}
