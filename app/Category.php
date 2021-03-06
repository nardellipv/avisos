<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function Subcategory()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function Service()
    {
        return $this->hasMany(Service::class);
    }
}
