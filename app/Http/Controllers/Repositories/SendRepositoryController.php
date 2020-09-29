<?php

namespace App\Http\Controllers\Repositories;

use App\Http\Controllers\Controller;
use App\Mail\ReviewedRepositoryMail;
use App\Models\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class SendRepositoryController extends Controller
{
    public function __invoke(Repository $repository, Request $request)
    {

        $repository->status = $request->status;
        $repository->save();

        if($repository->has_observations){
            $repository->evaluation->status = 'in progress';
            $repository->evaluation->save();
        }

        $comments = $request->comments;

        Mail::to($repository->responsible->email)->send(new ReviewedRepositoryMail($repository, $comments));

        Alert::success('¡El repositorio ha sido enviado exitosamente!');
        return redirect()->route('dashboard');
    }
}
