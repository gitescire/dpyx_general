<?php

namespace App\Http\Livewire\Users;

use App\Models\Evaluation;
use App\Models\Repository;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        $this->handleUsers();
        return view('livewire.users.index',[
            'users' => $this->users
        ]);
    }

    public function handleUsers(){
        if(Auth::user()->is_admin){
            $this->users = User::paginate(10);
        }else{
            $this->users = User::whereIn('id',Evaluation::where('evaluator_id',Auth::user()->id)->get()->pluck('evaluation.responsible.id')->flatten()->unique())->paginate(10);
        }
    }
}
