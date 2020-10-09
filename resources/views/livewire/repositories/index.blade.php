<div class="mb-4">

    @section('header')
    <x-page-title title="Lista de repositorios"
        description="Este modulo permite listar los repositorios pertenecientes a los usuarios."></x-page-title>
    @endsection

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
                            class="btn btn-info btn-shadow rounded-0 {{$repository->evaluation->answers->count() ? '' : 'disabled'}}">
                            <i class="fas fa-chart-pie"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{route('evaluations.categories.questions.index',[$repository->evaluation, $firstCategory])}}"
                            class="btn btn-primary btn-shadow rounded-0 {{$repository->evaluation->is_viewable ? '' : 'disabled'}}">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>