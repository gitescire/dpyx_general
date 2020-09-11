<div class="mb-4">

    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('questions.create')}}" class="btn btn-success btn-wide btn-shadow rounded-0">
            <i class="fas fa-plus"></i> Agregar
        </a>
    </div>

    <div class="table-responsive shadow">
        <table class="table m-0">
            <thead>
                <tr>
                    <th class="text-uppercase">ID</th>
                    <th class="text-uppercase">Descripción</th>
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
                    <td>{{$question->order}}</td>
                    <td>{{$question->category->name}}</td>
                    <td>{{$question->subcategory->name}}</td>
                    <td>
                        <form action="{{route('questions.destroy',[$question])}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-shadow rounded-0">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <a href="{{route('questions.edit',[$question])}}" class="btn btn-warning btn-shadow rounded-0">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>