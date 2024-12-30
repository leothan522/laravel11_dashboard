<?php

namespace App\Livewire\Dashboard;

use App\Models\Parametro;
use App\Models\User;
use App\Traits\ToastBootstrap;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class RolesComponent extends Component
{
    use ToastBootstrap;

    public $title = "Nuevo Rol", $verPermisos = false;
    public $getPermisos, $tabla = 'parametros', $cambios = false;
    public $nombre;

    #[Locked]
    public $roles_id, $users_id;

    public function render()
    {
        $parametros = Parametro::where('tabla_id', -1)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('livewire.dashboard.roles-component')
            ->with('listarRoles', $parametros);
    }

    public function limpiar()
    {
        $this->reset([
            'title', 'verPermisos', 'tabla',
            'nombre',
            'roles_id', 'users_id'
        ]);
        $this->resetErrorBag();
    }

    public function save()
    {
        $rules = [
            'nombre' => ['required', 'min:4', 'max:12', Rule::unique('parametros', 'nombre')->ignore($this->roles_id)]
        ];
        $this->validate($rules);

        if ($this->roles_id){
            //editar
            $parametro = Parametro::find($this->roles_id);
        }else{
            //nuevo
            $parametro = new Parametro();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Parametro::where('rowquid', $rowquid)->first();
            }while($existe);
            $parametro->rowquid = $rowquid;
            $parametro->tabla_id = -1;
        }

        if ($parametro){
            $parametro->nombre = $this->nombre;
            $parametro->save();
            $this->show($parametro->rowquid);
            $this->dispatch('selectRoles')->to(UsuariosComponent::class);
            $this->toastBootstrap();
        }
    }

    public function show($rowquid)
    {
        $this->limpiar();
        $this->reset(['getPermisos', 'cambios']);
        $parametro = Parametro::where('rowquid', $rowquid)->first();
        if ($parametro){
            $this->title = "Editar Rol";
            $this->roles_id = $parametro->id;
            $this->nombre = $parametro->nombre;
            $this->verPermisos = true;
            if (json_decode($parametro->valor) || empty($parametro->valor)){
                $this->getPermisos = $parametro->valor;
            }
        }
    }

    public function setPermisos($permiso)
    {
        $permisos = [];
        if (!leerJson($this->getPermisos, $permiso)){
            $permisos = json_decode($this->getPermisos, true);
            $permisos[$permiso] = true;
            $permisos = json_encode($permisos);
        }else{
            $permisos = json_decode($this->getPermisos, true);
            unset($permisos[$permiso]);
            $permisos = json_encode($permisos);
        }
        $this->getPermisos = $permisos;
        $this->cambios = true;
    }

    public function savePermisos(){
        if ($this->tabla == "parametros"){
            $rol = Parametro::find($this->roles_id);
            if ($rol){
                $rol->valor = $this->getPermisos;
                $rol->save();
                $usuarios = User::where('roles_id', $rol->id)->get();
                foreach ($usuarios as $user){
                    $user->permisos = $this->getPermisos;
                    $user->save();
                }
                $this->reset('cambios');
                $this->toastBootstrap('success', 'Permisos Guardados.');
            }
        }else{
            $user = User::find($this->users_id);
            if ($user){
                $user->permisos = $this->getPermisos;
                $user->save();
                $this->reset('cambios');
                $this->toastBootstrap('success', 'Permisos Guardados.');
            }
        }
    }

    public function cancel()
    {
        $this->limpiar();
    }

    #[On('deleteRole')]
    public function deleteRole()
    {
        $row = Parametro::find($this->roles_id);
        if ($row){
            //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
            $vinculado = false;
            $usuarios = User::where('roles_id', $row->id)->first();
            if ($usuarios){
                $vinculado = true;
            }
            if ($vinculado) {
                $this->htmlToastBoostrap();
            } else {
                $nombre = '<b class="text-warning text-uppercase">'.$row->nombre.'</b>';
                $row->delete();
                $this->limpiar();
                $this->dispatch('selectRoles')->to(UsuariosComponent::class);
                $this->toastBootstrap('success', "Rol $nombre Eliminado.");
            }
        }
    }

    #[On('showPermisos')]
    public function showPermisos($rowquid)
    {
        $this->limpiar();
        $this->reset(['getPermisos', 'cambios']);
        $user = User::where('rowquid', $rowquid)->first();
        if ($user){
            $this->users_id = $user->id;
            if (json_decode($user->permisos) || empty($user->permisos)){
                $this->getPermisos = $user->permisos;
            }
            $this->tabla = 'usuarios';
            $this->verPermisos = true;
        }
    }

    #[On('initModal')]
    public function initModal()
    {
        $this->limpiar();
    }

}
