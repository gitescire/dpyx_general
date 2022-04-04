<?php

namespace App\Http\Controllers\Evaluations;

use App\Events\EvaluationFinishedEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AnswerHistory;
use App\Models\Evaluation;
use App\Models\EvaluationHistory;
use App\Synchronizers\AnswerSynchronizer;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SendEvaluationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Evaluation $evaluation)
    {
        event(new EvaluationFinishedEvent($evaluation));

        // $isEvaluatorRole = Auth::user()->hasRole('evaluador') || Auth::user()->hasRole('admin');
        $evaluation->status = "en revisión";
        $evaluation->save();

        $evaluationHistory = EvaluationHistory::create([
            'evaluator_id' => $evaluation->evaluator_id,
            'repository_id' => $evaluation->repository->id,
            'status' => 'en revisión',
            'comments' => 'Repositorio enviado por el responsable',
            'repository_status' => 'en progreso'
        ]);
        $evaluation->repository->status = 'en progreso';
        $evaluation->repository->comments = 'Repositorio enviado por el responsable';
        $evaluation->repository->save();
        // if($isEvaluatorRole){
        // }
        // else{
        //     $evaluationHistory = EvaluationHistory::create([
        //         'repository_id' => $evaluation->repository->id,
        //         'evaluator_id' => $evaluation->evaluator_id,
        //         'status' => 'contestada',
        //         'comments' => 'Repositorio enviado por el responsable',
        //         'repository_status' => 'en progreso'
        //     ]);
        //     $evaluation->repository->status = 'en progreso';
        //     $evaluation->repository->comments = 'Repositorio enviado por el responsable';
        //     $evaluation->repository->save();
        // }

        foreach ($evaluation->answers as $answer) {
            (new AnswerSynchronizer($answer))->execute();

            $answerHistory = new AnswerHistory;
            $answerHistory->choice_id = $answer->choice_id;
            $answerHistory->question_id = $answer->question_id;
            $answerHistory->evaluation_history_id = $evaluationHistory->id;
            $answerHistory->description = $answer->description;
            $answerHistory->save();
        }
        // if($isEvaluatorRole){
        // }


        Alert::success('¡La evaluación ha sido enviada para su revisión!');
        return redirect()->route('repositories.index');
    }
}
