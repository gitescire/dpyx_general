<div class="mb-4">

    @section('header')
    <x-page-title title="Lista de repositorios"
        description="Este modulo permite listar los repositorios pertenecientes a los usuarios."></x-page-title>
    @endsection

    <div class="mb-3">
        <a href="{{route('repositories.statistics.all')}}" class="btn btn-info btn-shadow rounded-0">
            <i class="fas fa-chart-pie"></i>
        </a>
    </div>

    <div class="table-responsive shadow bg-white">
        <table class="table table-bordered m-0">
            <thead>
                <tr>
                    <th class="text-uppercase">Nombre</th>
                    <th class="text-uppercase">Repositorio</th>
                    <th class="text-uppercase">Evaluación</th>
                    <th class="text-uppercase">Encargado</th>
                    @if (config('app.is_evaluable'))
                    <th class="text-uppercase">Evaluador</th>
                    @endif
                    <th class="text-uppercase">Gráfica de resultados</th>
                    <th class="text-uppercase">Cuestionario</th>
                    <th class="text-uppercase">Historial</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($repositories as $repository)
                <tr>
                    <td>{{$repository->name}}</td>
                    <td>
                        <span class="badge badge-{{$repository->status_color}}">
                            {{$repository->status}}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-{{$repository->evaluation->status_color}}">
                            {{$repository->evaluation->status}}
                        </span>
                    </td>
                    <td>{{$repository->responsible->name}}</td>
                    @if (config('app.is_evaluable'))
                    <td>{{$repository->evaluation ? $repository->evaluation->evaluator->name : 'N/A'}}</td>
                    @endif
                    <td>
                        <a href="{{route('repositories.statistics.show',[$repository])}}"
                            class="btn btn-info btn-shadow rounded-0 {{$repository->evaluation->answers->whereNotNull('choice_id')->count() ? '' : 'disabled'}}">
                            <i class="fas fa-chart-pie"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{route('evaluations.categories.questions.index',[$repository->evaluation, $firstCategory])}}"
                            class="btn btn-{{$repository->evaluation->is_reviewed && $repository->is_aproved ? 'secondary' : 'primary'}} btn-shadow rounded-0 {{$repository->evaluation->is_viewable ? '' : 'disabled'}}">
                            <i class="fas fa-scroll"></i>
                        </a>
                    </td>
                    <td>
                        <button type="button" class="btn btn-info btn-shadow rounded-0" data-toggle="modal"
                            data-target="#showEvaluationHistory{{$repository->evaluation->id}}">
                            <i class="fas fa-history"></i>
                        </button>
                        <x-modals.evaluations.history :evaluation="$repository->evaluation" />
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>