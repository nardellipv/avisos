<?php

namespace App\Http\Controllers\adminUser;

use App\Favorite;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class FavoriteController extends Controller
{

    public function listFavorite()
    {
        SEOMeta::setTitle('Avisos Mendoza | Favoritos');
        SEOMeta::setDescription('Llegá a más mendocinos publicando tu servicio en Avisos Mendoza totalmente gratis y en un instante.');

        OpenGraph::setDescription('Llegá a más mendocinos publicando tu servicio en Avisos Mendoza totalmente gratis y en un instante.');
        OpenGraph::setTitle('Avisos Mendoza');

        $favorites = Favorite::with(['service', 'service.region', 'service.user'])
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

        toast()->success('Servicio agregado como favorito correctamente');
        return back();
    }

    public function deleteFavorite($id)
    {
        $favorite = Favorite::find($id);

        $this->authorize('favoriteDelete', $favorite);

        $favorite->delete();

        toast()->success('Servicio favorito eliminado correctamente');
        return back();
    }
}
