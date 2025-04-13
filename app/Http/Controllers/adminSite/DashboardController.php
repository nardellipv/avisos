<?php

namespace App\Http\Controllers\adminSite;

use App\Http\Controllers\Controller;
use App\Category;
use App\Subcategory;
use App\Region;
use App\Service;
use App\TempSponsor;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url as SitemapUrl;


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
        $sitemap->writeToFile(public_path('sitemap.xml'));

        return back();
    }

    public function changeDaysService(Request $request)
    {
        Storage::disk('public')->put('dayPublic.txt', $request->publicDays);
        Storage::disk('public')->put('daySponsor.txt', $request->sponsorDays);
        return back();
    }
}
