<?php

namespace App\Http\Controllers\adminSite;

use App\Http\Controllers\Controller;
use App\Mail\RejectServiceMail;
use App\Mail\RepublishServiceMail;
use App\Mail\statusServiceMail;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{

    public $publicDays;

    public function __construct()
    {
        $this->publicDays = Storage::disk('public')->get('dayPublic.txt');
    }

    public function serviceList()
    {

        $services = Service::with(['user'])
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('admin.services.listService', compact('services'));
    }

    public function serviceActive(Request $request, $id)
    {
        $motive = $request->motive;
        if ($request->motive) {
            $service = Service::find($id);
            $service->status = 'Desactivo';
            $service->save();

            Mail::to($service->user->email)->send(new RejectServiceMail($service, $motive));
        } else {
            $service = Service::find($id);
            $service->status = 'Activo';
            $service->end_date = now()->addDays($this->publicDays);
            $service->save();

            Mail::to($service->user->email)->send(new statusServiceMail($service));
        }

        toast()->success('Servicio Activado');
        return back();
    }

    public function serviceReactivate()
    {
        $pausedServices = Service::where('status', 'Pausado')
            ->get();

        foreach ($pausedServices as $pausedService) {
            $pausedService->status = 'Activo';
            $pausedService->end_date = now()->addDays($this->publicDays);
            $pausedService->save();

            Mail::to($pausedService->user->email)->send(new RepublishServiceMail($pausedService));
        }

        toast()->success('Servicios Reactivados');
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
