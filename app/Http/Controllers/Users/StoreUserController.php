<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use App\Services\EvaluationService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StoreUserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StoreUserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->name = $request->name;
        $user->save();

        $user->assignRole($request->role);

        if ($user->hasRole('usuario')) {
            $repository = $user->repositories()->create([
                'name' => $request->repository_name,
                'responsible_id' => $user->id
            ]);
            $evaluation = $repository->evaluation()->create([
                'repository_id' => $repository->id,
            ]);

            $evaluationService = (new EvaluationService)($evaluation);
            foreach ($request->evaluators_id as $evaluator_id) {
                $evaluationService->addNewEvaluatorIfNotExist(User::find($evaluator_id));
            }


            // Create empty answers for each question
            Question::get()->each(function ($question) use ($evaluation) {
                Answer::create([
                    'evaluation_id' => $evaluation->id,
                    'question_id' => $question->id,
                    'is_updateable' => 1,
                ]);
            });
        }

        Alert::success('¡Usuario agregado!', 'El usuario ha sido añadido a la base de datos.');
        return redirect()->route('users.index');
    }
}
