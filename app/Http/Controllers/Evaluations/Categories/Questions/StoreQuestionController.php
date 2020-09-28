<?php

namespace App\Http\Controllers\Evaluations\Categories\Questions;

use App\Events\EvaluationFinishedEvent;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Evaluation;
use App\Models\Question;
use App\Models\Choice;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StoreQuestionController extends Controller
{
    public function __invoke(Request $request, Evaluation $evaluation, Category $category)
    {

        foreach ($request->choices as $choice_id) {
            $choice = Choice::find($choice_id);

            Answer::updateOrCreate([
                'evaluation_id' => $evaluation->id,
                'question_id' => $choice->question_id
            ], [
                'choice_id' => $choice->id,
                'question_id' => $choice->question_id,
                'evaluation_id' => $evaluation->id,
                'description' => isset($request->descriptions[$choice->question_id]) ? $request->descriptions[$choice->question_id] : null,
            ]);
        }

        if ($evaluation->answers->count() == Question::get()->count()) {
            $evaluation->status = 'answered';
            $evaluation->save();
        }

        $nextCategory = Category::where('id', '>', $category->id)->first() ?? $category;

        if ($nextCategory == $category && $evaluation->is_answered) {
            Alert::success('¡Has finalizado la evaluación!','Ya puedes enviarla a concytec para su revisión');
        } else {
            Alert::success('¡Preguntas guardadas, continúa contestando!');
        }

        return redirect()->route('evaluations.categories.questions.index', [$evaluation, $nextCategory]);
    }
}
