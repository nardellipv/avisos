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
use Illuminate\Support\Facades\Storage;
use Jambasangsang\Flash\Facades\LaravelFlash;

class ServiceController extends Controller
{
    public $publicDays;
    public $sponsorDays;

    public function __construct()
    {
        $this->publicDays = (int) trim(Storage::disk('public')->get('dayPublic.txt'));
        $this->sponsorDays = (int) trim(Storage::disk('public')->get('daySponsor.txt'));
    }

    public function listServices()
    {
        SEOMeta::setTitle('Mis Servicios Publicados | Avisos Mendoza');
        SEOMeta::setDescription('Administrá tus servicios publicados en Avisos Mendoza. Modificá, destacá o republicá tus avisos para llegar a más clientes.');
        SEOMeta::setCanonical(route('service.list'));
        SEOMeta::addMeta('robots', 'noindex, nofollow');

        SEOMeta::addKeyword([
            'mis servicios avisos mendoza',
            'gestionar publicaciones',
            'republicar servicio',
            'destacar servicio',
            'editar servicios publicados'
        ]);

        OpenGraph::setTitle('Gestión de Servicios | Avisos Mendoza');
        OpenGraph::setDescription('Panel para gestionar tus servicios publicados en Avisos Mendoza.');
        OpenGraph::setUrl(route('service.list'));
        OpenGraph::setSiteName('Avisos Mendoza');

        $services = Service::with(['category', 'region', 'user'])
            ->where('user_id', userConnect()->id)
            ->whereNotIn('status', ['Desactivo', 'Pendiente'])
            ->get();

        if ($services->isEmpty()) {
            LaravelFlash::withInfo('Crea tu primer servicio');
            return redirect()->route('service.create');
        }

        return view('web.adminUser.serviceAnun.listService', compact('services'));
    }

    public function pendingService()
    {
        SEOMeta::setTitle('Servicios Pendientes de Aprobación | Avisos Mendoza');
        SEOMeta::setDescription('Estos son tus servicios que están pendientes de revisión o activación. Una vez aprobados estarán visibles en el sitio.');
        SEOMeta::setCanonical(route('service.pending'));
        SEOMeta::addMeta('robots', 'noindex, nofollow');

        OpenGraph::setTitle('Servicios Pendientes | Avisos Mendoza');
        OpenGraph::setDescription('Tus servicios en espera de aprobación. Revisalos o editá si lo necesitás.');
        OpenGraph::setUrl(route('service.pending'));
        OpenGraph::setSiteName('Avisos Mendoza');

        $services = Service::with(['category', 'region', 'user'])
            ->where('user_id', userConnect()->id)
            ->where('status', 'Pendiente')
            ->get();

        if ($services->isEmpty()) {
            LaravelFlash::withInfo('Crea tu primer servicio');
            return redirect()->route('service.create');
        }

        return view('web.adminUser.serviceAnun.pendingService', compact('services'));
    }


    public function createService()
    {
        SEOMeta::setTitle('Publicá tu Servicio Gratis | Avisos Mendoza');
        SEOMeta::setDescription('Subí tu aviso en pocos pasos. Completá los datos de tu servicio y empezá a recibir consultas de nuevos clientes en Mendoza.');
        SEOMeta::setCanonical(route('service.create'));
        SEOMeta::addMeta('robots', 'noindex, nofollow');

        OpenGraph::setTitle('Crear Nuevo Servicio | Avisos Mendoza');
        OpenGraph::setDescription('Publicá tu aviso de manera gratuita en Avisos Mendoza.');
        OpenGraph::setUrl(route('service.create'));
        OpenGraph::setSiteName('Avisos Mendoza');

        $categories = Category::all();
        return view('web.adminUser.serviceAnun.createService', compact('categories'));
    }

    public function createServiceCategoySelect()
    {
        $selectCategory = request()->input('id');
        $category = Category::find($selectCategory);
        $categories = Category::all();
        $subCategories = Subcategory::where('category_id', $selectCategory)->get();

        if ($category) {
            SEOMeta::setTitle("Publicá un servicio de {$category->name} | Avisos Mendoza");
            SEOMeta::setDescription("Completá los detalles del servicio de {$category->name} que querés publicar en Avisos Mendoza.");
            SEOMeta::setCanonical(route('service.createCategoySelect') . '?id=' . $category->id);
            SEOMeta::addMeta('robots', 'noindex, nofollow');

            OpenGraph::setTitle("Crear aviso de {$category->name} | Avisos Mendoza");
            OpenGraph::setDescription("Subí un servicio de {$category->name} en Mendoza y conseguí más clientes.");
            OpenGraph::setUrl(route('service.createCategoySelect') . '?id=' . $category->id);
            OpenGraph::setSiteName('Avisos Mendoza');
        }

        return view('web.adminUser.serviceAnun.createService', compact('categories', 'subCategories', 'category'));
    }


    public function storeService(CreateServiceRequest $request)
    {
        $user = User::where('id', userConnect()->id)->first();
        $phoneWsp = $request->has('phoneWsp') ? 'Y' : 'N';

        $hoursData = $request->input('hours');
        $filteredHours = [];

        if (is_array($hoursData)) {
            foreach ($hoursData as $day => $timeSlots) {
                $validDaySlots = [];

                if (is_array($timeSlots)) {
                    foreach ($timeSlots as $slot) {
                        $open = $slot['open'] ?? null;
                        $close = $slot['close'] ?? null;

                        if (!empty($open) && !empty($close)) {
                            $validDaySlots[] = ['open' => $open, 'close' => $close];
                        }
                    }
                }

                if (!empty($validDaySlots)) {
                    $filteredHours[$day] = $validDaySlots;
                }
            }
        }

        $service = Service::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'status' => 'Pendiente',
            'phone' => $request['phone'],
            'phoneWsp' => $phoneWsp,
            'end_date' => now()->addDays($this->publicDays),
            'user_id' => $user->id,
            'category_id' => $request['category_id'],
            'subcategory_id' => $request['subcategory_id'],
            'region_id' => $user->region_id,
            'ref' => Str::random(20),
            'slug' => Str::slug($request['title']),
            'social_facebook' => $request['social_facebook'] ?? null,
            'social_instagram' => $request['social_instagram'] ?? null,
            'social_website' => $request['social_website'] ?? null,
            'years_of_experience' => $request['years_of_experience'] ?? null,
            'payment_methods' => $request['payment_methods'] ?? null,
            'estimate_cost' => $request['estimate_cost'] ?? null,
            'structured_availability_hours' => $filteredHours,
            'attends_emergencies' => $request->has('available_24_7'),
        ]);

        $path = 'users/' . $user->id;
        $pathSub = $path . '/service';

        if (!is_dir($path)) mkdir($path, 0755, true);
        if (!is_dir($pathSub)) mkdir($pathSub, 0755, true);

        if ($request->hasFile('photo')) {
            $uploadedPhotos = is_array($request->file('photo')) ? $request->file('photo') : [$request->file('photo')];
            $maxPhotoCount = 3;

            foreach (array_slice($uploadedPhotos, 0, $maxPhotoCount) as $index => $photoFile) {
                if ($photoFile && $photoFile->isValid()) {
                    $imageName = time() . '_' . $index . '_' . Str::random(8) . '.' . $photoFile->getClientOriginalExtension();
                    $destinationPath = public_path($pathSub);

                    $img = Image::make($photoFile->getRealPath());
                    $img->resize(700, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->save($destinationPath . '/' . $imageName);

                    if ($index === 0) {
                        $service->photo = $imageName;
                        $service->save();
                    }

                    AppImage::create([
                        'name' => $imageName,
                        'service_id' => $service->id,
                    ]);
                }
            }
        }

        Mail::to('mikanthost@gmail.com')->send(new PublishServiceMail($service));
        LaravelFlash::withInfo('Servicio agregado correctamente');
        return redirect()->route('dashboard.index');
    }

    public function editService($id)
    {
        $service = Service::find($id);
        $this->authorize('ownerService', $service);
        $images = AppImage::where('service_id', $service->id)->get();
        $subCategory = Subcategory::find($service->subcategory_id);

        SEOMeta::setTitle('Editar Servicio: ' . $service->title);
        SEOMeta::setDescription('Modificá los datos de tu publicación para mantenerla actualizada en Avisos Mendoza.');


        return view('web.adminUser.serviceAnun.editService', compact('service', 'subCategory', 'images'));
    }

    public function updateService(UpdateServiceRequest $request, $id)
    {
        $user = User::where('id', userConnect()->id)->first();
        $service = Service::find($id);
        $this->authorize('ownerService', $service);

        $phoneWsp = $request->has('phoneWsp') ? 'Y' : 'N';

        $hoursData = $request->input('hours');
        $filteredHours = [];

        if (is_array($hoursData)) {
            foreach ($hoursData as $day => $timeSlots) {
                $validDaySlots = [];

                if (is_array($timeSlots)) {
                    foreach ($timeSlots as $slot) {
                        $open = $slot['open'] ?? null;
                        $close = $slot['close'] ?? null;

                        if (!empty($open) && !empty($close)) {
                            $validDaySlots[] = ['open' => $open, 'close' => $close];
                        }
                    }
                }

                if (!empty($validDaySlots)) {
                    $filteredHours[$day] = $validDaySlots;
                }
            }
        }

        $service->fill([
            'title' => $request['title'],
            'description' => $request['description'],
            'status' => 'Pendiente',
            'phone' => $request['phone'],
            'phoneWsp' => $phoneWsp,
            'slug' => Str::slug($request['title']),
            'social_facebook' => $request['social_facebook'] ?? null,
            'social_instagram' => $request['social_instagram'] ?? null,
            'social_website' => $request['social_website'] ?? null,
            'years_of_experience' => $request['years_of_experience'] ?? null,
            'payment_methods' => $request['payment_methods'] ?? null,
            'estimate_cost' => $request['estimate_cost'] ?? null,
            'structured_availability_hours' => $filteredHours,
            'attends_emergencies' => $request->has('available_24_7'),
        ]);

        $service->save();

        $path = 'users/' . $user->id;
        $pathSub = $path . '/service';

        if (!is_dir($path)) mkdir($path, 0755, true);
        if (!is_dir($pathSub)) mkdir($pathSub, 0755, true);

        if ($request->hasFile('photo')) {
            $uploadedPhotos = is_array($request->file('photo')) ? $request->file('photo') : [$request->file('photo')];
            $maxPhotoCount = 3;

            foreach (array_slice($uploadedPhotos, 0, $maxPhotoCount) as $index => $photoFile) {
                if ($photoFile && $photoFile->isValid()) {
                    $imageName = time() . '_' . $index . '_' . Str::random(8) . '.' . $photoFile->getClientOriginalExtension();
                    $destinationPath = public_path($pathSub);

                    $img = Image::make($photoFile->getRealPath());
                    $img->resize(700, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->save($destinationPath . '/' . $imageName);

                    if ($index === 0) {
                        $service->photo = $imageName;
                        $service->save();
                    }

                    AppImage::create([
                        'name' => $imageName,
                        'service_id' => $service->id,
                    ]);
                }
            }
        }

        Mail::to('mikanthost@gmail.com')->send(new EditServiceMail($service));
        LaravelFlash::withSuccess("Servicio actualizado correctamente");
        return back();
    }

    public function deletePhoto($id)
    {
        $image = AppImage::find($id);
        File::delete('users/' . userConnect()->id . '/service/' . $image->name);
        $image->delete();
        LaravelFlash::withInfo('Imágen eliminada correctamente');
        return back();
    }

    public function deleteService($id)
    {
        $service = Service::find($id);
        $this->authorize('ownerService', $service);
        $service->delete();
        LaravelFlash::withInfo('Servicio eliminado correctamente');
        return back();
    }

    public function republishService($id)
    {
        $service = Service::find($id);
        $this->authorize('ownerService', $service);
        $service->end_date = now()->addDays((int)$this->publicDays);
        $service->save();
        Mail::to($service->user->email)->send(new RepublishServiceMail($service));
        LaravelFlash::withInfo('Servicio actualizado correctamente');
        return back();
    }
}
