<?php

namespace App\Http\Controllers\adminSite;

use App\Http\Controllers\Controller;
use App\User;
use Rap2hpoutre\FastExcel\FastExcel;

class ExportController extends Controller
{
    public function exportAllUsers()
    {
        return (new FastExcel(User::all()))->download('users.xlsx', function ($user) {
            return [
                'Name' => $user->name,
                'LastName' => $user->lastname,
                'Email' => $user->email,
                'type' => $user->type,
            ];
        });

        return back();
    }

    public function exportAnnun()
    {
        return (new FastExcel(User::where('type', 'Anunciante')->get()))->download('anunciantes.xlsx', function ($user) {
            return [
                'Name' => $user->name,
                'LastName' => $user->lastname,
                'Email' => $user->email,
            ];
        });

        return back();
    }

    public function exportClient()
    {
        return (new FastExcel(User::where('type', 'Cliente')->get()))->download('clientes.xlsx', function ($user) {
            return [
                'Name' => $user->name,
                'LastName' => $user->lastname,
                'Email' => $user->email,
            ];
        });

        return back();
    }
}
