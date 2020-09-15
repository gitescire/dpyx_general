<?php

namespace App\Http\Livewire\Repositories;

use App\Models\Repository;
use Livewire\Component;

class Index extends Component
{
    private $repositories;

    public function render()
    {
        $this->repositories = Repository::get();
        return view('livewire.repositories.index', [
            'repositories' => $this->repositories
        ]);
    }
}
