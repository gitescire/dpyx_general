<div class="modal fade" id="deleteCategory{{$categoryChoosed->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalAriaLabelledby" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('categories.destroy',[$categoryChoosed])}}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <h6 class="text-center text-uppercase">
                                <small>
                                    {{$categoryChoosed->name}}
                                </small>
                            </h6>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="card">
                                <span class="p-1">
                                    La categoría cuenta con preguntas que deben ser reasignadas a otra categoría
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="" class="text-uppercase text-muted">Reasignar categoría</label>
                            <select name="newCategory" class="form-control" required>
                                <option value="">seleccionar</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger btn-shadow rounded-0">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>