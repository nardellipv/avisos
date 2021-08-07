<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageToServiceRequest;
use App\Mail\ContactServiceMail;
use App\Message;
use App\Service;
use App\User;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function sendMessage(MessageToServiceRequest $request)
    {

        $service = Service::where('id', $request['serviceUser'])
            ->first();

        $user = User::where('id', $service->user_id)
            ->first();

        $message = Message::create([
            'name' => $request['name'],
            'email' => $user->email,
            'message' => $request['messageService'],
            'read' => 'N',
            'service_id' => $request['serviceUser'],
            'user_id' => $user->id,
        ]);

        Mail::to($message['email'])->send(new ContactServiceMail($message));

        toast()->info('El mensaje se envió correctamente');
        return back();
    }
}
