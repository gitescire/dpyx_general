<?php

namespace App\Http\Livewire\Repositories;

use App\Models\Category;
use App\Models\Repository;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    private $repositories;
    public $firstCategory;
    public $search = "";
    public $search_filter = "Sin filtro";
    public $evaluator_filter = 0;
    public $frequency_data = 0;
    public $evaluators_list;

    public function mount()
    {
        $this->firstCategory = Category::first();
    }

    public function render()
    {
        $this->evaluators_list = User::role('evaluador')->get();
        $this->handleRepositories();
        return view('livewire.repositories.index', [
            'repositories' => $this->repositories,
            'frequencuyData' => $this->frequency_data
        ]);
    }

    protected function handleRepositories()
    {
        switch ($this->search_filter){

            case 'Sin filtro':
                $this->repositories = Repository::orderBy('id', 'desc');
                break;
            case 'Filtrar en progreso':
                $this->repositories= Repository::where('repositories.status','=', 'en progreso')->orderBy('id', 'desc');
                break;
            case 'Filtrar en evaluacíon':
                $this->repositories= Repository::select('repositories.*', 'evaluations.status')
                     ->join('evaluations', 'repositories.id', '=', 'evaluations.id')
                     ->where('evaluations.status','=', 'en revisión')
                     ->orderBy('id', 'desc');
                break;
            case 'Filtrar con observaciónes':
                $this->repositories= Repository::where('repositories.status','=', 'observaciones')
                     ->orderBy('id', 'desc');
                break;
            case 'Filtrar aprobado':
                $this->repositories= Repository::where('repositories.status', '=', 'aprobado')
                ->orderBy('id', 'desc');
                break;
            case 'Filtrar rechazado':
                $this->repositories= Repository::where('repositories.status', '=', 'rechazado')
                     ->orderBy('id', 'desc');
                break;
        }

        if($this->evaluator_filter > 0){
            $this->repositories = $this->repositories->whereHas('evaluation', function ($query) {
                return $query->whereHas('evaluator', function ($query) { return $query->where('users.id', $this->evaluator_filter);});
            });
        }


        if ($this->search) {
            $this->repositories = $this->repositories->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('responsible', function ($query) {
                        return $query->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('evaluation', function ($query) {
                        return $query->whereHas('repository', function ($query) {
                            return $query->where('name', 'like', '%' . $this->search . '%');
                        });
                    });
            });
        }

        if(Auth::user()->is_admin) {
            $this->frequency_data = $this->repositories->count();
            $this->repositories = $this->repositories->paginate(10);

        } else if (Auth::user()->is_evaluator) {
            $repositoriesList = $this->repositories->whereHas('evaluation', function ($query) {
                return $query->whereHas('evaluator', function ($query) { return $query->where('users.id', Auth::user()->id);});
            });
            $this->frequency_data = $repositoriesList->count();
            $this->repositories = $repositoriesList->paginate(10);
        } else {
            $this->frequency_data = Auth::user()->repositories()->count();
            $this->repositories = Auth::user()->repositories()->paginate(10);
        }
    }
}
