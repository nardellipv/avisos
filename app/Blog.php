<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title', 'body', 'photo', 'view', 'like', 'slug', 'category_blog_id'
    ];

    public function CategoryBlog()
    {
        return $this->belongsTo(CategoryBlog::class);
    }
}
