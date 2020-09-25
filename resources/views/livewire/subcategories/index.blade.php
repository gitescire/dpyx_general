<div class="mb-4">

    @section('header')
    <x-page-title title="Lista de subcategorias"
        description="Este módulo permite listar las subcategorías que aparecerán en las evaluaciones."></x-page-title>
    @endsection

    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('subcategories.create')}}" class="btn btn-success btn-wide btn-shadow rounded-0">
            <i class="fas fa-plus"></i> Agregar
        </a>
    </div>

    <div class="table-responsive shadow bg-white">
        <table class="table m-0">
            <thead>
                <tr>
                    <th class="text-uppercase">ID</th>
                    <th class="text-uppercase">Nombre</th>
                    <th class="text-uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subcategories as $subcategory)
                <tr>
                    <td>{{$subcategory->id}}</td>
                    <td>{{$subcategory->name}}</td>
                    <td>
                        <form action="{{route('subcategories.destroy',[$subcategory])}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-shadow rounded-0">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <a href="{{route('subcategories.edit',[$subcategory])}}"
                            class="btn btn-warning btn-shadow rounded-0">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>