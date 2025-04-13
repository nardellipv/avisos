<?php

namespace App\Http\Controllers\adminSite;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AllUsersExport;
use App\Exports\AnunciantesExport;
use App\Exports\ClientesExport;

class ExportController extends Controller
{
    public function exportAllUsers()
    {
        return Excel::download(new AllUsersExport, 'users.xlsx');
    }

    public function exportAnnun()
    {
        return Excel::download(new AnunciantesExport, 'anunciantes.xlsx');
    }

    public function exportClient()
    {
        return Excel::download(new ClientesExport, 'clientes.xlsx');
    }
}
