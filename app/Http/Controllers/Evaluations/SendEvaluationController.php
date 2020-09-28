<?php

namespace App\Http\Controllers\Evaluations;

use App\Events\EvaluationFinishedEvent;
use App\Http\Controllers\Controller;
use App\Models\Evaluation;
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

        $evaluation->status = "in review";
        $evaluation->save();

        $evaluation->repository->status = null;
        $evaluation->repository->save();

        Alert::success('¡La evaluación ha sido enviada para su revisión!');
        return redirect()->back();
    }
}
