<?php

namespace App\Http\Controllers\Observations;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Observation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class StoreObservationController extends Controller
{
    public function __invoke(Request $request)
    {

        // dd($answer->id);

        $observation = Observation::updateOrCreate([
            'answer_id' => $request->answer_id
        ], [
            'answer_id' => $request->answer_id,
            'description' => $request->description
        ]);

        if($request->hasFile('files')){

            foreach($request->file('files') as $image){
                $fileName   = time() . '.' . $image->getClientOriginalExtension();

                $path = Storage::disk('public')->putFileAs(
                    'observations', $image, $fileName
                );

                $currentFiles = $observation->files_paths;
                $newFile['file_name'] = $fileName;
                $newFile['url'] = getenv('APP_URL').'/storage\/'.$path;
                $currentFiles[] = $newFile;
                $observation->files_paths = $currentFiles;

            }

        }

        $observation->save();

        Alert::success('¡Observación creada!');
        return redirect()->back();


    }
}
