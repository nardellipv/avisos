<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('📩 Webhook MercadoPago recibido:', [
            'headers' => $request->headers->all(),
            'body' => $request->all(),
        ]);

        return response()->json(['status' => 'ok'], 200);
    }
}
