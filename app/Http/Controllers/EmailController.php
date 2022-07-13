<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactMailRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Jambasangsang\Flash\Facades\LaravelFlash;

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

        LaravelFlash::withInfo('El mensaje se envió correctamente');
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
}
