<div x-data="data()" x-init="mounted()">
    <form action="{{$question ?  route('questions.update',[$question]) : route('questions.store')}}" method="POST">
        @csrf
        @if ($question) @method('PUT') @endif
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="row">
                    {{--  --}}
                    <div class="col-12 mb-3">
                        <label for="" class="text-muted text-uppercase">
                            Pregunta
                        </label>
                        <textarea name="description" cols="30" rows="2" required
                            class="form-control">{{$question ? $question->description : ''}}</textarea>
                    </div>
                    {{--  --}}
                    <div class="col-12 mb-3">
                        <label for="" class="text-muted text-uppercase">
                            Opciones
                        </label>
                        <div class="card" >
                            <div class="card-body">

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        {{-- <label for="" class="text-uppercase text-muted">Texto</label><br> --}}
                                        <input type="text" placeholder="texto" class="form-control" x-model="newOption.description">
                                    </div>
                                    {{-- <label for="" class="text-uppercase text-muted">Valor</label><br> --}}
                                    <input type="number" placeholder="valor" class="form-control ml-1" x-model="newOption.punctuation">
                                    <div class="input-group-append ml-1">
                                        <button class="btn btn-info btn-shadow rounded-0" type="button"
                                            x-on:click="addOption()" x-ref="addButton">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>

                                </div>


                                {{-- <label for="" class="text-uppercase text-muted">Valor</label>
                                <input type="number" class="form-control" x-model="newOption.punctuation">
                                <button class="btn btn-info btn-shadow rounded-0 mt-3" type="button"
                                    x-on:click="addOption()" x-ref="addButton">
                                    <i class="fas fa-plus"></i>
                                </button> --}}
                                <hr>

                                <template x-for="option in options">
                                    {{-- <span x-text="option.id"></span> --}}
                                    <div class="input-group mb-3">
                                        <input type="hidden" :name="`options[${option.punctuation}][id]`"
                                            x-model="option.id" required>
                                        <div class="input-group-prepend">
                                            <input type="text" :name="`options[${option.punctuation}][description]`"
                                                class="form-control" x-model="option.description" required>
                                        </div>
                                        <input type="text" class="form-control ml-1"
                                            :name="`options[${option.punctuation}][punctuation]`"
                                            x-model="option.punctuation">
                                        <template x-if="!option.id">
                                            <div class="input-group-append ml-1">
                                                <button type="button" class="btn btn-danger btn-shadow rounded-0"
                                                    x-on:click="deleteOption(option)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </template>
                                    </div>
                                </template>

                            </div>
                        </div>
                    </div>
                    {{--  --}}
                    <div class="col-12 mb-3">
                        <label for="" class="text-muted text-uppercase">
                            Órden
                        </label>
                        <input type="number" value="{{$question ? $question->order : ''}}" name="order" min="1"
                            class="form-control" required>
                    </div>
                    {{--  --}}
                    <div class="col-12 mb-3">
                        <label for="" class="text-muted text-uppercase">
                            Categoría
                        </label>
                        <select name="category_id" class="form-control" required>
                            <option value="">seleccionar</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}"
                                {{$question && $question->category->id == $category->id ? 'selected' : ''}}>
                                {{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{--  --}}
                    <div class="col-12 mb-3">
                        <label for="" class="text-muted text-uppercase">
                            Subcategoría
                        </label>
                        <select name="subcategory_id" class="form-control" required>
                            <option value="">seleccionar</option>
                            @foreach ($subcategories as $subcategory)
                            <option value="{{$subcategory->id}}"
                                {{$question && $question->subcategory->id == $subcategory->id ? 'selected' : ''}}>
                                {{-- {{$question->subcategory->id}} {{$subcategory->id}} </option> --}}
                                {{$subcategory->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{--  --}}
                    {{-- <div class="col-12 mb-3">
                        <label for="" class="text-muted text-uppercase">
                            Puntuación máxima
                        </label>
                        <input type="number" value="{{$question ? $question->max_punctuation : ''}}"
                    name="max_punctuation" min="0" class="form-control">
                </div> --}}
                {{--  --}}
                <div class="col-12 mb-3">
                    <label for="" class="text-muted text-uppercase">
                        ¿Definida por concytec?
                    </label>
                    <input type="checkbox" {{$question && $question->is_optional ? 'checked' : ''}} name="is_optional">
                </div>
                {{--  --}}
                <div class="col-12 mb-3">
                    <label for="" class="text-muted text-uppercase">
                        ¿Incluir campo para capturar texto?
                    </label>
                    <input type="checkbox" {{$question && $question->has_description_field ? 'checked' : ''}}
                        name="has_description_field">
                </div>
                {{--  --}}
                <div class="col-12 mb-3">
                    <label for="" class="text-muted text-uppercase">
                        Texto en marca de agua
                    </label>
                    <textarea name="description_label" cols="30" rows="2"
                        class="form-control">{{$question ? $question->description_label : ''}}</textarea>
                </div>
                {{--  --}}
                <div class="col-12 mb-3">
                    <label for="" class="text-muted text-uppercase">
                        Texto de ayuda
                    </label>
                    <textarea name="help_text" cols="30" rows="2"
                        class="form-control">{{$question ? $question->help_text : ''}}</textarea>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-success btn-wide btn-shadow rounded-0">
                <i class="fas fa-save"></i> Guardar
            </button>
        </div>
</div>
</form>

<script>
    function data(){
    return {

        question: @json($question),
        options: @json($choices),
        categories: @json($categories),
        subcategories: @json($subcategories),
        allQuestions: @json($allQuestions),

        categoryChoosedId: null,
        subcategoryChoosedId: null,

        newOption: {
            description: '',
            punctuation: ''
        },

        // isTheMaximumPercentageExceeded(){

        //     questions = _.filter(this.allQuestions, (question) => question.category_id == this.categoryChoosedId);
        //     questions = _.filter(questions, (question) => question.subcategory_id == this.subcategoryChoosedId);
        //     questions = _.filter(questions, (question) => this.question ? question.id != this.question.id : question);

        //     console.log(questions);
        //     return true;

        // },

        addOption(){
            
            this.options.push({
                id: '',
                description: this.newOption.description,
                punctuation: this.newOption.punctuation
            })

            this.newOption.description = ''
            this.newOption.punctuation = ''

            if(this.options.length >= 5){
                this.$refs.addButton.disabled = true;
            }

            this.sortOptions()
        },

        deleteOption(optionToTrash){
            deleted = _.remove(this.options, function(option){
                return option.punctuation == optionToTrash.punctuation
            })

            if(this.options.length < 5){
                this.$refs.addButton.disabled = false;
            }

            this.sortOptions()

        },

        sortOptions(){
            this.options = _.sortBy(this.options, function(option){
                return option.punctuation
            }).reverse()
        },

        mounted(){

        }

    }
}

</script>
</div>