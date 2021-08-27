<?php

namespace App\Http\Controllers;

use App\Blog;
use App\CategoryBlog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function list()
    {
        $posts = Blog::orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('web.blog.index', compact('posts'));
    }

    public function post($slug)
    {
        $post = Blog::where('slug', $slug)
            ->first();

        return view('web.blog.post', compact('post'));
    }

    public function listCategory($slug)
    {
        $category = CategoryBlog::where('slug', $slug)
            ->first();


        $posts = Blog::orderBy('created_at', 'DESC')
            ->where('category_blog_id', $category->id)
            ->paginate(10);

        return view('web.blog.indexCategorySearch', compact('posts','category'));
    }
}
