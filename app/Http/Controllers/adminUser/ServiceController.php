<?php

namespace App\Http\Controllers\AdminUser;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Image as AppImage;
use App\Mail\EditServiceMail;
use App\Mail\PublishServiceMail;
use App\Mail\RepublishServiceMail;
use File;
use Image;
use App\Service;
use App\Subcategory;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class ServiceController extends Controller
{

    public function listServices()
    {
        SEOMeta::setTitle('Avisos Mendoza | Servicios');
        SEOMeta::setDescription('Llegá a más mendocinos publicando tu servicio en Avisos Mendoza totalmente gratis y en un instante.');

        OpenGraph::setDescription('Llegá a más mendocinos publicando tu servicio en Avisos Mendoza totalmente gratis y en un instante.');
        OpenGraph::setTitle('Avisos Mendoza');

        $services = Service::with(['category', 'region', 'user'])
            ->where('user_id', userConnect()->id)
            ->where('status','!=', 'Desactivo')
            ->where('status','!=', 'Pendiente')
            ->get();

        if ($services->isEmpty()) {
            $categories = Category::all();
            toast()->info('Crea tu primer servicio');
            return redirect()->action('adminUser\ServiceController@createService');
        }

        return view('web.adminUser.serviceAnun.listService', compact('services'));
    }

    public function pendingService()
    {
        $services = Service::with(['category', 'region', 'user'])
            ->where('user_id', userConnect()->id)
            ->where('status', 'Pendiente')
            ->get();

        if ($services->isEmpty()) {
            $categories = Category::all();
            toast()->info('Crea tu primer servicio');
            return redirect()->action('adminUser\ServiceController@createService');
        }

        return view('web.adminUser.serviceAnun.pendingService', compact('services'));
    }

    public function createService()
    {
        $categories = Category::all();

        return view('web.adminUser.serviceAnun.createService', compact('categories'));
    }

    public function createServiceCategoySelect()
    {
        $selectCategory = request()->input(['id']);

        $categories = Category::all();

        $category = Category::where('id', $selectCategory)
            ->first();

        $subCategories = Subcategory::where('category_id', $selectCategory)
            ->get();

        return view('web.adminUser.serviceAnun.createService', compact('categories', 'subCategories', 'category'));
    }

    public function storeService(CreateServiceRequest $request)
    {

        $user = User::where('id', userConnect()->id)
            ->first();

        if ($request->phoneWsp) {
            $phoneWsp = 'Y';
        } else {
            $phoneWsp = 'N';
        }

        $service = Service::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'status' => 'Pendiente',
            'phone' => $request['phone'],
            'phoneWsp' => $phoneWsp,
            'end_date' => now(),
            'user_id' => $user->id,
            'category_id' => $request['category_id'],
            'subcategory_id' => $request['subcategory_id'],
            'region_id' => $user->region_id,
            'ref' => Str::random(20),
            'slug' => Str::slug($request['title']),
        ]);

        $path = 'users/' . $user->id;
        $pathSub = 'users/' . $user->id . '/service';

        if (!is_dir($path)) {
            mkdir('users/' . $user->id);
        }
        if (!is_dir($pathSub)) {
            mkdir('users/' . $user->id . '/service');
        }


        if ($request->photo) {
            $image = $request->file('photo');

            $img = Image::make($image->getRealPath());


            if ($img->width() > 700) {
                $img->resize(700, null);
            }

            if ($img->height() > 400) {
                $img->resize(null, 400);
            }


            $img->save($pathSub . '/' . $image->getClientOriginalName());

            if (!$service->photo) {
                $service = Service::where('id', $service->id)
                    ->first();
                $service->photo = $image->getClientOriginalName();
                $service->save();
            }
        }

        if ($request['photo2']) {
            $countPhoto2 = count($request->photo2);

            if ($countPhoto2 > 2) {
                $maxPhoto2 = array_slice($request['photo2'], 0, 3);
            } else {
                $maxPhoto2 = $request['photo2'];
            }


            if ($maxPhoto2) {
                foreach ($maxPhoto2 as $photos) {

                    $image = $photos;

                    $img = Image::make($image->getRealPath());


                    if ($img->width() > 700) {
                        $img->resize(700, null);
                    }

                    if ($img->height() > 400) {
                        $img->resize(null, 400);
                    }


                    $img->save($pathSub . '/' . $image->getClientOriginalName());

                    $photoName = $image->getClientOriginalName();

                    $image = AppImage::create([
                        'name' => $photoName,
                        'service_id' => $service->id,
                    ]);
                }
            }
        }

        Mail::to('mikanthost@gmail.com')->send(new PublishServiceMail($service));

        toast()->success('Servicio agregado correctamente');
        return redirect()->action('adminUser\DashboardController@index');
    }

    public function editService($id)
    {
        $service = Service::find($id);

        $this->authorize('ownerService', $service);

        $images = AppImage::where('service_id', $service->id)
            ->get();

        $subCategory = Subcategory::where('id', $service->subcategory_id)
            ->first();

        return view('web.adminUser.serviceAnun.editService', compact('service', 'subCategory', 'images'));
    }

    public function updateService(UpdateServiceRequest $request, $id)
    {
        if ($request->phoneWsp) {
            $phoneWsp = 'Y';
        } else {
            $phoneWsp = 'N';
        }

        $user = User::where('id', userConnect()->id)
            ->first();

        $service = Service::find($id);
        $service->title = $request['title'];
        $service->description = $request['description'];
        $service->status = 'Pendiente';
        $service->phone = $request['phone'];
        $service->phoneWsp = $phoneWsp;
        $service->slug = Str::slug($request['title']);


        $path = 'users/' . $user->id;
        $pathSub = 'users/' . $user->id . '/service';

        if (!is_dir($path)) {
            mkdir('users/' . $user->id);
        }
        if (!is_dir($pathSub)) {
            mkdir('users/' . $user->id . '/service');
        }

        if ($request->photo) {
            $image = $request->file('photo');

            $img = Image::make($image->getRealPath());


            if ($img->width() > 700) {
                $img->resize(700, null);
            }

            if ($img->height() > 400) {
                $img->resize(null, 400);
            }

            $img->save($pathSub . '/' . $image->getClientOriginalName());
            $service->photo = $image->getClientOriginalName();
        }

        if ($request['photo2']) {
            $countPhoto2 = count($request->photo2);

            if ($countPhoto2 > 2) {
                $maxPhoto2 = array_slice($request['photo2'], 0, 3);
            } else {
                $maxPhoto2 = $request['photo2'];
            }


            if ($maxPhoto2) {
                foreach ($maxPhoto2 as $photos) {

                    $image = $photos;

                    $img = Image::make($image->getRealPath());


                    if ($img->width() > 700) {
                        $img->resize(700, null);
                    }

                    if ($img->height() > 400) {
                        $img->resize(null, 400);
                    }


                    $img->save($pathSub . '/' . $image->getClientOriginalName());

                    $photoName = $image->getClientOriginalName();

                    $image = AppImage::create([
                        'name' => $photoName,
                        'service_id' => $service->id,
                    ]);
                }
            }
        }

        $service->save();

        Mail::to('mikanthost@gmail.com')->send(new EditServiceMail($service));

        toast()->success('Servicio actualizado correctamente');
        return back();
    }

    public function deletePhoto($id)
    {
        $image = AppImage::find($id);
        File::delete('users/' . userConnect()->id . '/service/' . $image->name);
        $image->delete();

        toast()->success('Imágen eliminada correctamente');
        return back();
    }

    public function deleteService($id)
    {
        $service = Service::find($id);

        $this->authorize('ownerService', $service);

        $service->delete();

        toast()->success('Servicio eliminado correctamente');
        return back();
    }

    public function republishService($id)
    {
        $service = Service::find($id);

        $this->authorize('ownerService', $service);

        $service->end_date = \Carbon\Carbon::parse(now()->addDay(60));
        $service->save();

        Mail::to($service->user->email)->send(new RepublishServiceMail($service));

        toast()->success('Servicio actuzalido correctamente');
        return back();
    }
}
