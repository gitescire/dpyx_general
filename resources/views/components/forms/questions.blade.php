<div>
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
                        <textarea name="description" cols="30" rows="2"
                            class="form-control">{{$question ? $question->description : ''}}</textarea>
                    </div>
                    {{--  --}}
                    <div class="col-12 mb-3">
                        <label for="" class="text-muted text-uppercase">
                            Opciones
                        </label>
                        <div class="card" x-data="data()" x-init="mounted()">
                            <div class="card-body">
                                <label for="" class="text-uppercase text-muted">Texto</label>
                                <input type="text" class="form-control" x-model="newOption.text">
                                <label for="" class="text-uppercase text-muted">Valor</label>
                                <input type="number" class="form-control" x-model="newOption.value">
                                <button class="btn btn-info btn-shadow rounded-0 mt-3" type="button"
                                    x-on:click="addOption()">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <hr>

                                <template x-for="option in options">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                                <input type="text" :name="`options[${option.position}][text]`" class="form-control" x-model="option.text">
                                        </div>
                                        <input type="text" class="form-control" :name="`options[${option.position}][value]`" x-model="option.value">
                                        <div class="input-group-append">
                                                <button class="btn btn-danger" x-on:click="deleteOption(option)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
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
                        <input type="number" value="{{$question ? $question->order : ''}}" name="order" min="0"
                            class="form-control">
                    </div>
                    {{--  --}}
                    <div class="col-12 mb-3">
                        <label for="" class="text-muted text-uppercase">
                            Categoría
                        </label>
                        <select name="category_id" class="form-control">
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
                        <select name="subcategory_id" class="form-control">
                            <option value="">seleccionar</option>
                            @foreach ($subcategories as $subcategory)
                            <option value="{{$subcategory->id}}"
                                {{$question && $question->subcategory->id == $subcategory->id ? 'selected' : ''}}>
                                {{$subcategory->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{--  --}}
                    <div class="col-12 mb-3">
                        <label for="" class="text-muted text-uppercase">
                            Puntuación máxima
                        </label>
                        <input type="number" value="{{$question ? $question->max_punctuation : ''}}"
                            name="max_punctuation" min="0" class="form-control">
                    </div>
                    {{--  --}}
                    <div class="col-12 mb-3">
                        <label for="" class="text-muted text-uppercase">
                            ¿Definida por concytec?
                        </label>
                        <input type="checkbox" {{$question && $question->is_optional ? 'checked' : ''}}
                            name="is_optional">
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

        options: [],

        newOption: {
            text: '',
            value: ''
        },

        lastPosition: 0,

        addOption(){
            this.lastPosition += 1

            this.options.push({
                position: this.lastPosition,
                text: this.newOption.text,
                value: this.newOption.value
            })

            this.newOption.text = ''
            this.newOption.value = ''
        },

        deleteOption(option){
            
        },

        mounted(){

        }

    }
}

    </script>
</div>