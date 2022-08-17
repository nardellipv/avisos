<?php

namespace App\Http\Controllers\adminSite;

use App\Http\Controllers\Controller;
use App\Message;
use Jambasangsang\Flash\Facades\LaravelFlash;

class MessageController extends Controller
{
    public function listAdminMessage()
    {
        $messages = Message::all();

        return view('admin.message.listMessage', compact('messages'));
    }

    public function deleteAdminMessage($id)
    {
        $messages = Message::find($id);
        $messages->delete();

        LaravelFlash::withInfo('Mensaje Eliminado');
        return back();
    }
}
