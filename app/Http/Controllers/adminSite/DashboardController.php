<?php

namespace App\Http\Controllers\adminSite;

use App\Http\Controllers\Controller;
use App\Category;
use App\Subcategory;
use App\Region;
use App\Service; // Usando el modelo Service que ya tienes importado
use App\TempSponsor;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url as SitemapUrl;
use Illuminate\Support\Facades\Http; // Asegúrate de tener este use
use Illuminate\Support\Facades\Log;  // Asegúrate de tener este use


class DashboardController extends Controller
{
    public function dashboard()
    {
        $userClientCount = User::where('type', 'Cliente')->count();
        $userAnunCount = User::where('type', 'Anunciante')->count();
        $serviceActiveCount = Service::where('status', 'Activo')->count();
        $servicePausedCount = Service::where('status', 'Pausado')->count();
        $users = User::with(['region'])->get();
        $servicePending = Service::where('status', 'PENDIENTE')->get();
        $serviceSponsorPending = TempSponsor::with(['service'])
            ->where('pay', 'N')
            ->get();
        $publicDays = Storage::disk('public')->get('dayPublic.txt');
        $sponsorDays = Storage::disk('public')->get('daySponsor.txt');

        return view('admin.indexAdminSite', compact(
            'userClientCount',
            'userAnunCount',
            'serviceActiveCount',
            'users',
            'servicePending',
            'servicePausedCount',
            'publicDays',
            'sponsorDays',
            'serviceSponsorPending'
        ));
    }

    public function incrementService()
    {
        $services = Service::all();

        foreach ($services as $service) {
            $service->visit += rand(20, 50);
            $service->like += rand(6, 15);
            $service->save();
        }

        return back();
    }

    public function sitemap()
    {
        $sitemap = Sitemap::create();

        // Página principal
        $sitemap->add(
            SitemapUrl::create('/')
                ->setLastModificationDate(Carbon::now())
                ->setPriority(1.0)
                ->setChangeFrequency(SitemapUrl::CHANGE_FREQUENCY_DAILY)
        );

        // Listado principal
        $sitemap->add(
            SitemapUrl::create('/listado')
                ->setLastModificationDate(Carbon::now())
                ->setPriority(0.8)
                ->setChangeFrequency(SitemapUrl::CHANGE_FREQUENCY_DAILY)
        );

        // Categorías y subcategorías
        foreach (Category::all() as $category) {
            $sitemap->add(
                SitemapUrl::create('/listado/' . $category->slug)
                    ->setLastModificationDate(Carbon::now())
                    ->setPriority(0.7)
                    ->setChangeFrequency(SitemapUrl::CHANGE_FREQUENCY_WEEKLY)
            );

            foreach (Subcategory::where('category_id', $category->id)->get() as $sub) {
                $sitemap->add(
                    SitemapUrl::create("/listado/{$category->slug}/subcategoria/{$sub->id}")
                        ->setLastModificationDate(Carbon::now())
                        ->setPriority(0.6)
                        ->setChangeFrequency(SitemapUrl::CHANGE_FREQUENCY_WEEKLY)
                );
            }
        }

        // Servicios activos
        foreach (Service::where('status', 'Activo')->get() as $service) {
            $sitemap->add(
                SitemapUrl::create("/servicio/{$service->slug}/referencia/{$service->ref}")
                    ->setLastModificationDate($service->updated_at ?? $service->created_at)
                    ->setPriority(0.9)
                    ->setChangeFrequency(SitemapUrl::CHANGE_FREQUENCY_DAILY)
            );
        }

        // Guardar sitemap en public/sitemap.xml
        $sitemap->writeToFile('sitemap.xml');

        return back();
    }

    public function changeDaysService(Request $request)
    {
        Storage::disk('public')->put('dayPublic.txt', $request->publicDays);
        Storage::disk('public')->put('daySponsor.txt', $request->sponsorDays);
        return back();
    }

    public function publicationMake()
    {
        // --- 1. Obtener Credenciales y Configuración ---
        $accessToken = config('services.instagram.token');
        $igUserId = config('services.instagram.user_id');
        $apiVersion = 'v19.0';
        $baseUrl = "https://graph.facebook.com/{$apiVersion}";
        $appUrl = rtrim(config('app.url'), '/');

        // --- 2. Seleccionar UN Servicio al Azar ---
        $service = Service::with(['user', 'category']) // Eager load user y category
                           ->where('status', 'Activo')
                           ->whereNotNull('photo')
                           ->where('photo', '!=', '')
                           ->inRandomOrder()
                           ->first();
        
        // --- 3. Preparar datos para el Contenedor de Imagen Única ---
        $filename = $service->photo;
        $encodedFilename = rawurlencode($filename);
        $imageUrl = $appUrl . '/users/' . $service->user->id . '/service/' . $encodedFilename;
        
        // --- Construcción del Caption Modificada ---
        $caption = $service->title; // Título del servicio
        $caption .= "\n\n" . strip_tags($service->description); // Descripción del servicio (quitando etiquetas HTML)
        
        $categoryName = $service->category ? str_replace(' ', '', $service->category->name) : 'Servicio';
        $caption .= "\n\nEncuentra más en avisosmendoza.com.ar\n#AvisosMendoza #" . $categoryName;
        // --- Fin Construcción del Caption ---

        // Crear Contenedor
        $responseCreate = Http::asForm()->post("{$baseUrl}/{$igUserId}/media", [
            'image_url' => $imageUrl,
            'caption' => $caption, // Aquí se usa el caption modificado
            'access_token' => $accessToken,
        ]);

        // Esta comprobación es importante para asegurar que tenemos un ID de contenedor
        if (!$responseCreate->successful() || !isset($responseCreate->json()['id'])) {
            $apiErrorMsg = $responseCreate->json()['error']['error_user_msg'] ?? ('Error al crear contenedor. Status: ' . $responseCreate->status());
            return back()->with('error', "Instagram API (Crear Contenedor): " . $apiErrorMsg);
        }
        $imageContainerId = $responseCreate->json()['id'];

        // --- 4. Publicar Contenedor de Imagen ---
        $responsePublish = Http::asForm()->post("{$baseUrl}/{$igUserId}/media_publish", [
            'creation_id' => $imageContainerId,
            'access_token' => $accessToken,
        ]);

        return back()->with('success', "¡Intento de post en Instagram realizado! (Servicio: {$service->title})");
    }
}