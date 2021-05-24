<?php

namespace App\Http\Controllers\adminUser;

use App\Favorite;
use App\Http\Controllers\Controller;


class FavoriteController extends Controller
{

    public function listFavorite()
    {
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

        toastr()->success('Servicio agregado como favorito correctamente');
        return back();
    }

    public function deleteFavorite($id)
    {
        $favorite = Favorite::find($id);

        $this->authorize('favoriteDelete', $favorite);

        $favorite->delete();

        toastr()->success('Servicio favorito eliminado correctamente');
        return back();
    }
}
