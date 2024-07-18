<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecuperarRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class WebController extends Controller
{
    use LivewireAlert;

    public function recuperar($token, $email)
    {
        return view('web.reset-password')
            ->with('email', $email)
            ->with('token', $token);
    }

    public function reset(RecuperarRequest $request)
    {
        $hoy = Carbon::now()->format('Y-m-d H:t:s');
        $user = User::where('email', $request->email)->first();
        $id = $user->id;
        $token = $user->token_recuperacion;
        $times = $user->times_recuperacion;
        $user = User::find($id);
        if ($token == $request->token && $times){
            $times = Carbon::parse($times);
            $vencido = $times->diffInHours($hoy);
            //dd($vencido);
            if ($vencido > 0){
                $user->password = Hash::make($request->password);
                $type = 'success';
                $message = 'Su contraseña ha sido restablecida.';
            }else{
                $type = 'info';
                $message = 'Enlace de restablecimiento vencido.';
            }
        }else{
            $type = 'info';
            $message = 'Enlace de restablecimiento vencido.';
        }
        $user->token_recuperacion = null;
        $user->times_recuperacion = null;
        $user->save();
        $this->flash($type, $message, ['width' => '425']);
        return redirect()->route('web.index');
    }
}
