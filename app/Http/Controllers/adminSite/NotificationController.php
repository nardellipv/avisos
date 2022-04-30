<?php

namespace App\Http\Controllers\adminSite;

use App\Http\Controllers\Controller;
use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function listNotification()
    {
        $notifications = Notification::all();

        return view('web.adminUser.notification.listNotification', compact('notifications'));
    }

    public function createNotification(Request $request)
    {
        Notification::create([
            'title' => $request['title'],
            'body' => $request['body'],
            'date' => $request['date'],
        ]);

        toast()->success('Notificación Creada');
        return back();
    }
}
