<?php

namespace App\Http\Controllers\AdminUser;

use App\Favorite;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Jambasangsang\Flash\Facades\LaravelFlash;

class FavoriteController extends Controller
{

    public function listFavorite()
    {
        SEOMeta::setTitle('Mis Servicios Favoritos | Avisos Mendoza');
        SEOMeta::setDescription('Revisá y administrá tus servicios favoritos guardados en Avisos Mendoza. Volvé a contactarte con los profesionales que más te interesaron.');
        SEOMeta::setCanonical(route('favorite.list'));
        SEOMeta::addMeta('robots', 'noindex, nofollow');
    
        SEOMeta::addKeyword([
            'servicios guardados',
            'favoritos avisos mendoza',
            'mis avisos guardados',
            'avisos mendoza usuario',
            'contactar servicios mendocinos'
        ]);
    
        OpenGraph::setTitle('Mis Favoritos | Servicios Guardados en Avisos Mendoza');
        OpenGraph::setDescription('Volvé a ver los oficios que guardaste como favoritos en Avisos Mendoza. Retomá el contacto con profesionales de Mendoza.');
        OpenGraph::setUrl(route('favorite.list'));
        OpenGraph::setSiteName('Avisos Mendoza');
    
        $favorites = Favorite::with(['service', 'service.region', 'service.user', 'service.category'])
            ->where('user_id', userConnect()->id)
            ->get();
    
        return view('web.adminUser.favorite.listFavorite', compact('favorites'));
    }

    public function addFavorite($id)
    {
        Favorite::firstOrCreate([
            'user_id' => userConnect()->id,
            'service_id' => $id
        ]);

        LaravelFlash::withInfo('Servicio agregado como favorito correctamente');
        return back();
    }

    public function deleteFavorite($id)
    {
        $favorite = Favorite::find($id);

        $this->authorize('favoriteDelete', $favorite);

        $favorite->delete();

        LaravelFlash::withInfo('Servicio favorito eliminado correctamente');
        return back();
    }
}
