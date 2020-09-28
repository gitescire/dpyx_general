<?php

namespace App\Http\Livewire\Questions;

use App\Models\Question;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    private $questions;

    public function render()
    {
        $this->questions = Question::paginate(10);
        return view('livewire.questions.index', [
            'questions' => $this->questions,
        ]);
    }
}
