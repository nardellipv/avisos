<?php

namespace App\Http\Controllers\AdminSite;

use App\Blog;
use App\CategoryBlog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class BlogController extends Controller
{
    public function addPost()
    {
        $categories = CategoryBlog::all();

        return view('admin.blog.addPost', compact('categories'));
    }

    public function storePost(Request $request)
    {
        $blog = Blog::create([
            'title' => $request['title'],
            'body' => $request['body'],
            'slug' => Str::slug($request['title']),
            'category_blog_id' => $request['category_blog_id'],
        ]);

        if ($request->photo) {
            $image = $request->file('photo');
            $input = $blog->id .'-'. $image->getClientOriginalName();
            
            Image::make($image->getRealPath())            
            ->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save('imgBlog/' . $input);
            
            $blog->photo = $input;
        }

        $blog->save();

        toast('Post creado correctamente', 'success');
        return back();
    }
}
