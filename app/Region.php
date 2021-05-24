<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function Service()
    {
        return $this->hasMany(Service::class);
    }

    public function User()
    {
        return $this->hasMany(User::class);
    }
}
