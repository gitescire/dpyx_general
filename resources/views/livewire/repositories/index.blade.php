<div class="mb-4">

    @section('header')
    <x-page-title title="Lista de {{ __('containerNamePlural') }}" description="{{ __('messages.views.livewire.repositories.index.text1') }}"></x-page-title>
    @endsection



    @if(auth()->user()->is_evaluator || auth()->user()->is_admin)
    <div class="mb-3 row d-flext justify-content-between">
        <div class="col-12 col-lg-4">
            <x-input-search />
        </div>

        <div class="input-group col-12 col-lg-4">
            <select wire:model='search_filter' class="custom-select" aria-label=".form-select-sm example">
                <option value="Sin filtro" selected>Sin filtro</option>
                <option value="Filtrar en progreso">Filtrar en progreso</option>
                <option value="Filtrar en evaluación">Filtrar en evaluación</option>
                <option value="Filtrar con observaciones">Filtrar con observaciones</option>
                <option value="Filtrar aprobado">Filtrar aprobado</option>
                <option value="Filtrar rechazado">Filtrar rechazado</option>
            </select>
            <div class="input-group-append">
                <span class="input-group-text">{{$frequency_data}} registros</span>

                <span class="input-group-text">
                    <a href="{{ route('repositories.xlsx', [$search_filter,$evaluator_filter,$search]) }}" target="_BLANK" class="btn_link">
                        <i class="fas fa-file-excel"></i>
                    </a>
                </span>
            </div>
        </div>

        <div class="text-right col-12 col-lg-4">
            @if (auth()->user()->is_evaluator || auth()->user()->is_admin)
            <span class="ml-2 text-info">
                AGLOMERADO GENERAL
            </span>
            <a href="{{ route('repositories.statistics.all') }}" class="btn btn-info btn-shadow rounded-0">
                <i class="fas fa-chart-pie"></i>
            </a>
            @endif
        </div>
    </div>
    @endif

    <div class="mb-3 bg-white shadow table-responsive">
        <table class="table m-0 table-bordered">
            <thead>
                <tr>
                    <th class="text-uppercase">Nombre</th>
                    <th class="text-uppercase">{{ __('containerName') }}</th>
                    <th class="text-uppercase">Evaluación</th>
                    <th class="text-uppercase">Encargado</th>
                    @if (config('app.is_evaluable') && (auth()->user()->is_evaluator || auth()->user()->is_admin || config('dpyx.evaluators_shownables')))
                    <th class="text-uppercase">
                        @if(auth()->user()->is_admin)
                        Evaluador <br>
                        <select wire:model='evaluator_filter' class="custom-select">
                            <option value="0" selected>Sin filtro</option>
                            @foreach($evaluators_list as $evaluator)
                            <option value="{{$evaluator->id}}" selected>{{$evaluator->name}}</option>
                            @endforeach
                        </select>
                        @else
                        Evaluador
                        @endif
                    </th>
                    @endif
                    <th class="text-uppercase">Gráfica de resultados</th>
                    {{-- @if (config('app.is_evaluable') && (auth()->user()->is_evaluator || auth()->user()->is_admin || config('dpyx.evaluators_shownables'))) --}}
                    <th class="text-uppercase">Cuestionario</th>
                    {{-- @endif --}}
                    <th class="text-uppercase">Historial</th>
                    <th class="text-uppercase">PDF</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($repositories as $repository)
                <tr>
                    <td>{{ $repository->name }}</td>
                    <td>
                        <span class="badge badge-{{ $repository->status_color }}">
                            @if ($repository->evaluation->in_review)
                            En evaluación
                            @else
                            {{ $repository->status }}
                            @endif
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-{{ $repository->evaluation->status_color }}">
                            @if ($repository->is_aproved || $repository->is_rejected)
                            Concluido
                            @else
                            {{ $repository->evaluation->status }}
                            @endif
                        </span>
                    </td>
                    <td>{{ $repository->responsible->name }}</td>
                    @if (config('app.is_evaluable') && (auth()->user()->is_evaluator || auth()->user()->is_admin || config('dpyx.evaluators_shownables')))
                    <td> @if($repository->evaluation && isset($repository->evaluation->evaluator->name)) {{$repository->evaluation->evaluator->name}} @else 'N/A' @endif</td>
                    @endif
                    <td class="text-center">
                        @if($repository->is_aproved || $repository->is_aproved && !auth()->user()->is_user)
                        <a href="{{ route('repositories.statistics.show', [$repository]) }}" class="btn btn-info btn-shadow rounded-0 {{ $repository->evaluation->answers->whereNotNull('choice_id')->count() ? '' : 'disabled' }}" title="Ver gráfica de resultados">
                            <i class="fas fa-chart-pie"></i>
                        </a>
                        @else
                        No hay evaluación
                        @endif
                    </td>
                    {{-- @if (config('app.is_evaluable') && (auth()->user()->is_evaluator || auth()->user()->is_admin || config('dpyx.evaluators_shownables'))) --}}
                    <td class="text-center">
                        <a href="{{ route('evaluations.categories.questions.index', [$repository->evaluation, $firstCategory]) }}" class="btn btn-{{ $repository->evaluation->is_reviewed && $repository->is_aproved ? 'secondary' : 'primary' }} btn-shadow rounded-0 {{ $repository->evaluation->is_viewable ? '' : 'disabled' }}" title="Ír a evaluación">
                            <i class="fas fa-scroll"></i>
                        </a>
                    </td>
                    {{-- @endif --}}
                    <td class="text-center">
                        <button type="button" class="btn btn-info btn-shadow rounded-0" data-toggle="modal" data-target="#showEvaluationHistory{{ $repository->evaluation->id }}">
                            <i class="fas fa-history"></i>
                        </button>
                        <x-modals.evaluations.history :evaluation="$repository->evaluation" />
                    </td>
                    <td class="text-center">
                        <a href="{{ route('evaluations.pdf', [$repository->evaluation]) }}" class="btn btn-secondary btn-shadow rounded-0">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="{{(config('app.is_evaluable') && (auth()->user()->is_evaluator || auth()->user()->is_admin || config('dpyx.evaluators_shownables'))) ? 9 : 8 }}">
                        No hay datos para mostrar
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="">
        {{ $repositories->links() }}
    </div>

</div>