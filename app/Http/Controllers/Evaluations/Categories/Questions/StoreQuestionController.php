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

        

        // $nextCategory = Category::where('id', '>', $category->id)->first() ?? $category;
        // if ($nextCategory == $category && $evaluation->is_answered) {
        //     Alert::success('¡Has finalizado la evaluación!','Ya puedes enviarla a concytec para su revisión');
        // } else {
        //     Alert::success('¡Preguntas guardadas, continúa contestando!');
        // }

        return redirect()->route('evaluations.categories.questions.index', [$evaluation, $nextCategory]);
    }
}
