<?php

namespace App\Http\Controllers\adminSite;

use App\Http\Controllers\Controller;
use App\Mail\NotificationCreatedMail;
use App\Notification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

        $users = User::all();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new NotificationCreatedMail($user));
        }
        
        LaravelFlash::withInfo('Notificación Creada');
        return back();
    }
}
