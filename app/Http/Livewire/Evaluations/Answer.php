<?php

namespace App\Http\Livewire\Evaluations;

use App\Models\Category;
use App\Models\Evaluation;
use Livewire\Component;

class Answer extends Component
{
    public $evaluation;
    public $category;

    public function mount(Evaluation $evaluation, Category $category)
    {
        $this->evaluation = $evaluation;
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.evaluations.answer');
    }
}
