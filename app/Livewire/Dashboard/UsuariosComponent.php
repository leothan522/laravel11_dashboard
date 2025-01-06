<?php

namespace App\Livewire\Dashboard;

use App\Models\Parametro;
use App\Models\User;
use App\Traits\LimitRows;
use App\Traits\ToastBootstrap;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class UsuariosComponent extends Component
{
    use ToastBootstrap;
    use LimitRows;

    public $keyword, $title = "Crear Usuario", $btnNuevo = true, $form = false;
    public $name, $email, $password, $role, $newPassword, $btnEditar = false;
    public $verName, $verEmail, $verEstatus, $verRegistro, $verRole, $estatus, $btnEstatus, $btnReset, $verEditar, $verBorrar;
    public $listarRoles = [];
    public bool $ocultarTable = false, $ocultarCard = true;

    #[Locked]
    public $users_id, $rowquid;


    public function mount()
    {
        $this->setLimit();
        $this->listarRoles = $this->getRoles();
        $this->show($this->getLastUser());
    }

    public function render()
    {
        $usuarios = User::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->limit)
            ->get();
        $limit = $usuarios->count();
        $rows = User::buscar($this->keyword)->count();
        $this->btnVerMas($limit, $rows);

        return view('livewire.dashboard.usuarios-component')
            ->with('listarUsuarios', $usuarios)
            ->with('rows', $rows);
    }

    public function limpiar()
    {
        $this->reset([
            'title', 'btnNuevo', 'form',
            'name', 'email', 'password', 'role', 'newPassword', 'btnEditar',
            'users_id',
        ]);
        $this->resetErrorBag();
    }

    public function create()
    {
        $this->limpiar();
        $this->listarRoles = $this->getRoles();
        $this->btnNuevo = false;
        $this->form = true;
    }

    public function save()
    {
        $rules = [
            'name' => 'required|min:4',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->users_id)],
            'password' => [Rule::requiredIf(!$this->users_id), 'nullable','min:8'],
            'role' => 'required'
        ];
        $messages = [];
        $this->validate($rules, $messages);

        if ($this->users_id){
            //editar
            $user = User::find($this->users_id);
        }else{
            $user = new User();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = User::where('rowquid', $rowquid)->first();
            }while($existe);
            $user->rowquid = $rowquid;
            $user->password = \Hash::make($this->password);
        }

        if ($user){
            $user->name = $this->name;
            $user->email = $this->email;
            $parametro = $this->getRol($this->role);
            if ($parametro){
                if ($parametro->tabla_id == -2){
                    $user->role = intval($parametro->valor) ?? 0;
                    $user->roles_id = null;
                    $user->permisos = null;
                }else{
                    $user->role = 2;
                    $user->roles_id = $parametro->id;
                    $user->permisos = $parametro->valor;
                }
            }
            $user->save();
            $this->show($user->rowquid);
            $this->toastBootstrap();
        }
    }

    public function show($rowquid)
    {
        $this->limpiar();
        $user = $this->getUser($rowquid);
        if ($user){
            $this->verName = $user->name;
            $this->verEmail = $user->email;
            $this->verRole = verRole($user->role, $user->roles_id);
            $this->verEstatus = $this->getEstatusUsuario($user->estatus);
            $this->verRegistro = haceCuanto($user->created_at);
            $this->estatus = $user->estatus;
            $this->btnEstatus = $this->getComprobarPermisos($user, 'dashboard.usuarios.estatus');
            $this->btnReset = $this->getComprobarPermisos($user, 'dashboard.usuarios.password');
            $this->verEditar = $this->getComprobarPermisos($user);
            $this->verBorrar = $this->getComprobarPermisos($user, 'dashboard.usuarios.destroy');
            $this->users_id = $user->id;
            $this->rowquid = $user->rowquid;
            $this->name = $user->name;
            $this->email = $user->email;
            $role = $user->role;
            $roles_id = $user->roles_id;
            if ($role < 2){
                $parametro = Parametro::where('tabla_id', -2)->where('valor', $role)->first();
            }else{
                $parametro = Parametro::find($roles_id);
            }
            if ($parametro){
                $this->role = $parametro->rowquid;
            }

        }
    }

    public function edit($rowquid = null)
    {
        $this->listarRoles = $this->getRoles();
        if (!empty($rowquid)){
            $this->show($rowquid);
        }else{
            $this->show($this->rowquid);
        }
        $this->title = "Editar Usuario";
        $this->btnEditar = true;
        $this->form = true;
    }

    #[On('delete')]
    public function delete($rowquid)
    {
        $user = $this->getUser($rowquid);
        if ($user){
            $nombre = '<b class="text-uppercase text-warning">'.$user->name.'</b>';
            $user->delete();
            $this->show($this->getLastUser());
            $this->toastBootstrap('success', "Usuario $nombre eliminado.");
        }
    }

    #[On('deleteHide')]
    public function deleteHide($rowquid)
    {
        $this->delete($rowquid);
        $this->ocultarCard = true;
        $this->ocultarTable = false;
    }

    #[On('buscar')]
    public function buscar($keyword)
    {
        $this->keyword = $keyword;
    }

    public function cerrarBusqueda()
    {
        $this->reset(['keyword']);
    }

    public function actualizar()
    {
        //refresh
    }

    public function cancel()
    {
        if ($this->rowquid){
            $this->show($this->rowquid);
        }else{
            $this->limpiar();
        }
    }

    public function getComprobarPermisos($user, $permiso = "dashboard.usuarios.edit"): bool
    {
        return (!comprobarPermisos($permiso) || $user->role == 100) || (!comprobarPermisos() && ($user->role == 100 || $user->role == 1)) || $user->id == auth()->id();
    }

    public function showHide($rowquid = null)
    {
        if ($rowquid){
            $this->ocultarTable = true;
            $this->ocultarCard = false;
            $this->show($rowquid);
        }else{
            $this->ocultarTable = false;
            $this->ocultarCard = true;
        }
    }

    public function editHide()
    {
        $this->ocultarCard = true;
        $this->ocultarTable = false;
        $this->edit();
    }

    public function generatePassword()
    {
        $this->password = \Str::password(8);
    }

    public function setEstatus()
    {
        $user = User::find($this->users_id);
        if ($user){
            if ($user->estatus){
                $user->estatus = 0;
                $message = "Usuario Suspendido.";
            }else{
                $user->estatus = 1;
                $message = "Usuario Activado.";
            }
            $user->save();
            $this->estatus = $user->estatus;
            $this->verEstatus = $this->getEstatusUsuario($user->estatus);
            $this->toastBootstrap('info', $message);
        }
    }

    public function resetPassword()
    {
        $user = User::find($this->users_id);
        if ($user){
            if (!$this->newPassword){
                $password = \Str::password(8);
            }else{
                $password = $this->newPassword;
            }
            $user->password = \Hash::make($password);
            $user->save();
            $this->newPassword = $password;
            $this->toastBootstrap('success', "Contraseña Restablecida.");
        }
    }

    public function getEstatusUsuario($i, $icon = null): string
    {
        if (is_null($icon)){
            $suspendido = "Suspendido";
            $activado = "Activo";
        }else{
            $suspendido = '<i class="fa fa-user-slash"></i>';
            $activado = '<i class="fa fa-user-check"></i>';
        }
        $status = [
            '0' => '<span class="text-danger">'.$suspendido.'</span>',
            '1' => '<span class="text-success">'.$activado.'</span>',
        ];
        return $status[$i];
    }

    #[On('selectRoles')]
    public function selectRoles()
    {
        $this->listarRoles = $this->getRoles();
    }

    protected function getLastUser(): string
    {
        $last = '';
        $user = User::orderBy('created_at', 'DESC')->first();
        if ($user){
            $last = $user->rowquid;
        }
        return $last;
    }

    protected function getRoles()
    {
        $parametro = Parametro::where('tabla_id', '-2')->get();
        if ($parametro->isEmpty()){
            $this->setRoles('Administrador', 1);
            $this->setRoles('Público', 0);
        }
        return Parametro::where('tabla_id', '-1')
            ->orWhere('tabla_id', -2)
            ->orderBy('valor', 'ASC')
            ->get();
    }

    protected function setRoles($nombre, $valor): void
    {
        $parametro = new Parametro();
        $parametro->nombre = $nombre;
        $parametro->tabla_id = -2;
        $parametro->valor = $valor;
        do{
            $rowquid =  generarStringAleatorio(16);
            $existe = Parametro::where('rowquid', $rowquid)->first();
        }while($existe);
        $parametro->rowquid = $rowquid;
        $parametro->save();
    }

    protected function getRol($rowquid): ?Parametro
    {
        return Parametro::where('rowquid', $rowquid)->first();
    }

    protected function getUser($rowquid): ?User
    {
        return User::where('rowquid', $rowquid)->first();
    }

}
