<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddNewsLetterRequest;
use App\NewsLetter;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    public function addEmail(AddNewsLetterRequest $request)
    {
        NewsLetter::create([
            'name' => $request['name'],
            'email' => $request['email'],
        ]);

        toast()->info('Gracias por suscribirte!');
        return back();
    }
}
