<?php

namespace App\Http\Controllers\Evaluations\Categories\Questions;

use App\Events\EvaluationFinishedEvent;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Evaluation;
use App\Models\Question;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StoreQuestionController extends Controller
{
    public function __invoke(Request $request, Evaluation $evaluation, Category $category)
    {
        foreach ($request->questions as $question_id => $punctuation) {
            Answer::updateOrCreate([
                'evaluation_id' => $evaluation->id,
                'question_id' => $question_id
            ], [
                'question_id' => $question_id,
                'evaluation_id' => $evaluation->id,
                'punctuation' => $punctuation,
                'description' => isset($request->descriptions[$question_id]) ? $request->descriptions[$question_id] : null,
            ]);
        }

        if($evaluation->answers->count() == Question::get()->count()){
            $evaluation->is_answered = 1;
            $evaluation->save();
        }

        $nextCategory = Category::where('id', '>', $category->id)->first() ?? $category;

        if($nextCategory == $category && $evaluation->is_answered){
            event( new EvaluationFinishedEvent($evaluation) );
            Alert::success('¡Tus respuestas han sido enviadas para su evaluación!');
        }else{
            Alert::success('¡Preguntas enviadas, continúa contestando!');
        }

        dd('ok');

        return redirect()->route('evaluations.categories.questions.index', [$evaluation, $nextCategory]);
    }
}
