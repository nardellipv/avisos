<?php

namespace App\Http\Controllers\adminUser;

use App\Http\Controllers\Controller;
use App\Message;
use App\Service;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function listMessage()
    {
        $service = Service::where('user_id', userConnect()->id)
            ->first();

        if ($service) {
            $messages = Message::where('service_id', $service->id)
                ->get();
        }else{
            $messages = 0;
        }

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
