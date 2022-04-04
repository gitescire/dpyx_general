<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\EvaluationHistory;

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

        $user->syncRoles($request->role);

        if ($user->hasRole('usuario') && $user->has_repositories) {
            $user->repositories()->first()->update([
                'name' => $request->repository_name,
                'responsible_id' => $user->id
            ]);

            $oldEvaluator = $user->repositories()->first()->evaluation()->first()->evaluator()->first();
            $newEvaluator = User::find($request->evaluator_id);

            $user->repositories()->first()->evaluation()->update([
                'evaluator_id' => $request->evaluator_id
            ]);

            if($oldEvaluator->id != $newEvaluator->id){
                EvaluationHistory::create([
                    'evaluator_id' => $request->evaluator_id,
                    'repository_id' => $user->repositories()->first()->id,
                    'status' => 'en revisión',
                    'comments' => 'El evaluador '.$oldEvaluator->name.' fue cambiado por el nuevo evaluador '.$newEvaluator->name.'.',
                    'repository_status' => 'en progreso'
                ]);
            }
        }

        if ($user->hasRole('usuario') && !$user->has_repositories) {
            $repository = $user->repositories()->create([
                'name' => $request->repository_name,
                'responsible_id' => $user->id
            ]);

            $repository->evaluation()->create([
                'repository_id' => $repository->id,
                'evaluator_id' => $request->evaluator_id
            ]);
        }

        Alert::success('¡Usuario modificado!');
        return redirect()->route('users.index');
    }
}
