<div class="mb-4" x-data="data()" x-init="mounted()">

    @section('header')
    <x-page-title title="Contestar cuestionario"
        description="Este módulo permite responder las preguntas para evaluar el repositorio."></x-page-title>
    @endsection

    @if ( config('app.is_evaluable') )
    @if ($evaluation->is_answered && Auth::user()->hasRole('usuario'))
    <div class="row mb-3">
        <div class="col-12">
            <form action="{{route('evaluations.send',[$evaluation])}}" method="POST" x-ref="formSendToConcytec">
                @csrf
            </form>
            <button class="btn btn-success btn-wide shadow rounded-0" {{$announcement ? '' : 'disabled'}}
                x-ref="buttonSendToConcytec" x-on:click="showWarning()">
                <i class="fas fa-paper-plane"></i> ENVIAR A {{getenv('APP_NAME')}}
            </button>
        </div>
    </div>
    @endif
    @endif

    <div class="row">
        <div class="col-12 d-flex justify-content-end mb-3">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck1"
                    wire:click="toggleSupplementaryQuestions()">
                <label class="custom-control-label text-uppercase text-danger" for="customCheck1">
                    ¿Mostrar preguntas complementarias?
                    @if ($showComplementaryQuestions)
                    si
                    @else
                    no
                    @endif
                </label>
            </div>
        </div>
    </div>

    <ul class="nav nav-justified mb-3">
        @foreach ($categories as $category)
        <li
            class="nav-item border-bottom mr-1 {{$categoryChoosed->id == $category->id ? 'border-danger bg-red-light' : ''}}">
            <a href="{{route('evaluations.categories.questions.index',[$evaluation,$category])}}"
                class="nav-link active">
                <i class="nav-link-icon pe-7s-settings"></i>
                <span>{{$category->short_name ?? $category->name}}</span>
            </a>
        </li>
        @endforeach
    </ul>

    @foreach ($subcategories as $subcategory)
    @if ($subcategory->has_questions)
    <div class="row mb-3">
        <div class="col-12">
            <h4 class="text-uppercase text-muted">
                <span>{{$subcategory->name}}</span>
            </h4>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-left card">
                        <div class="widget-chat-wrapper-outer">
                            <div class="widget-chart-content">
                                <h6 class="widget-subheading">
                                    Puntuación {{getenv('APP_NAME')}}
                                </h6>
                                <div class="widget-chart-flex">
                                    <div class="widget-numbers mb-0 w-100">
                                        <div class="widget-chart-flex">
                                            <div class="fsize-4 text-danger">
                                                <span>
                                                    {{$subcategory->total_required_punctuation}}%
                                                </span>
                                            </div>
                                            <div class="ml-auto">
                                                <div
                                                    class="widget-title ml-auto font-size-lg font-weight-normal text-muted">
                                                    <span class="text-danger pl-2">
                                                        <span class="pr-1">
                                                            de
                                                        </span>
                                                        <span>
                                                            {{$subcategory->max_required_punctuation}}%
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($subcategory->questions()->supplementaries()->get()->count())
                <div class="col-12 col-lg-3">
                    <div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-left card">
                        <div class="widget-chat-wrapper-outer">
                            <div class="widget-chart-content">
                                <h6 class="widget-subheading">
                                    Puntuación complementaria
                                </h6>
                                <div class="widget-chart-flex">
                                    <div class="widget-numbers mb-0 w-100">
                                        <div class="widget-chart-flex">
                                            <div class="fsize-4 text-danger">
                                                <span>
                                                    {{$subcategory->total_supplementary_punctuation}}%
                                                </span>
                                            </div>
                                            <div class="ml-auto">
                                                <div
                                                    class="widget-title ml-auto font-size-lg font-weight-normal text-muted">
                                                    <span class="text-danger pl-2">
                                                        <span class="pr-1">
                                                            de
                                                        </span>
                                                        <span>
                                                            {{$subcategory->max_supplementary_punctuation}}%
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif


            </div>
        </div>
        <div class="col-12">
            <div class="table-responsive bg-white shadow">
                <table class="table table-bordered m-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase">Pregunta</th>
                            <th class="text-uppercase">Puntuación</th>
                            <th class="text-uppercase">Respuestas</th>
                            <th class="text-uppercase">Status</th>
                            <th class="text-uppercase">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcategory->questions as $question)
                        @if ( ($showComplementaryQuestions && $question->is_optional) || !$question->is_optional)
                        <tr wire:key="{{ $loop->index }}">
                            <td>
                                <span>{{$question->description}}</span>
                                @if ($question->answer && $question->answer->choice->punctuation > 0 &&
                                $question->has_description_field)
                                <br><br>
                                <span class="text-info">{{$question->description_label}}</span>
                                <textarea rows="2" class="form-control border-info" required wire:change="updateDescription({{$question->answer}}, $event.target.value)"
                                    {{$question->is_answerable ? '' : 'disabled readonly'}}>{{$question->answer->description}}</textarea>
                                @endif
                            </td>
                            <td>
                                <span>{{$question->max_punctuation}}</span>
                            </td>
                            <td>
                                {{-- sel.options[sel.selectedIndex] --}}
                                <select class="form-control" x-ref="{{$question->id}}" wire:loading.attr="disabled" wire:target="storeAnswer" {{$question->is_answerable ? '' : 'readonly disabled'}}
                                    x-on:change="$wire.storeAnswer({{$question->id}}, $refs[{{$question->id}}].options[$refs[{{$question->id}}].selectedIndex].value )">
                                    <option value="" {{$question->answer ? '' : 'selected'}}>seleccionar</option>
                                    @foreach ($question->choices as $choice)
                                    <option value="{{$choice->id}}"
                                        {{$question->answer && $question->answer->choice->id == $choice->id ? 'selected' : ''}}>
                                        {{$choice->description}}</option>
                                    @endforeach
                                </select>
                                {{-- <div class="dropdown" wire:ignore.self>
                                    <button class="w-100" type="button" id="dropdown-question-{{$question->id}}"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                wire:ignore.self>
                                <span class="form-control {{$question->answer ? 'btn-info' : 'btn-warning'}}">
                                    {{$question->answer ? $question->answer->choice->description : 'seleccionar'}}
                                </span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdown-question-{{$question->id}}">
                                    <a class="dropdown-item" href="javascript:void(0)"
                                        wire:click="storeAnswer({{$question->id}}, {{null}})">seleccionar</a>
                                    @foreach ($question->choices as $choice)
                                    <a class="dropdown-item" href="javascript:void(0)"
                                        wire:click="storeAnswer({{$question->id}}, {{$choice->id}})">{{$choice->description}}</a>
                                    @endforeach
                                </div>
            </div> --}}

            {{-- <select class="form-control" required
                                    {{$question->is_answerable ? '' : 'readonly disabled'}}>

            <option value="" wire:click="sta">seleccionar</option>

            @foreach ($question->choices as $choice)
            <option value="{{$choice->id}}" wire:click="sta"
                {{$question->answer && $question->answer->choice->id == $choice->id ? 'selected' : ''}}>
                <span>{{$choice->description}}</span>
            </option>
            @endforeach

            </select> --}}
            </td>
            <td class="text-center">
                <div wire:loading wire:target="storeAnswer">
                    <div class="spinner-border text-secondary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div wire:loading.remove wire:target="storeAnswer">
                    <span
                        class="badge badge-pill {{$question->answer ? 'badge-success' : 'badge-warning'}}">{{$question->answer ? 'contestada' : 'pendiente'}}</span>
                </div>
            </td>
            <td>
                {{-- @can('edit evaluations') --}}
                @if ($evaluation->is_reviewable)
                @if ($question->answer)
                <a href="{{route('answers.show', [$question->answer])}}" class="btn btn-info btn-shadow rounded-0">
                    <i class="fas fa-plus"></i>
                </a>
                @endif
                @endif
                {{-- @endcan --}}
                @if ($question->answer && $question->answer->observation)
                <a href="{{route('answers.show', [$question->answer])}}" class="btn btn-secondary btn-shadow rounded-0">
                    <i class="fas fa-eye"></i>
                </a>
                @endif
            </td>
            </tr>
            @endif
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endforeach

<div class="d-flex justify-content-end mb-3">
    <a href="{{route('evaluations.categories.questions.index',[$evaluation, $nextCategory])}}"
        class="btn btn-success btn-shadow btn-wide rounded-0">
        <i class="fas fa-save"></i> Continuar
    </a>
</div>

@can('create observations')
@if ($evaluation->is_reviewable)
<div class="row">
    <div class="col-12">
        <form action="{{route('repositories.send',[$evaluation->repository])}}" method="POST">
            @csrf
            @method('POST')
            <div class="card shadow border-0 mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="" class="text-muted text-uppercase">Status</label><br>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="evaluationAcceptedInput" name="status"
                                    class="custom-control-input" value="aproved"
                                    {{$repository->status == 'aproved' ? 'checked' : ''}}>
                                <label class="custom-control-label" for="evaluationAcceptedInput">
                                    <div class="mb-2 mr-2 badge badge-success">Aceptado</div>
                                </label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="evaluationWithObservations" name="status"
                                    class="custom-control-input" value="observations"
                                    {{$repository->status == 'observations' ? 'checked' : ''}}>
                                <label class="custom-control-label" for="evaluationWithObservations">
                                    <div class="mb-2 mr-2 badge badge-warning">Evaluado con observaciones</div>
                                </label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="evaluationRejected" name="status" class="custom-control-input"
                                    value="rejected" {{$repository->status == 'rejected' ? 'checked' : ''}}>
                                <label class="custom-control-label" for="evaluationRejected">
                                    <div class="mb-2 mr-2 badge badge-danger">Rechazado</div>
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="" class="text-muted text-uppercase">Comentarios</label>
                            <textarea name="comments" id="" cols="30" rows="5" 
                                class="form-control">Su repositorio ha sido enviado.</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-success btn-wide btn-shadow rounded-0">
                    <i class="fas fa-paper-plane"></i> Enviar
                </button>
            </div>
        </form>
    </div>
</div>
@endif
@endcan

<script>
    function data(){
        return {
            showComplementaryQuestions: false,

            mounted(){

            },

            /**
            *
            *
            */

            showWarning(){
                if(this.$refs.buttonSendToConcytec.disabled){
                    return;
                }

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "No podrás modificar ninguna respuestas hasta que el evaluador te envíe los resultados.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'SI, ENVÍALO',
                    cancelButtonText: 'CANCELAR'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.$refs.formSendToConcytec.submit()
                    }
                })
            },

        }
    }

</script>

</div>