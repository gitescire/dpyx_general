<?php

namespace App\Http\Controllers\Observations;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreObservationRequest;
use App\Models\Observation;
use App\Models\ObservationHistory;
use App\Services\ObservationService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class StoreObservationController extends Controller
{
    public function __invoke(StoreObservationRequest $request)
    {
        $oldComment = Observation::where('answer_id',$request->answer_id)->first();
        $newComment = $request->description;

        $observation = Observation::updateOrCreate([
            'answer_id' => $request->answer_id
        ], [
            'answer_id' => $request->answer_id,
            'description' => $newComment ?? ''
        ]);

        if(!$observation->wasRecentlyCreated && $observation->wasChanged()){
            ObservationHistory::create([
                'answer_history_id' => $request->answer_id,
                'description' => "El mensaje '".$oldComment->description."' fue actualizado a '".$newComment."'",
                'files_path' => NULL
            ]);
        }

        //
        (new ObservationService)($observation)->removeFiles($request->filesToDelete);

        //
        if ($request->hasFile('files')) {
            // TODO store files with their original and time name instied of only time
            (new ObservationService)($observation)->storeFiles($request->file('files'));
        }

        $observation->save();

        Alert::success('¡Observación creada!');
        return redirect()->route('evaluations.categories.questions.index', [$observation->answer->evaluation, $observation->answer->question->category]);
    }
}
