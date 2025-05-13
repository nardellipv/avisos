<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'phone',
        'phoneWsp',
        'visit',
        'like',
        'photo', 
        'end_date',
        'user_id',
        'category_id',
        'subcategory_id',
        'region_id',
        'ref',
        'slug',
        'social_facebook',
        'social_instagram',
        'social_website',
        'years_of_experience',
        'structured_availability_hours',
        'payment_methods',
        'estimate_cost',
        'attends_emergencies',
    ];

    protected $casts = [
        'structured_availability_hours' => 'json',
        'payment_methods' => 'json',
        'attends_emergencies' => 'boolean',
        'phoneWsp' => 'boolean', // Si phoneWsp es ENUM('Y','N') y quieres tratarlo como boolean
        'end_date' => 'date',    // Castear fechas es buena práctica
        // 'years_of_experience' => 'integer', // Ya es int en DB, cast opcional
        'estimate_cost' => 'string',
    ];


    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Region()
    {
        return $this->belongsTo(Region::class);
    }

    public function Subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function Image()
    {
        return $this->hasMany(Image::class);
    }

    public function Comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function Question()
    {
        return $this->hasMany(Question::class);
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Favorite()
    {
        return $this->hasMany(Favorite::class);
    }

    public function TempSponsor()
    {
        return $this->hasMany(TempSponsor::class);
    }


    //Scopes

    public function scopeRegions($query, $type)
    {
        if ($type != 'all')
            return $query->where('region_id', $type);
    }

    public function scopeService($query, $type)
    {
        if ($type)
            return $query->where('title', 'LIKE', '%' . $type . '%');
    }

    public function scopePhoto($query, $type)
    {
        if ($type)
            return $query->orWhere('photo', $type);
    }

    public function scopePhone($query, $type)
    {
        if ($type)
            return $query->orWhere('phone', $type);
    }

    public function scopePhoneWsp($query, $type)
    {
        if ($type)
            return $query->orWhere('phoneWsp', 'N');
    }
}
