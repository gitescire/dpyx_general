<?php

namespace App\View\Components\modals\Questions;

use App\Models\Question;
use Illuminate\View\Component;

class Delete extends Component
{

    public $question;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.modals.questions.delete');
    }
}
