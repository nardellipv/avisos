<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question', 'user_id','service_id'
    ];

    public function Service()
    {
        return $this->belongsTo(Service::class);
    }
}
