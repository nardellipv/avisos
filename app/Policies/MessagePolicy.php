<?php

namespace App\Policies;

use App\Message;
use App\Service;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function ownerMessage(User $user, Message $message)
    {
        return $user->id == $message->user_id;
    }
}
