<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageToServiceRequest;
use App\Mail\ContactServiceMail;
use App\Message;
use App\Service;
use App\User;
use Illuminate\Support\Facades\Mail;
use Jambasangsang\Flash\Facades\LaravelFlash;

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
            'email' => $request['email'],
            'message' => $request['messageService'],
            'read' => 'N',
            'service_id' => $request['serviceUser'],
            'user_id' => $user->id,            
        ]);


        $data = [
            'title_service' => $service->title,
            'name_user' => $user->name,
            'email' => $user->email,
            'message' => $request['messageService'],
        ];

        Mail::to($user->email)->send(new ContactServiceMail($data));

        LaravelFlash::withInfo('El mensaje se envió correctamente. La respuesta llegará a tu email, revisá la carpeta SPAM');
        return back();
    }
}
