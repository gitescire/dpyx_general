<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    public $roles;

    public function mount(){
        $this->roles = Role::get();
    }

    public function render()
    {
        return view('livewire.users.create');
    }
}
