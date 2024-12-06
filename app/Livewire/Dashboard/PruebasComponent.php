<?php

namespace App\Livewire\Dashboard;

use App\Traits\ToastBootstrap;
use Livewire\Attributes\On;
use Livewire\Component;

class PruebasComponent extends Component
{
    use ToastBootstrap;
    public function render()
    {
        return view('livewire.dashboard.pruebas-component');
    }

    public function btnPrueba()
    {
        $this->confirmToastBootstrap('prueba');
    }

    #[On('prueba')]
    public function prueba()
    {
        $this->htmlToastBoostrap();
    }


}
