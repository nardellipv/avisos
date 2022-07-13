<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jambasangsang\Flash\Facades\LaravelFlash;

class CommentController extends Controller
{
    public function storeComment(CommentServiceRequest $request, $service)
    {
        Comment::create([
            'user_id' => userConnect()->id,
            'service_id' => $service,
            'comment' => $request['comment'],
        ]);
        
        LaravelFlash::withInfo('El comentario se agrego correctamente');
        return back();
    }
}
