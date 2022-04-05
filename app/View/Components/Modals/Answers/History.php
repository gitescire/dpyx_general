<?php

namespace App\View\Components\Modals\Answers;

use App\Models\Answer;
use App\Models\ObservationHistory;
use Illuminate\View\Component;

class History extends Component
{

    public $answer;
    public $repository;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
        $this->repository = $this->answer->evaluation->repository;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.modals.answers.history',[
            'answersObservationsHistory'=>$this->answersObservationsHistory()
        ]);
    }


    public function answersObservationsHistory(){
        $answersObservationsHistory = ObservationHistory::whereHas(
            'answerHistory'
            ,function($answerHistory){
                $answerHistory->where('question_id',$this->answer->question_id);
            }
        )
        ->with('answerHistory')
        ->orderBy('id','desc')->get();

        return $answersObservationsHistory;
    }
}
