<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Favorite;
use App\Message;
use App\Region;
use App\Service;
use App\Subcategory;
use Illuminate\Support\Facades\View;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use OpenWeather;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer([
            'web.parts._browserCategories',
            'web.parts._headerList',
            'web.categories._asideList',
            'web.parts._menu',
        ], function ($view) {

            if (Cache::has('categoryCache')) {
                $categories = Cache::get('categoryCache');
            } else {
                $categories = Category::withCount([
                    'service as services_count' => function ($query) {
                        $query->where('status', 'Activo');
                    }
                ])->get();

                Cache::put('categoryCache', $categories, 600);
            }


            $view->with([
                'categories' => $categories,
            ]);
        });

        View::composer([
            'web.adminUser.parts._asideMenu',
            'web.parts._menu',
        ], function ($view) {

            if (Auth::check()) {

                if (Cache::has('serviceCache')) {
                    $service = Cache::get('serviceCache');
                } else {
                    $service = Service::where('user_id', userConnect()->id)
                        ->first();

                    Cache::put('serviceCache', $service, 600);
                }

                $countFavorite = Favorite::where('user_id', userConnect()->id)
                    ->count();

                if (Cache::has('countServiceCache')) {
                    $countService = Cache::get('countServiceCache');
                } else {
                    $countService = Service::where('user_id', userConnect()->id)
                        ->where('status', 'Activo')
                        ->count();

                    Cache::put('countServiceCache', $countService, 600);
                }

                $countPendingService = Service::where('user_id', userConnect()->id)
                    ->where('status', 'Pendiente')
                    ->count();

                if (!empty($service->id)) {
                    $countPendingMessages = Message::where('user_id', userConnect()->id)
                        ->where('read', 'N')
                        ->count();
                } else {
                    $countPendingMessages = 0;
                }

                $view->with([
                    'user' => userConnect()->id,
                    'countFavorite' => $countFavorite,
                    'countService' => $countService,
                    'countPendingService' => $countPendingService,
                    'countPendingMessages' => $countPendingMessages,
                ]);
            }
        });


        View::composer([
            'web.parts._menu',
        ], function ($view) {

            $weather = new OpenWeather();
            $temp = $weather->getCurrentWeatherByCityName('Mendoza', 'metric');

            $view->with([
                'temp' => $temp,
            ]);
        });

    }
}
