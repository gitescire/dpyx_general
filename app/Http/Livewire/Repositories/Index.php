<?php

namespace App\Http\Livewire\Repositories;

use App\Models\Repository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    private $repositories;

    public function render()
    {
        $this->handleRepositories();
        return view('livewire.repositories.index', [
            'repositories' => $this->repositories
        ]);
    }

    protected function handleRepositories(){
        if(Auth::user()->is_admin){
            $this->repositories = Repository::paginate(10);
        }else if(Auth::user()->is_evaluator){
            $this->repositories = Repository::whereHas('evaluation', function($query){
                return $query->where('evaluator_id',Auth::user()->id);
            })->paginate(10);
        }else{
            $this->repositories = Auth::user()->repositories()->paginate(10);
        }
    }
}
