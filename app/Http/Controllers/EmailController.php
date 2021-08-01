<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactMailRequest;
use App\Http\Requests\ResponseSerivceMailResquest;
use App\Mail\ContactMail;
use App\Mail\ResponseServiceMail;
use App\Service;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function contactMail(ContactMailRequest $request)
    {
        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'message-client' => $request['message-client'],
        ];

        Mail::to('info@avisosmendoza.com.ar')->send(new ContactMail($data));

        toast()->info('El mensaje se envió correctamente');
        return back();
    }


    public function contactServiceMail(ContactMailRequest $request)
    {
        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'message-client' => $request['message-client'],
        ];
    }

    public function responseMessageSendEmail(ResponseSerivceMailResquest $request)
    {
        $service = Service::where('user_id', userConnect()->id)
            ->first();

        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'messageResponse' => $request['messageResponse'],
            'title' => $service->title,
        ];

        Mail::to($data['email'])->send(new ResponseServiceMail($data));

        toast()->info('El mensaje se envió correctamente');
        return back();
    }
}
