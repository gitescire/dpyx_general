<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class StoreAccountController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if($request->hasFile('file')){
            $image= $request->file('file');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs(
                'photos', $image, $fileName
            );
            $user->profile_photo_path = $path;
        }

        $user->save();

        Alert::success('¡Tu cuenta ha sido modificada exitosamente!');
        return redirect()->route('users.account');
    }
}
