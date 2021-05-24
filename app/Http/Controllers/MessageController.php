<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageToServiceRequest;
use App\Mail\ContactServiceMail;
use App\Message;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function sendMessage(MessageToServiceRequest $request)
    {
        // dd($request->all());
        $message = Message::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'message' => $request['messageService'],
            'read' => 'N',
            'service_id' => $request['serviceUser'],
        ]);

        Mail::to($message['email'])->send(new ContactServiceMail($message));

        toastr()->info('El mensaje se envió correctamente');
        return back();
    }
}
