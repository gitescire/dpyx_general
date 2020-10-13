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

        $this->handleEvaluationStatus($repository);

        Mail::to($repository->responsible->email)->send(new ReviewedRepositoryMail($repository, $request->comments));

        Alert::success('¡El repositorio ha sido enviado exitosamente!');
        return redirect()->route('dashboard');
    }

    private function handleEvaluationStatus($repository)
    {
        if ($repository->has_observations) {
            $repository->evaluation->status = 'contestada';
        } else {
            $repository->evaluation->status = 'revisado';
        }
        $repository->evaluation->save();
    }
}
