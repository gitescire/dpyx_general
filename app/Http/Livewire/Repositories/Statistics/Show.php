<?php

namespace App\Http\Livewire\Repositories\Statistics;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Repository;
use Livewire\Component;

class Show extends Component
{
    public $repository;
    public $answers;
    public $categories;

    public function mount(Repository $repository)
    {
        $this->repository = $repository->append('qualification');
        $evaluation = $repository->evaluation;
        $this->answers = $repository->evaluation->answers;
        $this->categories = Category::with(['questions.answers' => function($query) use($evaluation){
            $query->where('evaluation_id',$evaluation->id);
        }])->get();
    }

    public function render()
    {
        return view('livewire.repositories.statistics.show');
    }
}
