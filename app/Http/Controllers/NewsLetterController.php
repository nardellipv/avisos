<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddNewsLetterRequest;
use App\NewsLetter;
use Jambasangsang\Flash\Facades\LaravelFlash;

class NewsLetterController extends Controller
{
    public function addEmail(AddNewsLetterRequest $request)
    {
        NewsLetter::create([
            'name' => $request['name'],
            'email' => $request['email'],
        ]);

        LaravelFlash::withInfo('Gracias por suscribirte!');
        return back();
    }
}
