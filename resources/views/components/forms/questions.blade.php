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
                    <textarea name="description" cols="30" rows="2" class="form-control">{{$question ? $question->description : ''}}</textarea>
                </div>
                {{--  --}}
                <div class="col-12 mb-3">
                    <label for="" class="text-muted text-uppercase">
                        Órden
                    </label>
                    <input type="number" value="{{$question ? $question->order : ''}}" name="order" min="0" class="form-control">
                </div>
                {{--  --}}
                <div class="col-12 mb-3">
                    <label for="" class="text-muted text-uppercase">
                        Categoría
                    </label>
                    <select name="category_id" class="form-control">
                        <option value="">seleccionar</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}" {{$question && $question->category->id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
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
                        <option value="{{$subcategory->id}}" {{$question && $question->subcategory->id == $subcategory->id ? 'selected' : ''}}>{{$subcategory->name}}</option>
                        @endforeach
                    </select>
                </div>
                {{--  --}}
                <div class="col-12 mb-3">
                    <label for="" class="text-muted text-uppercase">
                        Puntuación máxima
                    </label>
                    <input type="number" value="{{$question ? $question->max_punctuation : ''}}" name="max_punctuation" min="0" class="form-control">
                </div>
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
                    <input type="checkbox" {{$question && $question->has_description_field ? 'checked' : ''}} name="has_description_field">
                </div>
                {{--  --}}
                <div class="col-12 mb-3">
                    <label for="" class="text-muted text-uppercase">
                        Texto en marca de agua
                    </label>
                    <textarea name="description_label" cols="30" rows="2" class="form-control">{{$question ? $question->description_label : ''}}</textarea>
                </div>
                {{--  --}}
                <div class="col-12 mb-3">
                    <label for="" class="text-muted text-uppercase">
                        Texto de ayuda
                    </label>
                    <textarea name="help_text" cols="30" rows="2" class="form-control">{{$question ? $question->help_text : ''}}</textarea>
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