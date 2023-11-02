<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Home extends Component
{

    public $name = "ozgun";

    public function render()
    {


        return view('livewire.home');
    }
}
