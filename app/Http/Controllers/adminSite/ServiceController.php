<?php

namespace App\Http\Controllers\adminSite;

use App\Http\Controllers\Controller;
use App\Mail\ActiveServiceSponsorMail;
use App\Mail\RejectServiceMail;
use App\Mail\RepublishServiceMail;
use App\Mail\statusServiceMail;
use App\Service;
use App\TempSponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Jambasangsang\Flash\Facades\LaravelFlash;
use App\Subcategory;
use App\Image as AppImage;

class ServiceController extends Controller
{

    public $publicDays;
    public $sponsorDays;

    public function __construct()
    {
        $this->publicDays = Storage::disk('public')->get('dayPublic.txt');
        $this->sponsorDays = Storage::disk('public')->get('daySponsor.txt');
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
            $service->end_date = now()->addDays((int)$this->publicDays);
            $service->save();

            Mail::to($service->user->email)->send(new statusServiceMail($service));
        }

        LaravelFlash::withInfo('Servicio Activado');
        return back();
    }

    public function serviceSponsorActive(Request $request, $id)
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
            $service->publish = 'Destacado';
            $service->end_date = now()->addDays($this->sponsorDays);
            $service->save();

            $serviceTemp = TempSponsor::where('service_id', $id)
                ->first();
            $serviceTemp->pay = 'Y';
            $serviceTemp->save();

            Mail::to($service->user->email)->send(new ActiveServiceSponsorMail($service));
        }

        LaravelFlash::withInfo('Servicio Activado');
        return back();
    }

    public function serviceReactivate()
    {
        $pausedServices = Service::where('status', 'Pausado')
            ->get();

        foreach ($pausedServices as $pausedService) {
            $pausedService->status = 'Activo';
            $pausedService->end_date = now()->addDays((int)$this->publicDays);
            $pausedService->save();

            Mail::to($pausedService->user->email)->send(new RepublishServiceMail($pausedService));
        }

        LaravelFlash::withInfo('Servicios Reactivados');
        return back();
    }

    public function serviceEdit($id)
    {
        $service = Service::find($id);

        $images = AppImage::where('service_id', $service->id)
            ->get();

        $subCategory = Subcategory::where('id', $service->subcategory_id)
            ->first();

        return view('admin.services.editService', compact('service', 'images','subCategory'));
    }

    public function serviceUpdate(Request $request, $id)
    {
        $service = Service::find($id);

        $service->title = $request['title'];
        $service->phone = $request['phone'];
        $service->description = $request['description'];
        $service->publish = $request['publish'];
        $service->visit = $request['visit'];
        $service->like = $request['like'];
        $service->save();

        LaravelFlash::withInfo('Servicio Editado');
        return back();
    }

    public function serviceDesactive($id)
    {
        $service = Service::find($id);
        $service->status = 'Desactivo';
        $service->save();

        LaravelFlash::withInfo('Servicio Desactivado');
        return back();
    }

    public function serviceDelete($id)
    {
        $service = Service::find($id);
        $service->delete();

        LaravelFlash::withInfo('Servicio eliminado');
        return back();
    }
}
