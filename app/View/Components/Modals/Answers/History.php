<?php

namespace App\View\Components\Modals\Answers;

use App\Models\Answer;
use App\Models\EvaluationHistory;
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
            'evaluationsHistory'=>$this->evaluationsHistoryList()
        ]);
    }


    public function evaluationsHistoryList(){
        $answersEvaluationsHistory = [];

        foreach($this->repository->evaluationsHistory()->orderBy('id','desc')->get() as $evaluationHistoryItem){
            $answerHistoryObject = $evaluationHistoryItem->answersHistory()->where('question_id',$this->answer->question_id)->first();


            if($answerHistoryObject !== NULL && $answerHistoryObject->observationHistory !== NULL){
                $userRoleValidation = auth()->user()->hasRole('usuario') && !$answerHistoryObject->observationHistory->is_deleted;
                $otherRolesValidation = !auth()->user()->hasRole('usuario');

                if($userRoleValidation || $otherRolesValidation){
                    $answersEvaluationsHistory[] = $answerHistoryObject;
                }
            }
        }

        return $answersEvaluationsHistory;
    }
}
