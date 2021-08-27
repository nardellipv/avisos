<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryBlog extends Model
{
    public $timestamps = false;

    public function Blog()
    {
        return $this->hasMany(Blog::class);
    }
}
