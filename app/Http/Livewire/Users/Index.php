<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    private $users;

    public function mount(){
        
    }

    public function render()
    {
        $this->users = User::paginate(10);
        return view('livewire.users.index',[
            'users' => $this->users
        ]);
    }
}
