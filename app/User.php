<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'email', 'phone','type','region_id', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Service()
    {
        return $this->hasMany(Service::class);
    }

    public function Region()
    {
        return $this->belongsTo(Region::class);
    }

    public function Comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function Favorite()
    {
        return $this->hasMany(Favorite::class);
    }

    public function Message()
    {
        return $this->hasMany(Message::class);
    }
}
