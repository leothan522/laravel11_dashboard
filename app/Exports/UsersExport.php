<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithTitle;

class UsersExport implements FromView, WithTitle, WithProperties, ShouldAutoSize
{

    public function __construct($keyword = null)
    {
        $this->keyword = $keyword;
    }

    public function view(): View
    {
        // TODO: Implement view() method.
        $usuarios = User::buscar($this->keyword)->orderBy('created_at', 'ASC')->get();
        return view('dashboard._export.export_excel_usuarios')
            ->with('users', $usuarios);
    }

    public function properties(): array
    {
        // TODO: Implement properties() method.
        return [
            'creator'        => 'Sistema Proyecto',
            'lastModifiedBy' => Auth::user()->name,
            'title'          => 'Usuarios Registrados',
            'company'        => 'Proyecto',
        ];
    }

    public function title(): string
    {
        // TODO: Implement title() method.
        return "Usuarios Registrados";
    }
}
