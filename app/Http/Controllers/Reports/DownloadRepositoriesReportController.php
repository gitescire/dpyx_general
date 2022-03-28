<?php

namespace App\Http\Controllers\Reports;

use App\Models\Repository;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RepositoriesExport;

class DownloadRepositoriesReportController extends Controller
{
    protected $search;
    protected $search_filter;
    protected $array_repositories;

    public function __invoke(Request $request,String $search_filter, String $search = null){
        $this->search = $search;
        $this->search_filter = $search_filter;
        $this->array_repositories = $this->getRepositories();
        error_log(json_encode($this->array_repositories));
        return Excel::download(new RepositoriesExport($this->array_repositories), 'listaRevistas.xlsx');
    }

    protected function getRepositories(): array
    {
        $repositories = null;
        $array_repositories = [];
        switch ($this->search_filter){
            case 'Sin filtro':
                $repositories = Repository::orderBy('id', 'desc');

                break;
            case 'Filtrar sin progreso':
                $repositories= Repository::where('repositories.status','=', 'en progreso')->orderBy('id', 'desc');

                break;
            case 'Filtrar en evaluacíon':
                $repositories= Repository::select('repositories.*', 'evaluations.status')
                     ->join('evaluations', 'repositories.id', '=', 'evaluations.id')
                     ->where('evaluations.status','=', 'en revisión')
                     ->orderBy('id', 'desc');

                break;
            case 'Filtrar con observaciónes':
                $repositories= Repository::where('repositories.status','=', 'observaciones')
                     ->orderBy('id', 'desc');

                break;
            case 'Filtrar aprobado':
                $repositories= Repository::where('repositories.status', '=', 'aprobado')
                ->orderBy('id', 'desc');

                break;
            case 'Filtrar rechazado':
                $repositories= Repository::where('repositories.status', '=', 'rechazado')
                     ->orderBy('id', 'desc');

                break;
        }

        if ($this->search) {
            $repositories = $repositories->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('responsible', function ($query) {
                        return $query->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('evaluation', function ($query) {
                        return $query->whereHas('history', function ($query) {
                            return $query->where('name', 'like', '%' . $this->search . '%');
                        });
                    });
            });
        }

        if (Auth::user()->is_admin) {
            $repositories = $repositories;

        } else if (Auth::user()->is_evaluator) {
            $repositories = $repositories->whereHas('evaluation', function ($query) {
                // return $query->where('evaluator_id', Auth::user()->id);
                return $query->whereHas('evaluator', function ($query) {
                    return $query->where('users.id', Auth::user()->id);
                });
            });
        } else {
            $repositories = Auth::user()->repositories();
        }

        foreach($repositories->get() as $repository){
            $array_repositories[] = [
                strtoupper($repository->name),
                strtoupper($repository->evaluation->in_review ? 'En evaluación' : $repository->status),
                strtoupper(($repository->is_aproved || $repository->is_rejected) ? 'Concluido' : $repository->evaluation->status),
                strtoupper($repository->responsible->name),
                strtoupper((config('app.is_evaluable') && (auth()->user()->is_evaluator || auth()->user()->is_admin || config('dpyx.evaluators_shownables'))) ?
                   ($repository->evaluation && isset($repository->evaluation->evaluator->name) ? $repository->evaluation->evaluator->name : 'N/A') : 'N/A')
            ];
        }

        return $array_repositories;
    }
}
