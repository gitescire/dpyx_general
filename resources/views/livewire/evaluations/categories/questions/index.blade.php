<div class="mb-4" x-data="data()" x-init="mounted()">

    @section('header')
    <x-page-title title="Contestar cuestionario"
        description="Este módulo permite responder las preguntas para evaluar el repositorio."></x-page-title>
    @endsection

    @if ($evaluation->is_answered && Auth::user()->hasRole('usuario'))
    <div class="row mb-3">
        <div class="col-12">
            <form action="{{route('evaluations.send',[$evaluation])}}" method="POST">
                @csrf
                <button class="btn btn-success btn-wide shadow rounded-0">
                    <i class="fas fa-paper-plane"></i> ENVIAR A CONCYTEC
                </button>
            </form>
        </div>
    </div>
    @endif

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

    <div x-data="data()" x-init="mounted()">
        <form action="{{route('evaluations.categories.questions.store',[$evaluation,$categoryChoosed])}}" method="POST">
            @csrf
            @method('POST')
            <div>
                <template x-for="subcategory in subcategories" :key="subcategory">
                    <div>
                        <template x-if="subcategory.has_questions">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h4 class="text-uppercase text-muted">
                                        <span x-text="subcategory.name"></span>
                                    </h4>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-lg-3">
                                            <div
                                                class="card-shadow-primary mb-3 widget-chart widget-chart2 text-left card">
                                                <div class="widget-chat-wrapper-outer">
                                                    <div class="widget-chart-content">
                                                        <h6 class="widget-subheading">
                                                            concytec
                                                        </h6>
                                                        <div class="widget-chart-flex">
                                                            <div class="widget-numbers mb-0 w-100">
                                                                <div class="widget-chart-flex">
                                                                    <div class="fsize-4 text-danger">
                                                                        <span
                                                                            x-text="getTotalPunctuation(subcategory) + '%'"></span>
                                                                    </div>
                                                                    <div class="ml-auto">
                                                                        <div
                                                                            class="widget-title ml-auto font-size-lg font-weight-normal text-muted">
                                                                            <span class="text-danger pl-2">
                                                                                <span class="pr-1">
                                                                                    de
                                                                                </span>
                                                                                <span
                                                                                    x-text="getTotalMaxPunctuation(subcategory) + '%'"></span>
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
                                        <div class="col-12 col-lg-3"></div>
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
                                                    <th class="text-uppercase">Observaciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <template x-for="question in subcategory.questions" :key="question">
                                                    <tr>
                                                        <td>
                                                            <span x-text="question.description"></span>
                                                            <template
                                                                x-if="question.current_value > 0 && question.has_description_field">
                                                                <div>
                                                                    <br>
                                                                    <span class="text-muted"
                                                                        x-text="question.description_label"></span>
                                                                    <template x-if="question.is_answerable">
                                                                        <textarea :name="`descriptions[${question.id}]`"
                                                                            x-text="question.answer ? question.answer.description : ''"
                                                                            rows="2" class="form-control"
                                                                            required></textarea>
                                                                    </template>
                                                                    <template x-if="!question.is_answerable">
                                                                        <textarea :name="`descriptions[${question.id}]`"
                                                                            x-text="question.answer ? question.answer.description : ''"
                                                                            rows="2" class="form-control"
                                                                            required disabled readonly></textarea>
                                                                    </template>
                                                                </div>
                                                            </template>
                                                        </td>
                                                        <td>
                                                            <span x-text="question.max_punctuation"></span>
                                                        </td>
                                                        <td>
                                                            <template x-if="question.is_answerable">
                                                                <input type="hidden" name="choices[]"
                                                                    x-model="question.current_choice_id">
                                                                <select :question-id="question.id"
                                                                    x-on:change="setCurrentChoice(question)" required
                                                                    class="form-control">
    
                                                                    <option>seleccionar</option>
    
                                                                    <template x-for="choice in question.choices">
                                                                        <option x-bind:value="choice.id"
                                                                            x-bind:selected="question.answer && parseFloat(question.answer.choice.punctuation) == parseFloat(choice.punctuation) ? true : false">
                                                                            <span x-text="choice.description"></span>
                                                                        </option>
                                                                    </template>
                                                            </template>
                                                            <template x-if="!question.is_answerable">
                                                                <input type="text" :value="question.answer ? question.answer.choice.description : ''" class="form-control" readonly disabled>
                                                            </template>

                                                            </select>
                                                        </td>
                                                        <td>
                                                            @can('edit evaluations')
                                                            <template x-if="question.answer">
                                                                <a :href="question.answer.route" class="btn btn-info btn-shadow rounded-0">
                                                                    <i class="fas fa-plus"></i>
                                                                </a>
                                                            </template>
                                                            @endcan
                                                            <template x-if="question.answer && question.answer.observation">
                                                                <a :href="question.answer.route" class="btn btn-secondary btn-shadow rounded-0">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </template>
                                                        </td>
                                                    </tr>
                                                </template>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>
            </div>

            <template x-if="evaluation.is_answerable">
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-success btn-shadow btn-wide rounded-0">
                        <i class="fas fa-save"></i> Continuar
                    </button>
                </div>
            </template>
        </form>
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
                                        class="custom-control-input" value="aproved" {{$repository->status == 'aproved' ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="evaluationAcceptedInput">
                                        <div class="mb-2 mr-2 badge badge-success">Aceptado</div>
                                    </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="evaluationWithObservations" name="status"
                                        class="custom-control-input" value="observations" {{$repository->status == 'observations' ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="evaluationWithObservations">
                                        <div class="mb-2 mr-2 badge badge-warning">Evaluado con observaciones</div>
                                    </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="evaluationRejected" name="status"
                                        class="custom-control-input" value="rejected" {{$repository->status == 'rejected' ? 'checked' : ''}}>
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

                /**
                 * 
                 * 
                 * 
                 **/
                evaluation: @json($evaluation),
                subcategories: @json($subcategories),
                observation: undefined,
                repository: @json($repository),

                /**
                 * 
                 * 
                 * 
                 **/   
                mounted() {
                    this.setCurrentPunctuations();
                },

                /**
                 * 
                 * 
                 * 
                */

                setCurrentChoice(question){
                    choice_id = document.querySelector(`select[question-id="${question.id}"]`).value;
                    question.choice = question.choices.find(choice => choice.id == choice_id);
                    question.current_value = question.choice.punctuation
                    question.current_choice_id = choice_id
                    // question.current_value = question.choices.find( choice => $el.options[$el.selectedIndex].value == choice.id ) ? question.choices.find( choice => $el.options[$el.selectedIndex].value == choice.id ).punctuation : 0
                },

                /**
                 * 
                 * 
                 * 
                 **/   
                setCurrentPunctuations(){
                    this.subcategories.forEach(subcategory => {
                        subcategory.questions.forEach(question => {
                            question.current_value = question.answer ? parseFloat(question.answer.choice.punctuation) : 0
                            question.current_choice_id = question.answer ? parseFloat(question.answer.choice.id) : null
                        });
                    });
                },

                /**
                 * 
                 * 
                 * 
                 **/   
                getTotalPunctuation(subcategory){
                    total = 0;
                    subcategory.questions.forEach(question => {
                        total += parseFloat(question.current_value)
                    });
                    return total
                },

                /**
                 * 
                 * 
                 * 
                 **/   
                getTotalMaxPunctuation(subcategory){
                    total = 0;
                    subcategory.questions.forEach(question => {
                        total += parseFloat(question.max_punctuation)
                    });
                    return total
                },

                /**
                 * 
                 * 
                 * 
                 **/
                existObservation(question){
                    return question.answer && question.answer.observation
                }
            }
        }

    </script>

</div>