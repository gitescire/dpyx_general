<div class="modal fade" id="showAnswerHistory{{$answer->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalAriaLabelledby" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Historial de respuestas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="border p-2">
                            {{$answer->question->description}}
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
                                        <th>
                                            Respuesta
                                        </th>
                                        <th>
                                            Observación
                                        </th>
                                        @if($repository->evaluation->status != 'revisado' && auth()->user()->hasRole('evaluador') && auth()->id() == $repository->evaluation->evaluator_id)
                                        <th>
                                            Acciones
                                        </th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <tr>
                                        <td>{{$answer->updated_at}}</td>
                                    <td>{{$answer->choice ? $answer->choice->description : 'N/A'}}</td>
                                    <td>{{$answer->observation ? $answer->observation->description : 'N/A'}}</td>
                                    </tr> --}}

                                    @if(sizeof($evaluationsHistory) > 0)
                                    @foreach ($evaluationsHistory as $evaluationHistory)
                                    <tr>
                                        <td>{{$evaluationHistory->created_at}}</td>
                                        <td>
                                            {{$evaluationHistory->choice ? $evaluationHistory->choice->description : 'N/A'}}
                                        </td>
                                        <td>
                                            {{$evaluationHistory->observation ? $evaluationHistory->observation->description : 'N/A'}}
                                        </td>
                                        @if($repository->evaluation->status != 'revisado' && auth()->user()->hasRole('evaluador') && auth()->id() == $repository->evaluation->evaluator_id)
                                        <td>
                                            @if($evaluationHistory->observationHistory && !$evaluationHistory->observationHistory->is_deleted)
                                            <form action="{{ route('evaluations.categories.questions.observations.destroy',[$repository->evaluation, $evaluationHistory->observationHistory->id]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-shadow rounded-0"><i class="fas fa-trash"></i></button>
                                            </form>
                                            @elseif($evaluationHistory->observationHistory && $evaluationHistory->observationHistory->is_deleted)
                                            <form action="{{ route('evaluations.categories.questions.observations.restore',[$repository->evaluation, $evaluationHistory->observationHistory->id]) }}" method="POST">
                                                @csrf
                                                Observación eliminada (<button type="submit" class="btn text-success btn-link btn-shadow rounded-0">Restaurar <i class="fas fa-trash-restore"></i></button>)
                                            </form>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                    @else

                                    @if($repository->evaluation->status != 'revisado' && auth()->user()->hasRole('evaluador') && auth()->id() == $repository->evaluation->evaluator_id)
                                    <tr>
                                        <td colspan="4" class="text-center">No hay observaciones registradas</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td colspan="3" class="text-center">No hay observaciones registradas</td>
                                    </tr>
                                    @endif
                                    @endif

                                    {{--@if($evaluationHistory->answerHistoryData($answer->question_id) !== NULL && $evaluationHistory->answerHistoryObject($answer->question_id)->observationHistory !== NULL)
                                    @if(auth()->user()->hasRole('usuario') && !$answerHistoryObject->observationHistory->is_deleted || !auth()->user()->hasRole('usuario'))
                                    <tr>
                                        <td>
                                            {{$answerHistoryObject->created_at}}
                                    </td>
                                    <td>
                                        {{$answerHistoryObject->choice ? $answerHistoryObject->choice->description : 'N/A'}}
                                    </td>
                                    <td class="text-justify">
                                        {{$answerHistoryObject->observation ? $answerHistoryObject->observation->description : 'N/A'}}
                                    </td>
                                    @if($evaluation->status != 'revisado' && auth()->user()->hasRole('evaluador') && auth()->id() == $evaluation->evaluator_id)
                                    <td class="text-center">
                                        @if($answerHistoryObject->observationHistory && !$answerHistoryObject->observationHistory->is_deleted)
                                        <form action="{{ route('evaluations.categories.questions.observations.destroy',[$evaluation, $answerHistoryObject->observationHistory->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-shadow rounded-0"><i class="fas fa-trash"></i></button>
                                        </form>
                                        @elseif($answerHistoryObject->observationHistory && $answerHistoryObject->observationHistory->is_deleted)
                                        <form action="{{ route('evaluations.categories.questions.observations.restore',[$evaluation, $answerHistoryObject->observationHistory->id]) }}" method="POST">
                                            @csrf
                                            Observación eliminada (<button type="submit" class="btn text-success btn-link btn-shadow rounded-0">Restaurar <i class="fas fa-trash-restore"></i></button>)
                                        </form>
                                        @else
                                        -
                                        @endif
                                    </td>
                                    @endif
                                    </tr>
                                    @endif

                                    @if($observationsCounter == 0)
                                    @if($repository->evaluation->status != 'revisado' && auth()->user()->hasRole('evaluador') && auth()->id() == $repository->evaluation->evaluator_id)
                                    <tr><td colspan="4" class="text-center">No hay observaciones registradas</td></tr>
                                    @else
                                    <tr><td colspan="3" class="text-center">No hay observaciones registradas</td></tr>
                                    @endif
                                    @endif
                                    --}}


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
