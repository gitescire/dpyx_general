<div class="mb-4">

    @section('header')
    <x-page-title title="Crear categoría"
        description="Este módulo permite generar nuevas categorías para las evaluaciones."></x-page-title>
    @endsection

    <x-backbutton>
        @slot('message','Lista de categorías')
        @slot('redirect',route('categories.index'))
    </x-backbutton>

    <div class="row d-flex justify-content-center">
        <div class="col-12 col-lg-4">
            <form action="{{route('categories.store')}}" method="POST">
                @csrf
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="" class="text-muted text-uppercase">Nombre</label>
                                <input type="text" name="name" maxlength="80" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label for="" class="text-muted text-uppercase">Nombre corto</label>
                                <input type="text" name="short_name" maxlength="20" class="form-control" maxlength="20"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="{{route('categories.index')}}" class="btn btn-outline-danger btn-shadow rounded-0 mr-3">
                            <i class="fas fa-window-close"></i> Cancelar
                        </a>
                        <button class="btn btn-success btn-wide btn-shadow rounded-0">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
