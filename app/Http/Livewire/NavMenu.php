<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavMenu extends Component
{

    protected $listeners = [
        'refresh-nav-menu' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.nav-menu');
    }
}
