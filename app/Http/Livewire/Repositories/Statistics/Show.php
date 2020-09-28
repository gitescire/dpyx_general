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
        $this->categories = Category::with('questions')->get();

        foreach ($this->categories as $category) {
            foreach ($category->questions as $question) {
                $question->answer = Answer::where('question_id', $question->id)->where('evaluation_id', $repository->evaluation->id)->with('choice')->first();
                $question->append('max_punctuation');
            }
        }
    }

    public function render()
    {
        return view('livewire.repositories.statistics.show');
    }
}
