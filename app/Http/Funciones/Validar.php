<?php
//Funciones Personalizadas para el Proyecto
use Illuminate\Support\Facades\Auth;

function comprobarPermisos($routeName = null)
{

    if (leerJson(Auth::user()->permisos, $routeName) || Auth::user()->role == 1 || Auth::user()->role == 100) {
        return true;
    } else {
        return false;
    }

}

function allPermisos()
{
    $dashboard = 'dashboard.';
    $permisos = [
        'Usuarios' => [
            'route' => $dashboard.'usuarios',
            'submenu' => [
                'Exportar Excel' => $dashboard.'usuarios.excel',
                'Suspender Usuarios' => $dashboard.'usuarios.estatus',
                'Restituir Contraseña' => $dashboard.'usuarios.password',
                'Crear Usuarios' => $dashboard.'usuarios.create',
                'Editar Usuarios' => $dashboard.'usuarios.edit',
                'Borrar Usuarios' => $dashboard.'usuarios.destroy',
            ]
        ],
    ];
    return $permisos;
}
