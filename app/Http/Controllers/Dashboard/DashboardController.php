<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function pruebaGenerarPDF()
    {
        $user = Auth::user()->name;
        $fecha = Carbon::now()->format('d-m-Y');
        $data = [
            'user' => $user,
            'fecha' => $fecha
        ];
        $pdf = Pdf::loadView('dashboard._export.export_pdf_prueba', $data);
        return $pdf->stream('prueba.pdf');
    }

}
