<?php

namespace App\Http\Livewire\Evaluations\Categories\Questions;

use App\Models\Announcement;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Evaluation;
use App\Models\Question;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class Index extends Component
{
    public $evaluation;
    public $repository;
    public $categoryChoosed;
    public $categories;
    public $subcategories;
    public $answers;
    public $announcement;

    public function mount(Evaluation $evaluation, Category $category)
    {
        $this->evaluation = $evaluation->append('is_answerable');
        $this->repository = $this->evaluation->repository;
        $this->categoryChoosed = $category;
        $this->categories = Category::get();
        $this->announcement = Announcement::active()->first();

        $this->subcategories = Subcategory::with(['questions' => function ($query) {
            $query->where('category_id', $this->categoryChoosed->id)->with(['choices' => function ($query) {
                $query->orderBy('punctuation', 'desc');
            }]);
        }])
            ->get()
            ->append('has_questions');

        $this->subcategories->map(function ($subcategory) {
            return $subcategory->questions->map(function ($question) {
                $answer = Answer::where('evaluation_id', $this->evaluation->id)->where('question_id', $question->id)->with('choice','observation')->first();
                $question->answer = $answer;
                
                if($question->answer){
                    $question->answer->route = route('answers.show',[$question->answer]);
                }

                $question->is_answerable = $this->evaluation->is_answerable;

                if($this->evaluation->is_answerable && $this->evaluation->repository->has_observations && $question->answer && $question->answer->observation){
                    $question->is_answerable = true;
                }

                if($this->evaluation->is_answerable && $this->evaluation->repository->has_observations && $question->answer && !$question->answer->observation){
                    $question->is_answerable = false;
                }

                // $question->is_answerable = Auth::user()->id == $this->evaluation->repository->responsible->id
                //     && !$this->evaluation->repository->is_rejected
                //     && !$this->evaluation->repository->aproved 
                //     && ( (!$this->evaluation->in_review && !$question->answer) || ($question->answer && $question->answer->observation && $this->evaluation->repository->has_observations));
                return $question
                    ->append('max_punctuation');
            });
        });

        // $this->answers = Answer::where('evaluation_id', $evaluation->id)->get();
    }

    public function render()
    {
        return view('livewire.evaluations.categories.questions.index');
    }
}
