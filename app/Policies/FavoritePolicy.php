<?php

namespace App\Policies;

use App\Favorite;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FavoritePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function favoriteDelete(User $user, Favorite $favorite)
    {
        return $user->id == $favorite->user_id;
    }
}
