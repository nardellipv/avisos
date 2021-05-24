<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'name', 'service_id'
    ];

    public function Service()
    {
        return $this->belongsTo(Service::class);
    }
}
