<div class="mb-4">

    @section('header')
        <x-page-title title="Lista de usuarios" description="Este módulo permite ver la información de los usuarios actualmente registrados."></x-page-title>
    @endsection

    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('users.create')}}" class="btn btn-success btn-wide btn-shadow rounded-0">
            <i class="fas fa-plus"></i> Añadir
        </a>
    </div>

    <div class="table-responsive shadow mb-3 bg-white">
        <table class="table table-bordered m-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th class="text-uppercase">Nombre</th>
                    <th class="text-uppercase">Correo</th>
                    <th class="text-uppercase">Teléfono</th>
                    <th class="text-uppercase">Rol</th>
                    <th class="text-uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->roles()->first()->name}}</td>
                    <td>
                        <form action="{{route('users.destroy',[$user])}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger rounded-0 btn-shadow">
                                <span data-toggle="tooltip" title="Eliminar" wire:ignore.self>
                                    <i class="fas fa-trash"></i>
                                </span>
                            </button>
                        </form>
                        <a href="{{route('users.edit',[$user])}}" class="btn btn-warning rounded-0 btn-shadow">
                            <span data-toggle="tooltip" title="Editar" wire:ignore.self>
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="">
        {{$users->links()}}
    </div>


</div>