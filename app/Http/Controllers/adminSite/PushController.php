<?php

namespace App\Http\Controllers\adminSite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use KCE\OneSignal\Facades\OneSignalClient;

class PushController extends Controller
{
    public function writeNotify()
    {
        return view('admin.notify.sendNotify');
    }

    public function send(Request $request)
    {
        $push = OneSignalClient::setTitle($request->title)
            ->setUrl($request->url)
            ->sendToAll($request->text);

        toast()->success('Notificacion enviada');
        return back();
    }
}
