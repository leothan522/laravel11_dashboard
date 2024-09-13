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
                'Crear Usuarios' => $dashboard.'usuarios.create',
                'Editar Usuarios' => $dashboard.'usuarios.edit',
                'Suspender Usuarios' => $dashboard.'usuarios.estatus',
                'Reestablecer Contraseña' => $dashboard.'usuarios.password',
                'Descargar Excel' => $dashboard.'usuarios.excel',
                'Eliminar Usuarios' => $dashboard.'usuarios.destroy',
            ]
        ],
    ];
    return $permisos;
}
