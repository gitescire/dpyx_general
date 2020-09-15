<?php

namespace App\Http\Livewire\Evaluations;

use App\Models\Category;
use App\Models\Evaluation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class Assign extends Component
{
    public function mount($evaluationEncoded, $evaluatorEncoded)
    {
        $evaluation_id = base64_decode($evaluationEncoded);
        $evaluator_id = base64_decode($evaluatorEncoded);

        // dd($evaluationEncoded);
        // dd($evaluatorEncoded);

        $evaluation = Evaluation::find($evaluation_id);
        $user = User::find($evaluator_id);

        if ($evaluation->evaluator_id) {
            \RealRashid\SweetAlert\Facades\Alert::error('¡La evaluación solicitada ya cuenta con un evaluador!');
            return redirect()->route('welcome');
        }

        if (!$user->is_evaluator) {
            \RealRashid\SweetAlert\Facades\Alert::error('¡El usuario no es evaluador!');
            return redirect()->route('welcome');
        }

        $evaluation->evaluator_id = $evaluator_id;
        $evaluation->save();

        if(!Auth::check()){
            \RealRashid\SweetAlert\Facades\Alert::success('¡Inicia sesión para poder evaluar al usuario!');
            return redirect()->route('welcome');
        }
        
        if(Auth::check() && $evaluation->evaluator_id != Auth::user()->id){
            \RealRashid\SweetAlert\Facades\Alert::success('¡Inicia sesión con el usuario evaluador para poder revisar la evaluación!');
            return redirect()->route('welcome');
        }

        $firstCategory = Category::first();

        \RealRashid\SweetAlert\Facades\Alert::success('¡La evaluación ha sido asignada!', 'Puedes comenzar a evaluar el repositorio.');
        return redirect()->route('evaluations.categories.evaluate', [$evaluation, $firstCategory]);
    }

    public function render()
    {
        return view('livewire.evaluations.assign');
    }
}
