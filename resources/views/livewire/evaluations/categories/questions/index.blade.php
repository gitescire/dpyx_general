<div class="mb-4" x-data="data()" x-init="mounted()">

    @section('header')
    <x-page-title title="Contestar cuestionario"
        description="Este módulo permite responder las preguntas para evaluar el repositorio."></x-page-title>
    @endsection

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
                                        <div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-left card">
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
                                                                <textarea :name="`descriptions[${question.id}]`"
                                                                    x-text="question.answers[0] ? question.answers[0].description : ''"
                                                                    rows="2" class="form-control" required></textarea>
                                                            </div>
                                                        </template>
                                                    </td>
                                                    <td>
                                                        <span x-text="question.max_punctuation"></span>
                                                    </td>
                                                    <td>
                                                        <select :name="'questions['+question.id+']'"
                                                            {{-- class="form-control" :disabled="'false'" x-model="question.current_value"> --}}
                                                            class="form-control" x-model="question.current_value">
                                                            <option value="0">seleccionar</option>
                                                            <option x-bind:value="parseFloat(question.max_punctuation)"
                                                                x-bind:selected="question.answers[0] && parseFloat(question.answers[0].punctuation) == parseFloat(question.max_punctuation) ? true : false">
                                                                Sí</option>
                                                            <option x-bind:value="-parseFloat(question.max_punctuation)"
                                                                x-bind:selected="question.answers[0] && parseFloat(question.answers[0].punctuation) == -parseFloat(question.max_punctuation) ? true : false">
                                                                No</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <template x-if="existObservation(question)">
                                                            <button type="button"
                                                                class="btn btn-secondary btn-shadow rounded-0"
                                                                data-toggle="modal" data-target="#exampleModalCenter"
                                                                x-on:click="observation = question.answers[0].observation">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
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

    @can('edit repositories')
    @if ($evaluation->status == 'finished')
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
                                        class="custom-control-input" value="accepted">
                                    <label class="custom-control-label" for="evaluationAcceptedInput">
                                        <div class="mb-2 mr-2 badge badge-success">Aceptado</div>
                                    </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="evaluationWithObservations" name="status"
                                        class="custom-control-input" value="pending">
                                    <label class="custom-control-label" for="evaluationWithObservations">
                                        <div class="mb-2 mr-2 badge badge-warning">Evaluado con observaciones</div>
                                    </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="evaluationRejected" name="status"
                                        class="custom-control-input" value="rejected">
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


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Observaciones</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <template x-if="observation">
                        <div>
                                <template x-if="observation.files_paths">
                                    <label for="" class="text-uppercase text-muted">Archivos</label>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <template x-for="file in observation.files_paths">
                                                    <div class="col-12 col-lg-4">
                                                        <small><a href="#" x-text="file.file_name"></a></small>
                                                        <img src="https://img.icons8.com/cotton/2x/file.png" :alt="file"
                                                            class="img-thumbnail">
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </template>

                            <div class="row">
                                <div class="col-12">
                                    <label for="" class="text-uppercase text-muted">Observaciones</label>
                                    <div class="card">
                                        <div class="card-body">
                                            <span x-text="observation.description"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

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

                /**
                 * 
                 * 
                 * 
                 **/   
                mounted() {
                    console.log(this.evaluation)
                    this.setCurrentPunctuations();
                },

                /**
                 * 
                 * 
                 * 
                 **/   
                setCurrentPunctuations(){
                    this.subcategories.forEach(subcategory => {
                        subcategory.questions.forEach(question => {
                            question.current_value = question.answers[0] ? parseFloat(question.answers[0].punctuation) : 0
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
                    return question.answers[0] && question.answers[0].observation
                }
            }
        }

    </script>

</div>