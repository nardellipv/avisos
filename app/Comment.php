<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment', 'user_id','service_id'
    ];

    public function Service()
    {
        return $this->belongsTo(Service::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
