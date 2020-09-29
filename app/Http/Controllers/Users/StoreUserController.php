<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
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
    public function __invoke(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->name = $request->name;
        $user->save();

        $user->assignRole($request->role);

        if($user->hasRole('usuario')){
            $repository = $user->repositories()->create([
                'name' => $request->repository_name,
                'responsible_id' => $user->id
            ]);
            $repository->evaluation()->create([
                'repository_id' => $repository->id,
                'evaluator_id' => $request->evaluator_id,
            ]);
        }

        Alert::success('¡Usuario agregado!', 'El usuario ha sido añadido a la base de datos.');
        return redirect()->route('users.index');
    }
}
