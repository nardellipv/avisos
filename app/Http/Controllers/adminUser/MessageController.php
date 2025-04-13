<?php

namespace App\Http\Controllers\AdminUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResponseMailClientRequest;
use App\Mail\ResponseServiceMail;
use App\Message;
use App\Service;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Support\Facades\Mail;
use Jambasangsang\Flash\Facades\LaravelFlash;

class MessageController extends Controller
{
    public function listMessage()
    {
        SEOMeta::setTitle('Mis Mensajes | Avisos Mendoza');
        SEOMeta::setDescription('Gestioná tus mensajes recibidos y respondé consultas sobre tus servicios publicados en Avisos Mendoza.');
        SEOMeta::setCanonical(route('message.list'));
        SEOMeta::addMeta('robots', 'noindex, nofollow');

        SEOMeta::addKeyword([
            'mis mensajes',
            'mensajes avisos mendoza',
            'consultas de clientes',
            'inbox usuario avisos',
            'responder mensajes servicios'
        ]);

        OpenGraph::setTitle('Mis Mensajes | Panel Usuario - Avisos Mendoza');
        OpenGraph::setDescription('Revisá tus mensajes y respondé consultas de personas interesadas en tus avisos.');
        OpenGraph::setUrl(route('message.list'));
        OpenGraph::setSiteName('Avisos Mendoza');

        $messagesNoRead = Message::where('user_id', userConnect()->id)
            ->where('read', 'N')
            ->get();

        $messagesRead = Message::where('user_id', userConnect()->id)
            ->where('read', 'y')
            ->get();

        return view('web.adminUser.message.listMessage', compact('messagesNoRead', 'messagesRead'));
    }

    public function responseMessage(ResponseMailClientRequest $request, $id)
    {
        $message = Message::find($id);

        $this->authorize('ownerMessage', $message);

        $message->response = $request['response'];
        $message->save();

        $message->read = 'Y';
        $message->save();

        $service = Service::where('user_id', userConnect()->id)
            ->first();

        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'messageResponse' => $request['response'],
            'title' => $service->title,
        ];

        Mail::to($message->email)->send(new ResponseServiceMail($data));

        LaravelFlash::withInfo('Mensaje enviado correctamente');
        return back();
    }

    public function deleteMessage($id)
    {
        $messages = Message::find($id);

        $this->authorize('ownerMessage', $messages);

        $messages->delete();

        LaravelFlash::withInfo('Mensaje eliminado correctamente');
        return back();
    }
}
