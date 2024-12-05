<?php

namespace App\Livewire\Dashboard;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class PruebasComponent extends Component
{
    use LivewireAlert;
    public function render()
    {
        return view('livewire.dashboard.pruebas-component');
    }

    public function btnPrueba()
    {
        $this->alert('success', 'hola mundo!');
    }


}
