<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title', 'description', 'status', 'phone', 'phoneWsp',
        'currency', 'visit', 'like', 'photo', 'end_date', 'user_id', 'category_id', 'subcategory_id', 'region_id', 'ref', 'slug'
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
}
