<?php

namespace App\Http\Livewire\Repositories;

use App\Models\Category;
use App\Models\Evaluation;
use App\Models\Repository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $firstCategory;
    private $repositories;

    public $search = "";

    public function mount()
    {
        $this->firstCategory = Category::first();
    }

    public function render()
    {

        $this->handleRepositories();
        return view('livewire.repositories.index', [
            'repositories' => $this->repositories
        ]);
    }

    protected function handleRepositories()
    {
        $this->repositories = Repository::orderBy('id', 'desc');

        if ($this->search) {
            $this->repositories = $this->repositories->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('responsible', function ($query) {
                        return $query->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('evaluation', function ($query) {
                        return $query->whereHas('evaluators', function ($query) {
                            return $query->where('name', 'like', '%' . $this->search . '%');
                        });
                    });
            });
        }

        if (Auth::user()->is_admin) {
            $this->repositories = $this->repositories->paginate(10);
        } else if (Auth::user()->is_evaluator) {

            $this->repositories = $this->repositories->whereHas('evaluation', function ($query) {
                // return $query->where('evaluator_id', Auth::user()->id);
                return $query->whereHas('evaluators', function ($query) {
                    return $query->where('users.id', Auth::user()->id);
                });
            })->paginate(10);
        } else {
            $this->repositories = Auth::user()->repositories()->paginate(10);
        }
    }
}
