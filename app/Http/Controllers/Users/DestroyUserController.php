<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\Repository;
use App\Models\User;
use App\Services\EvaluationService;
use App\Services\EvaluatorService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DestroyUserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user)
    {
        $newEvaluator = User::find($request->newEvaluatorId);

        // dd($newEvaluator);

        if ($newEvaluator) {

            foreach ((new EvaluatorService)($user)->getAllEvaluations() as $evaluation) {
                // dd($evaluation->evaluators);

                (new EvaluationService)($evaluation)
                    ->addNewEvaluatorIfNotExist($newEvaluator);

            }
        }

        Repository::where('responsible_id', $user->id)->delete();
        $user->email = null;
        $user->save();
        $user->delete();

        Alert::success('¡Usuario eliminado!');
        return redirect()->back();
    }
}
