<?php

namespace App\Http\Livewire\Evaluations\Categories\Questions;

use App\Models\Announcement;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Choice;
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
    public $nextCategory;
    public $showComplementaryQuestions = false;

    public function mount(Evaluation $evaluation, Category $category)
    {
        $this->nextCategory = Category::where('id', '>', $category->id)->first() ?? $category;
        $this->evaluation = $evaluation->append('is_answerable');
        $this->repository = $this->evaluation->repository;
        $this->categoryChoosed = $category;
        $this->categories = Category::get();
        $this->announcement = Announcement::active()->first();
    }

    public function storeAnswer($question, $choice = null)
    {
        $choice = Choice::find($choice);
        $question = Question::find($question);
        if ($choice == null) {
            Answer::where('question_id', $question->id)->where('evaluation_id', $this->evaluation->id)->delete();
        } else {
            $answer = Answer::updateOrCreate([
                'evaluation_id' => $this->evaluation->id,
                'question_id' => $question->id,
            ], [
                'choice_id' => $choice->id,
                'question_id' => $question->id,
                'evaluation_id' => $this->evaluation->id,
            ]);
        }


        $requiredQuestionsIds = Question::required()->get()->pluck('id')->flatten();
        $requiredQuestionsAnswered = $this->evaluation->answers()->whereIn('question_id', $requiredQuestionsIds)->get();

        if ($requiredQuestionsIds->count() == $requiredQuestionsAnswered->count()) {
            $this->evaluation->status = 'answered';
            $this->evaluation->save();
        } else {
            $this->evaluation->status = 'in progress';
            $this->evaluation->save();
        }



        // $requiredQuestionsIds = Question::required()->get()->pluck('id')->flatten();
        // $requiredQuestionsAnswered = $this->evaluation->answers()->whereIn('question_id',$requiredQuestionsIds)->get();
        // if ($requiredQuestionsIds->count() == $requiredQuestionsAnswered->count()) {
        //     $this->evaluation->status = 'answered';
        //     $this->evaluation->save();
        // }
    }

    public function updateDescription(Answer $answer, $description)
    {
        $answer->description = $description;
        $answer->save();
    }

    public function render()
    {
        $this->subcategories = Subcategory::with(['questions' => function ($query) {
            $query->where('category_id', $this->categoryChoosed->id)->with(['choices' => function ($query) {
                $query->orderBy('punctuation', 'desc');
            }]);
        }])
            ->get()
            ->append('has_questions');

        $this->subcategories->map(function ($subcategory) {
            return $subcategory->questions->map(function ($question) {
                $answer = Answer::where('evaluation_id', $this->evaluation->id)->where('question_id', $question->id)->with('choice', 'observation')->first();
                $question->answer = $answer;

                if ($question->answer) {
                    $question->answer->route = route('answers.show', [$question->answer]);
                }

                $question->is_answerable = $this->evaluation->is_answerable;
                $question->status = $question->answer ? 'contestada' : 'pendiente';

                if ($this->evaluation->is_answerable && $this->evaluation->repository->has_observations && $question->answer && $question->answer->observation) {
                    $question->is_answerable = true;
                }

                if ($this->evaluation->is_answerable && $this->evaluation->repository->has_observations && $question->answer && !$question->answer->observation) {
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

        $this->subcategories->each(function($subcategory){
            $subcategory->total_required_punctuation = $subcategory->questions->where('is_optional',0)->pluck('answer.choice.punctuation')->flatten()->sum();
            $subcategory->total_supplementary_punctuation = $subcategory->questions->where('is_optional',1)->pluck('answer.choice.punctuation')->flatten()->sum();
            $subcategory->max_required_punctuation = $subcategory->questions->where('is_optional',0)->pluck('max_punctuation')->flatten()->sum();
            $subcategory->max_supplementary_punctuation = $subcategory->questions->where('is_optional',1)->pluck('max_punctuation')->flatten()->sum();
            // dd($subcategory->questions->where('is_optional',0)->pluck('answer.choice.punctuation')->sum()  );
        });

        // $this->answers = Answer::where('evaluation_id', $evaluation->id)->get();
        return view('livewire.evaluations.categories.questions.index');
    }

    public function toggleSupplementaryQuestions(){
        $this->showComplementaryQuestions = !$this->showComplementaryQuestions;
    }
}
