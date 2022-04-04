<?php

namespace App\Http\Controllers\Repositories;

use App\Http\Controllers\Controller;
use App\Mail\ReviewedRepositoryMail;
use App\Models\AnswerHistory;
use App\Models\Evaluation;
use App\Models\EvaluationHistory;
use App\Models\ObservationHistory;
use App\Models\Repository;
use App\Synchronizers\AnswerSynchronizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class SendRepositoryController extends Controller
{
    public function __invoke(Repository $repository, Request $request)
    {
        $repository->status = $request->status;
        $repository->comments = $request->comments;
        $repository->save();

        // if($repository->has_observations){
        // }
        $this->generateHistory($repository->evaluation,$request);

        $this->handleEvaluationStatus($repository,$request);

        foreach ($repository->evaluation->answers as $answer) {
            (new AnswerSynchronizer($answer))->execute();
        }


        Mail::to($repository->responsible->email)->send(new ReviewedRepositoryMail($repository, $request->comments));

        Alert::success( __("messages.Controllers.Repositories.SendRepositoryController.AlertSuccess") );
        return redirect()->route('repositories.index');
    }

    private function generateHistory(Evaluation $evaluation, Request $request)
    {
        $evaluationHistory = EvaluationHistory::create([
            'repository_id' => $evaluation->repository_id,
            'evaluator_id' => Auth::user()->id,
            'status' => ($request->status == 'observaciones' ? 'contestada' : (in_array($request->status,['aprobado','rechazado']) ? 'revisado' : 'en revisión')),
            'comments' => $request->comments,
            'repository_status' => $request->status
        ]);


        foreach ($evaluation->answers as $answer) {
            $answerHistory = AnswerHistory::create([
                'choice_id' => $answer->choice_id,
                'question_id' => $answer->question_id,
                'evaluation_history_id' => $evaluationHistory->id,
                'description' => $answer->description
            ]);

            if ($answer->observation) {
                ObservationHistory::create([
                    'answer_history_id' => $answerHistory->id,
                    'description' => $answer->observation->description,
                    'files_paths' => $answer->observation->files_paths
                ]);
            }
        }
    }

    private function handleEvaluationStatus($repository,$request)
    {
        if ($repository->has_observations) {
            $repository->evaluation->status = 'contestada';
        } else {
            $repository->evaluation->status = (in_array($request->status,['aprobado','rechazado']) ? 'revisado' : 'en revisión');
        }
        $repository->evaluation->save();
    }
}
