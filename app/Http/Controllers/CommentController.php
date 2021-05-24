<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function storeComment(CommentServiceRequest $request, $service)
    {
        Comment::create([
            'user_id' => userConnect()->id,
            'service_id' => $service,
            'comment' => $request['comment'],
        ]);
        
        toastr()->info('El comentario se agrego correctamente');
        return back();
    }
}
