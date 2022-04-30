<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempSponsor extends Model
{
    protected $fillable = [
        'service_id', 'pay'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Service()
    {
        return $this->belongsTo(Service::class);
    }
}
