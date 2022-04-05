<?php

namespace App\Http\Livewire\Repositories\Statistics;

use App\Models\Answer;
use App\Models\AnswerHistory;
use App\Models\Category;
use App\Models\ObservationHistory;
use App\Models\Repository;
use App\Models\Subcategory;
use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class All extends Component
{
    public $repositories;
    public $subcategories;
    public $categories;

    public function mount()
    {
        $this->categories = Category::has('questions')->with('questions')->get();
        $this->repositories = Repository::get();
        $this->subcategories = Subcategory::get();

        foreach ($this->repositories as  $repository) {
            $repository->append('qualification');
        }

        foreach ($this->categories as $category) {
            foreach ($category->questions as $question) {
                $question->answers = Answer::where('question_id', $question->id)->with('choice')->get();
                $question->append('max_punctuation');
            }
        }
    }

    public function render()
    {
        set_time_limit(0);
        return view('livewire.repositories.statistics.all',[
            'question_statistics' => $this->answersHistoryStatistics(),
            'categories' => $this->categories,
            'subcategories' => $this->subcategories,
            'repositories' => $this->repositories
        ]);
    }

    public function answersHistoryStatistics(){
        $answerHistoryList = AnswerHistory::has('observationHistory')
        ->select("question_id",DB::Raw("COUNT('question_id') as repeated"))
        ->groupBy('question_id')
        ->orderBy('repeated','DESC')
        ->with(['question'=>function($question){
            $question->with(['category','subcategory']);
        }]);

        switch(true){
            case (Auth::user()->hasRole('evaluador')):
                $answerHistoryList = $answerHistoryList
                ->whereHas('evaluationHistory',function($evaluationHistory){
                    $evaluationHistory->where('evaluator_id',Auth::user()->id);
                })
                ->get();
                break;
            case (Auth::user()->hasRole('admin')):
                $answerHistoryList = $answerHistoryList
                ->get();
                break;
        }

        return $answerHistoryList;
    }
}
