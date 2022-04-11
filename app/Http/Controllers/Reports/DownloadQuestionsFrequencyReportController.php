<?php

namespace App\Http\Controllers\Reports;

use App\Exports\QuestionsStatisticsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\AnswerHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DownloadQuestionsFrequencyReportController extends Controller
{
    public function __invoke()
    {
        $question_statistics=[];
        foreach($this->answersHistoryStatistics() as $question){
            $question_statistics[] = [
                'category' => $question->question->category()->first()->name,
                'subcategory' => $question->question->subcategory()->first()->name,
                'description' => $question->question->description,
                'frequency' => $question->repeated
            ];
        }

        return Excel::download(new QuestionsStatisticsExport($question_statistics), 'estadisticasPreguntas.xlsx');
    }

    public function answersHistoryStatistics(){
        $answerHistoryList = AnswerHistory::has('observationHistory')
        ->select("question_id",DB::Raw("COUNT('question_id') as repeated"))
        ->groupBy('question_id')
        ->orderBy('repeated','DESC')
        ->with(['question'=>function($question){
            $question->with(['category','subcategory']);
        }]);

        switch(true){
            case (Auth::user()->hasRole('evaluador')):
                $answerHistoryList = $answerHistoryList
                ->whereHas('evaluationHistory',function($evaluationHistory){
                    $evaluationHistory->where('evaluator_id',Auth::user()->id);
                })
                ->get();
                break;
            case (Auth::user()->hasRole('admin')):
                $answerHistoryList = $answerHistoryList
                ->get();
                break;
        }

        return $answerHistoryList;
    }
}
