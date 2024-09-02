<?php

namespace App\Livewire\Dashboard;

use App\Models\Fcm;
use App\Models\User;
use App\Services\FirebaseCloudMessagingService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Livewire\Attributes\On;
use Livewire\Component;

class FcmComponent extends Component
{
    use LivewireAlert;

    public $title, $body, $dispositivos = "todos", $tipo;

    public function render()
    {
        $users = Fcm::select('users_id')->groupBy('users_id')->get();
        return view('livewire.dashboard.fcm-component')
            ->with('listarUsers', $users);
    }

    public function limpiar()
    {
        $this->reset(['title', 'body', 'dispositivos', 'tipo']);
        $this->resetErrorBag();
    }

    protected $rules = [
        'title' => 'required|min:4',
        'body' => 'required|min:4',
        'dispositivos' => 'required',
    ];

    public function sendMessage()
    {
        $this->validate();
        try {

            $tokens = [];

            $messaging = FirebaseCloudMessagingService::connect();

            $notificacion = Notification::fromArray([
                'title' => $this->title,
                'body' => $this->body
            ]);

            $data = [
                'title' => $this->title,
                'body' => $this->body,
                'subText' => 'Administrador',
                'destino' => 0,
                'nombre' => 'Yonathan Castillo',
                'email' => 'leothan522@gmail.com',
                'cedula' => '20025623'
            ];

            if ($this->dispositivos != "todos") {

                $user = User::where('rowquid', $this->dispositivos)->first();
                if ($user){
                    $id = $user->id;
                    $tokens = Fcm::where('users_id', $id)->get();
                }

            } else {
                $tokens = Fcm::all();
            }

            foreach ($tokens as $token){
                if ($this->tipo == "notification"){
                    $message = CloudMessage::withTarget('token', $token->token)
                        ->withNotification($notificacion);
                }else{
                    $message = CloudMessage::withTarget('token', $token->token)
                        ->withData($data);
                }
                $messaging->send($message);
            }

            $this->alert('success', 'Mensaje enviado.');

        } catch (MessagingException|FirebaseException $e) {
            $this->alert('warning', '¡ERROR FCM!', [
                'position' => 'center',
                'timer' => '',
                'toast' => false,
                'text' => $e->getMessage(),
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'confirmButtonText' => 'OK',
            ]);
        }
    }

    #[On('tokenSeleccionado')]
    public function tokenSeleccionado($token)
    {
        $this->dispositivos = $token;
    }

}
