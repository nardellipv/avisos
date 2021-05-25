<?php

namespace App\Http\Controllers\AdminUser;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Image as AppImage;
use App\Mail\PublishServiceMail;
use Image;
use App\Service;
use App\Subcategory;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ServiceController extends Controller
{

    public function listServices()
    {
        $services = Service::with(['category', 'region', 'user'])
            ->where('user_id', userConnect()->id)
            ->where('status', 'Activo')
            ->get();

        if ($services->isEmpty()) {
            $categories = Category::all();
            toastr()->info('Crea tu primer servicio');
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
            toastr()->info('Crea tu primer servicio');
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
            'end_date' => now()->addDays(60),
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

        Mail::to('mikanthost@gmail.com')->send(new PublishServiceMail($service));

        toastr()->success('Servicio agregado correctamente');
        return redirect()->action('adminUser\DashboardController@index');
    }

    public function editService($id)
    {
        $service = Service::find($id);

        $this->authorize('ownerService', $service);

        $subCategory = Subcategory::where('id', $service->subcategory_id)
            ->first();

        return view('web.adminUser.serviceAnun.editService', compact('service', 'subCategory'));
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

        $service->save();

        toastr()->success('Servicio actualizado correctamente');
        return back();
    }

    public function deleteService($id)
    {
        $service = Service::find($id);

        $this->authorize('ownerService', $service);

        $service->delete();

        toastr()->success('Servicio eliminado correctamente');
        return back();
    }
}
