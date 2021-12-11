<?php

namespace App\Http\Controllers\adminUser;

use App\Http\Controllers\Controller;
use App\Message;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class MessageController extends Controller
{
    public function listMessage()
    {
        SEOMeta::setTitle('Avisos Mendoza | Mensajes');
        SEOMeta::setDescription('Llegá a más mendocinos publicando tu servicio en Avisos Mendoza totalmente gratis y en un instante.');

        OpenGraph::setDescription('Llegá a más mendocinos publicando tu servicio en Avisos Mendoza totalmente gratis y en un instante.');
        OpenGraph::setTitle('Avisos Mendoza');

        $messages = Message::where('user_id', userConnect()->id)
            ->get();

        return view('web.adminUser.message.listMessage', compact('messages'));
    }

    public function responseMessage($id)
    {
        $message = Message::find($id);

        $this->authorize('ownerMessage', $message);

        $message->read = 'Y';
        $message->save();

        return view('web.adminUser.message.response', compact('message'));
    }

    public function deleteMessage($id)
    {
        $messages = Message::find($id);

        $this->authorize('ownerMessage', $messages);

        $messages->delete();

        toast()->success('Mensaje eliminado correctamente');
        return back();
    }
}
