<div class="mb-4">

    @section('header')
    <x-page-title title="Lista de usuarios"
        description="Este módulo permite listar las preguntas que aparecerán en las evaluaciones."></x-page-title>
    @endsection

    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('questions.create')}}" class="btn btn-success btn-wide btn-shadow rounded-0">
            <i class="fas fa-plus"></i> Agregar
        </a>
    </div>

    <div class="table-responsive shadow bg-white mb-3">
        <table class="table m-0">
            <thead>
                <tr>
                    <th class="text-uppercase">ID</th>
                    <th class="text-uppercase">Descripción</th>
                    <th class="text-uppercase">Puntuación</th>
                    <th class="text-uppercase">Órden</th>
                    <th class="text-uppercase">Categoría</th>
                    <th class="text-uppercase">Subcategoría</th>
                    <th class="text-uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                <tr>
                    <td>{{$question->id}}</td>
                    <td>{{$question->description}}</td>
                    <td>Max. {{$question->max_punctuation}}%</td>
                    <td>{{$question->order}}</td>
                    <td>{{$question->category->name}}</td>
                    <td>{{$question->subcategory->name}}</td>
                    <td class="d-flex justify-content-between">
                        <form action="{{route('questions.destroy',[$question])}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-shadow rounded-0">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <a href="{{route('questions.edit',[$question])}}"
                            class="btn btn-warning btn-shadow rounded-0 ml-1">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{$questions->links()}}

</div>