<?php

namespace App\Http\Controllers;

use App\Blog;
use App\CategoryBlog;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Support\Str;

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

        SEOMeta::setTitle('Blog Avisos Mendoza ' . date('Y'));
        SEOMeta::setDescription($post->title);

        OpenGraph::setDescription(Str::limit(strip_tags($post->body, 150)));
        OpenGraph::setTitle('Avisos Mendoza - ' . $post->title);
        OpenGraph::setUrl('https://avisosmendoza.com.ar/blog/' . $post->slug);
        SEOMeta::addKeyword([
            'Clasificados', 'Avisos Clasificados', 'Mendoza', 'Mendoza Trabajo', 'Mendoza Clasificados',
            'Avisos en Mendoza', 'Clasificados Los Andes', 'Clasificados diario uno', 'alquileres en mendoza'
        ]);
        OpenGraph::addImage(['url' => 'https://avisosmendoza.com.ar/imgBlog/' . $post->photo]);
        // OpenGraph::addImage(['url' => 'https://avisosmendoza.com.ar/imgBlog/' . $post->photo, 'size' => 300]);
        OpenGraph::addProperty('type', 'articles');

        return view('web.blog.post', compact('post'));
    }

    public function listCategory($slug)
    {
        $category = CategoryBlog::where('slug', $slug)
            ->first();


        $posts = Blog::orderBy('created_at', 'DESC')
            ->where('category_blog_id', $category->id)
            ->paginate(10);

        return view('web.blog.indexCategorySearch', compact('posts', 'category'));
    }
}
