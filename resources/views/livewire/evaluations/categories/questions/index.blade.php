<div class="mb-4">

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
                                                                    <span x-text="getTotalPunctuation(subcategory) + '%'"></span>
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
                                                <th>Pregunta</th>
                                                <th>Puntuación</th>
                                                <th>Respuestas</th>
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
                                                            class="form-control" x-model="question.current_value" :disabled="!evaluation.is_answerable">
                                                            <option value="0">seleccionar</option>
                                                            <option x-bind:value="parseFloat(question.max_punctuation)"
                                                                x-bind:selected="question.answers[0] && parseFloat(question.answers[0].punctuation) == parseFloat(question.max_punctuation) ? true : false">
                                                                Sí</option>
                                                            <option x-bind:value="-parseFloat(question.max_punctuation)"
                                                                x-bind:selected="question.answers[0] && parseFloat(question.answers[0].punctuation) == -parseFloat(question.max_punctuation) ? true : false">
                                                                No</option>
                                                        </select>
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
        <template x-if="evaluation.is_answerable">
            <div class="d-flex justify-content-end">
                <button class="btn btn-success btn-shadow btn-wide rounded-0">
                    <i class="fas fa-save"></i> Continuar
                </button>
            </div>
        </template>
    </form>
</div>



    <script>
        function data(){
            return {
                evaluation: @json($evaluation),
                subcategories: @json($subcategories),

                mounted() {
                    this.setCurrentPunctuations();
                    console.log(this.subcategories)
                },

                setCurrentPunctuations(){
                    this.subcategories.forEach(subcategory => {
                        subcategory.questions.forEach(question => {
                            question.current_value = question.answers[0] ? parseFloat(question.answers[0].punctuation) : 0
                        });
                    });
                },

                getTotalPunctuation(subcategory){
                    total = 0;
                    subcategory.questions.forEach(question => {
                        total += parseFloat(question.current_value)
                    });
                    console.log(total)
                    return total
                },

                getTotalMaxPunctuation(subcategory){
                    total = 0;
                    subcategory.questions.forEach(question => {
                        total += parseFloat(question.max_punctuation)
                    });
                    return total
                }
            }
        }

    </script>

</div>