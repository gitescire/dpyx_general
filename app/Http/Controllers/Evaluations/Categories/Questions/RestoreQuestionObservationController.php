<?php

namespace App\Http\Controllers\Evaluations\Categories\Questions;

use App\Http\Controllers\Controller;
use App\Models\AnswerHistory;
use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\ObservationHistory;
use RealRashid\SweetAlert\Facades\Alert;

class RestoreQuestionObservationController extends Controller
{
    public function __invoke(Request $request, Evaluation $evaluation, Int $observationHistoryId)
    {
        $anwerHistory = AnswerHistory::whereHas('observationHistory',function($q) use ($observationHistoryId){
            return $q->where('id',$observationHistoryId);
        })->first();
        $category = $anwerHistory->question->category;

        $observationHistory = ObservationHistory::find($observationHistoryId);
        $observationHistory->is_deleted=false;
        $observationHistory->save();

        Alert::success('¡Observación restaurada!');
        return redirect()->route('evaluations.categories.questions.index', [$evaluation, $category]);
    }
}
