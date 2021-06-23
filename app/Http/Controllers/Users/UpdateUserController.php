<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\EvaluationService;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UpdateUserController extends Controller
{
    public function __invoke(UpdateUserRequest $request, User $user)
    {

        if ($request->change_password == 'on') {

            if (!Hash::check($request->current_password, $user->password)) {
                Alert::warning('La contraseña actual no coincide');
                return redirect()->back();
            }

            if ($request->new_password != $request->new_password_repeated) {
                Alert::warning('La contraseña nueva no coincide.');
                return redirect()->back();
            }

            $user->password = bcrypt($request->new_password);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        $newEvaluators = User::find($request->evaluators_id);

        $user->syncRoles($request->role);

        if ($user->hasRole('usuario') && $user->has_repositories) {
            $user->repositories()->first()->update([
                'name' => $request->repository_name,
                'responsible_id' => $user->id
            ]);

            $evaluationService = (new EvaluationService)($user->repositories()->first()->evaluation);

            foreach ($newEvaluators as $newEvaluator) {
                $evaluationService
                    ->addNewEvaluatorIfNotExist($newEvaluator);
            }
        }

        if ($user->hasRole('usuario') && !$user->has_repositories) {
            $repository = $user->repositories()->create([
                'name' => $request->repository_name,
                'responsible_id' => $user->id
            ]);

            $evaluation = $repository->evaluation()->create([
                'repository_id' => $repository->id,
            ]);

            $evaluationService = (new EvaluationService)($evaluation);

            foreach ($newEvaluators as $newEvaluator) {
                $evaluationService
                    ->addNewEvaluatorIfNotExist($newEvaluator)
                    ->updateCurrentEvaluator($newEvaluator);
            }
        }

        Alert::success('¡Usuario modificado!');
        return redirect()->route('users.index');
    }
}
