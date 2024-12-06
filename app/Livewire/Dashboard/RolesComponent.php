<?php

namespace App\Livewire\Dashboard;

use App\Models\Parametro;
use App\Models\User;
use App\Traits\ToastBootstrap;
use Illuminate\Support\Sleep;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class RolesComponent extends Component
{
    use LivewireAlert;
    use ToastBootstrap;

    public $nombre, $tabla = "roles", $getPermisos, $cambios = false;

    #[Locked]
    public $roles_id, $rowquid;

    public function render()
    {
        return view('livewire.dashboard.roles-component');
    }

    public function limpiarRoles()
    {
        $this->reset([
            'roles_id', 'nombre', 'getPermisos', 'cambios', 'rowquid'
        ]);
    }

    #[On('save')]
    public function save($nombre = null)
    {
        if (!is_null($nombre)){

			$this->reset(['roles_id']);

            $nombre = mb_strtolower($nombre);

            $count = Parametro::where('tabla_id', -1)->count();
            if ($count >= 10){
                $this->toastBootstrap('info', 'El maximo de roles permitidos es 10');
                return [];
            }

        }else{
            $nombre = mb_strtolower($this->nombre);
        }

        if (empty($nombre) || strlen($nombre) <= 3) {
            $this->toastBootstrap('warning', 'El campo nombre es requerido min 4 caracteres.');
            return [];
        }

        if (strlen($nombre) >= 20) {
            $this->toastBootstrap('warning', 'El campo nombre solo puede tener 20 caracteres.');
            return [];
        }

        $existe = Parametro::where('nombre', $nombre)->where('tabla_id', -1)->first();
        if ($existe || $nombre == 'administrador' || $nombre == 'estandar'){
            $this->htmlToastBoostrap(null, ['type' => 'warning', 'message' => 'El rol <b class="text-danger">'.$nombre.'</b> ya existe.']);
            return [];
        }

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
        }

        if ($parametro){

            $parametro->nombre = $nombre;
            $parametro->tabla_id = -1;
            $parametro->save();

            if ($this->roles_id){
                $this->dispatch('setRolList', id:$parametro->rowquid, nombre:ucwords($parametro->nombre));
                $this->edit($parametro->rowquid);
                $this->toastBootstrap('success', 'Rol Actualizado.');
            }else{
                $this->dispatch('addRoleList', id:$parametro->rowquid, nombre:ucwords($parametro->nombre), rows:$count + 1);
                $this->limpiarRoles();
                $this->toastBootstrap('success', 'Rol Creado.');
            }

        }else{
            $parametros = Parametro::where('tabla_id', -1)->count();
            $this->dispatch('removeRolList', id: $this->roles_id, rows: $parametros - 1);
        }
    }

    #[On('edit')]
    public function edit($rowquid)
    {
        $this->limpiarRoles();
        $rol = $this->getRol($rowquid);
        if ($rol){
            $this->roles_id = $rol->id;
            $this->nombre = $rol->nombre;
            if (json_decode($rol->valor) || empty($rol->valor)){
                $this->getPermisos = $rol->valor;
            }else{
                $this->getPermisos = null;
            }
            $this->rowquid = $rol->rowquid;
            $this->reset('cambios');
        }else{
            $parametros = Parametro::where('tabla_id', -1)->count();
            $this->dispatch('removeRolList', id: $rowquid, rows: $parametros - 1);
        }
    }

    public function destroy($rowquid)
    {
        $this->rowquid = $rowquid;
        $this->confirmToastBootstrap('confirmedRol');
    }

    #[On('confirmedRol')]
    public function confirmedRol()
    {
        $parametros = Parametro::where('tabla_id', -1)->count();
        $row = $this->getRol($this->rowquid);
        if ($row){
            $id = $row->id;

            //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
            $vinculado = false;
            $usuarios = User::where('roles_id', $id)->first();
            if ($usuarios){
                $vinculado = true;
            }

            if ($vinculado) {
                $this->htmlToastBoostrap();
            } else {
                $row->delete();
                $this->dispatch('removeRolList', id: $this->rowquid, rows: $parametros - 1);
                $this->limpiarRoles();
                Sleep::for(500)->millisecond();
                $this->toastBootstrap('success', 'Rol Eliminado.');
            }
        }else{
            $this->dispatch('removeRolList', id: $this->rowquid , rows: $parametros - 1);
        }
    }

    #[On('addRolList')]
    public function addRoleList($id, $nombre, $rows)
    {
        //JS
    }

    #[On('setRolList')]
    public function setRolList($id, $nombre)
    {
        //JS
    }

    #[On('removeRolList')]
    public function removeRolList($id, $rows)
    {
        //JS
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
        $rol = Parametro::find($this->roles_id);
        if ($rol){
            $rol->valor = $this->getPermisos;
            $rol->save();
            $usuarios = User::where('roles_id', $rol->id)->get();
            foreach ($usuarios as $user){
                $usuario = User::find($user->id);
                $usuario->permisos = $this->getPermisos;
                $usuario->save();
            }
            $this->reset('cambios');
            $this->toastBootstrap('success', 'Permisos Guardados.');
        }else{
            $parametros = Parametro::where('tabla_id', -1)->count();
            $this->dispatch('removeRolList', id: $this->rowquid, rows: $parametros - 1);
        }
    }

    public function deletePermisos()
    {
        $this->reset('getPermisos');
        $this->cambios = true;
    }

    protected function getRol($rowquid): ?Parametro
    {
        return Parametro::where('rowquid', $rowquid)->first();
    }

}
