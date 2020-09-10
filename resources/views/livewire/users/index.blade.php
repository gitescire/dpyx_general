<div>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('users.create')}}" class="btn btn-success btn-wide btn-shadow rounded-0">
            <i class="fas fa-plus"></i> Añadir
        </a>
    </div>

    <div class="table-responsive shadow">
        <table class="table table-bordered m-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th class="text-uppercase">Nombre</th>
                    <th class="text-uppercase">Rol</th>
                    <th class="text-uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>Admin</td>
                    <td>
                        <form action="" class="d-inline">
                            <button class="btn btn-danger rounded-0 btn-shadow">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <a href="#" class="btn btn-warning rounded-0 btn-shadow">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>