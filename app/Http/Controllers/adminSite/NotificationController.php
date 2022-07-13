<?php

namespace App\Http\Controllers\adminSite;

use App\Http\Controllers\Controller;
use App\Notification;
use Illuminate\Http\Request;
use Jambasangsang\Flash\Facades\LaravelFlash;

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

        LaravelFlash::withInfo('Notificación Creada');
        return back();
    }
}
