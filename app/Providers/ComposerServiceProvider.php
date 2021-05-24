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
            $categories = Category::withCount([
                'service as services_count' => function ($query) {
                    $query->where('status', 'Activo');
                }
            ])->get();

            $view->with([
                'categories' => $categories,
            ]);
        });

        View::composer([
            'web.parts._location',
            'web.parts._headerList',
            'web.categories._asideList',
        ], function ($view) {
            $regions = Region::withCount(['service'])
                ->get();

            $view->with([
                'regions' => $regions,
            ]);
        });

        View::composer([
            'web.adminUser.parts._asideMenu',
            'web.parts._menu',
        ], function ($view) {

            if (Auth::check()){
                $service = Service::where('user_id', userConnect()->id)
                    ->first();

                $countFavorite = Favorite::where('user_id', userConnect()->id)
                    ->count();

                $countService = Service::where('user_id', userConnect()->id)
                    ->where('status', 'Activo')
                    ->count();

                $countPendingService = Service::where('user_id', userConnect()->id)
                    ->where('status', 'Pendiente')
                    ->count();

                if (!empty($service->id)) {
                    $countPendingMessages = Message::where('service_id', $service->id)
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
    }
}
