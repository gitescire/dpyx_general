<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UpdateUserController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        $user->syncRoles($request->role);

        if ($user->hasRole('usuario') && !$user->has_repositories) {
            $repository = $user->repositories()->create([
                'name' => $request->repository_name,
                'responsible_id' => $user->id
            ]);
            
            $repository->evaluation()->create([
                'repository_id' => $repository->id,
            ]);
        }

        Alert::success('¡Usuario modificado!');
        return redirect()->route('users.index');
    }
}
