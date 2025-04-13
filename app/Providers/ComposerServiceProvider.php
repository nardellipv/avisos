<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Favorite;
use App\Message;
use App\Service;
use Illuminate\Support\Facades\View;
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
            'web.adminUser.parts._asideMenu',
            'web.parts._menu',
        ], function ($view) {
            if (Auth::check()) {
                $userId = userConnect()->id;

                $service = Service::where('user_id', $userId)->first();

                $countFavorite = Favorite::where('user_id', $userId)->count();

                $countService = Service::where('user_id', $userId)
                    ->where('status', 'Activo')
                    ->count();

                $countPendingService = Service::where('user_id', $userId)
                    ->where('status', 'Pendiente')
                    ->count();

                $countPendingMessages = 0;

                if (!empty($service->id)) {
                    $countPendingMessages = Message::where('user_id', $userId)
                        ->where('read', 'N')
                        ->count();
                }

                $view->with([
                    'user' => $userId,
                    'countFavorite' => $countFavorite,
                    'countService' => $countService,
                    'countPendingService' => $countPendingService,
                    'countPendingMessages' => $countPendingMessages,
                ]);
            }
        });
    }
}
