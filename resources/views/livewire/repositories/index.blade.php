<div class="mb-4">

    @section('header')
        <x-page-title title="Lista de {{ __('containerNamePlural') }}"
            description="{{ __('messages.views.livewire.repositories.index.text1') }}"></x-page-title>
    @endsection



    <div class="mb-3 row d-flext justify-content-between">
        <div class="col-12 col-lg-4">
            <x-input-search />

        </div>

         <div class="text-left custom-control custom-switch col-8 col-lg-4" >
            <input wire:model="withoutprogress" type="checkbox" class="custom-control-input" id="swprogres">
            <label class="custom-control-label" for="swprogres">Filtrar sin progreso</label>
          </div>


        <div class="text-right col-8 col-lg-4">
            @if (auth()->user()->is_evaluator || auth()->user()->is_admin)
                <span class="ml-2 text-info">
                    AGLOMERADO GENERAL
                </span>
                <a href="{{ route('repositories.statistics.all') }}" class="mb-2 btn btn-info btn-shadow rounded-0">
                    <i class="fas fa-chart-pie"></i>
                </a>

                <span class="ml-3 text-secondary">
                    CONFIGURACIÓN CONSTANCIA
                </span>
                <a href="{{ route('constancies.edit') }}" class="btn btn-secondary btn-shadow rounded-0">

                    <i class="fas fa-certificate"></i>
                </a>
            @endif
        </div>
    </div>

    <div class="mb-3 bg-white shadow table-responsive">
        <table class="table m-0 table-bordered">
            <thead>
                <tr>
                    <th class="text-uppercase">Nombre</th>
                    <th class="text-uppercase">{{ __('containerName') }}</th>
                    <th class="text-uppercase">Evaluación</th>
                    <th class="text-uppercase">Encargado</th>
                    @if (config('app.is_evaluable') && (auth()->user()->is_evaluator || auth()->user()->is_admin || config('dpyx.evaluators_shownables')))
                        <th class="text-uppercase">Evaluador</th>
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
                @foreach ($repositories as $repository)
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
                            <td>
                                @foreach ($repository->evaluation->evaluators as $evaluator)
                                    <input type="text" class="mt-1 form-control" readonly value="{{ $evaluator->name }}">
                                @endforeach
                            </td>
                        @endif
                        <td>
                            <a href="{{ route('repositories.statistics.show', [$repository]) }}"
                                class="btn btn-info btn-shadow rounded-0 {{ $repository->evaluation->answers->whereNotNull('choice_id')->count() ? '' : 'disabled' }}">
                                <i class="fas fa-chart-pie"></i>
                            </a>
                        </td>
                        {{-- @if (config('app.is_evaluable') && (auth()->user()->is_evaluator || auth()->user()->is_admin || config('dpyx.evaluators_shownables'))) --}}
                        <td>
                            <a href="{{ route('evaluations.categories.questions.index', [$repository->evaluation, $firstCategory]) }}"
                                class="btn btn-{{ $repository->evaluation->is_reviewed && $repository->is_aproved ? 'secondary' : 'primary' }} btn-shadow rounded-0 {{ $repository->evaluation->is_viewable ? '' : 'disabled' }}">
                                <i class="fas fa-scroll"></i>
                            </a>
                        </td>
                        {{-- @endif --}}
                        <td>
                            <button type="button" class="btn btn-info btn-shadow rounded-0" data-toggle="modal"
                                data-target="#showEvaluationHistory{{ $repository->evaluation->id }}">
                                <i class="fas fa-history"></i>
                            </button>
                            <x-modals.evaluations.history :evaluation="$repository->evaluation" />
                        </td>
                        <td>
                            <a href="{{ route('evaluations.pdf', [$repository->evaluation]) }}"
                                class="btn btn-secondary btn-shadow rounded-0">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="">
        {{ $repositories->links() }}
    </div>

</div>
