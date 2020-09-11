<div class="mb-4">

    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('categories.create')}}" class="btn btn-success btn-wide btn-shadow rounded-0">
            <i class="fas fa-plus"></i> Agregar
        </a>
    </div>

    <div class="table-responsive shadow">
        <table class="table table-bordered m-0">
            <thead>
                <tr>
                    <th class="text-uppercase">#</th>
                    <th class="text-uppercase">Nombre</th>
                    <th class="text-uppercase">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>
                        <form action="{{route('categories.destroy',[$category])}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-shadow rounded-0">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <a href="{{route('categories.edit',[$category])}}" class="btn btn-warning btn-shadow rounded-0">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>