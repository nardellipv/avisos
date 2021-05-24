<?php

namespace App\Policies;

use App\Service;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization;

    public function ownerService(User $user, Service $service)
    {
        return $user->id == $service->user_id;
    }
}
