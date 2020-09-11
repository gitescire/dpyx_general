<div class="mb-4">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-lg-6">
            <form action="{{route('users.update',[$user])}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="" class="text-muted text-uppercase">Nombre</label>
                                <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{$user->name}}" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="" class="text-muted text-uppercase">Correo</label>
                                <input type="email" name="email" class="form-control" placeholder="Correo" value="{{$user->email}}" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="" class="text-muted text-uppercase">Teléfono</label>
                                <input type="number" name="phone" minlength="10" class="form-control"
                                    placeholder="Teléfono" value="{{$user->phone}}">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="" class="text-muted text-uppercase">Roles</label>
                                <select name="role" id="" class="form-control" required>
                                    <option value="">seleccionar</option>
                                    @foreach ($roles as $role)
                                    <option value="{{$role->id}}" {{$user->roles()->first()->id == $role->id ? 'selected' : ''}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-success btn-wide rounded-0 btn-shadow">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>