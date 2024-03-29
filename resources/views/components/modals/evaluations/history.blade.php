<div class="modal fade" id="showEvaluationHistory{{$evaluation->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalAriaLabelledby" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Historial de evaluaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="border p-2">
                            {{$evaluation->repository->name}}
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="table-responsive bg-white shadow">
                            <table class="table table-bordered m-0">
                                <thead>
                                    <tr>
                                        <th>
                                            Fecha
                                        </th>
                                        @if (config('app.is_evaluable') && (auth()->user()->is_evaluator || auth()->user()->is_admin || config('dpyx.evaluators_shownables')) )
                                        <th>
                                            Evaluador
                                        </th>
                                        @endif
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Detalles
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong>{{$evaluation->updated_at}}</strong>
                                        </td>
                                        @if (config('app.is_evaluable') && (auth()->user()->is_evaluator || auth()->user()->is_admin || config('dpyx.evaluators_shownables')) )
                                        <td>
                                            <strong>{{$evaluation->evaluator ? $evaluation->evaluator->name : 'N/A'}}</strong>
                                        </td>
                                        @endif
                                        <td>
                                            <strong>
                                            @if ($evaluation->in_review)
                                            En evaluación,
                                            @else
                                            {{ ucfirst($evaluation->repository->status) }},
                                            @endif
                                            @if(in_array($evaluation->repository->status,['aprobado','rechazado']))
                                            concluido
                                            @else
                                            {{$evaluation->status}}
                                            @endif
                                            </strong>
                                        </td>
                                        <td class="text-justify">
                                            <strong>{{ $evaluation->repository->comments }}</strong>
                                        </td>
                                    </tr>
                                    @foreach ($evaluation->repository->evaluationsHistory()->orderBy('id','desc')->get() as $evaluationHistory)
                                    <tr>
                                        <td>
                                            {{$evaluationHistory->created_at}}
                                        </td>
                                        @if (config('app.is_evaluable') && (auth()->user()->is_evaluator || auth()->user()->is_admin || config('dpyx.evaluators_shownables')) )
                                        <td>
                                            {{$evaluationHistory->evaluator ? $evaluationHistory->evaluator->name : 'N/A'}}
                                        </td>
                                        @endif
                                        <td>
                                        @if($evaluationHistory->status == 'en revisión')
                                        En evaluación,
                                        @else
                                        {{ ucfirst($evaluationHistory->repository_status) }},
                                        @endif
                                        @if(in_array($evaluationHistory->repository_status,['aprobado','rechazado']))
                                        concluido
                                        @else
                                        {{$evaluationHistory->status}}
                                        @endif
                                        </td>
                                        <td class="text-{{$evaluationHistory->comments != NULL ? 'justify' : 'center'}}">
                                        {{$evaluationHistory->comments != NULL ? $evaluationHistory->comments : '-'}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-shadow rounded-0" data-dismiss="modal">
                    <i class="fas fa-window-close"></i>
                </button>
                {{-- <button class="btn btn-danger btn-shadow rounded-0"> --}}
                {{-- </button> --}}
            </div>

        </div>
    </div>
</div>
