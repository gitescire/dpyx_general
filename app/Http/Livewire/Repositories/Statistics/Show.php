<?php

namespace App\Http\Livewire\Repositories\Statistics;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Repository;
use App\Models\Subcategory;
use App\Models\AnswerHistory;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Show extends Component
{
    public $repository;
    public $answers;
    public $categories;
    public $subcategories;

    public function mount(Repository $repository)
    {
        $this->repository = $repository->append('qualification');
        $this->answers = $repository->evaluation->answers;
        $this->categories = Category::has('questions')->with('questions')->get();
        $this->subcategories = Subcategory::get();


        foreach ($this->categories as $category) {
            foreach ($category->questions as $question) {
                $question->answer = Answer::where('question_id', $question->id)->where('evaluation_id', $repository->evaluation->id)->with('choice')->first();
                $question->append('max_punctuation');
            }
        }
    }

    public function render()
    {
        return view('livewire.repositories.statistics.show',[
            'question_statistics' => $this->answersHistoryStatistics()
        ]);
    }

    public function answersHistoryStatistics(){
        $answerHistoryList = AnswerHistory::has('observationHistory')
        ->select("question_id",DB::Raw("COUNT('question_id') as repeated"))
        ->groupBy('question_id')
        ->orderBy('repeated','DESC')
        ->whereHas('evaluationHistory',function($evaluationHistory){
            $evaluationHistory->where('repository_id',$this->repository->id);
        })
        ->with(['question'=>function($question){
            $question->with(['category','subcategory']);
        }])->get();

        return $answerHistoryList;
    }
}
