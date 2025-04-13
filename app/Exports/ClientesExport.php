<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ClientesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return User::where('type', 'Cliente')->get();
    }

    public function map($user): array
    {
        return [
            $user->name,
            $user->lastname,
            $user->email,
        ];
    }

    public function headings(): array
    {
        return ['Name', 'LastName', 'Email'];
    }
}
