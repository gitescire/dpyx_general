<div class="mb-4">

    @section('header')
    <x-page-title title="Lista de repositorios"
        description="Este modulo permite listar los repositorios pertenecientes a los usuarios."></x-page-title>
    @endsection

    <div class="table-responsive shadow bg-white">
        <table class="table table-bordered m-0">
            <thead>
                <tr>
                    <th class="text-uppercase">Nombre</th>
                    <th class="text-uppercase">Encargado</th>
                    <th class="text-uppercase">Evaluador</th>
                    <th class="text-uppercase">Evaluación</th>
                    <th class="text-uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($repositories as $repository)
                <tr>
                    <td>{{$repository->name}}</td>
                    <td>{{$repository->responsible->name}}</td>
                    <td>{{$repository->evaluator ? $repository->evaluator->name : 'N/A'}}</td>
                    <td>
                        <a href="{{route('repositories.statistics.show',[$repository])}}" class="btn btn-info btn-shadow rounded-0 {{$repository->evaluation->answers->count() ? '' : 'disabled'}}">
                            <i class="fas fa-chart-pie"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#" class="btn btn-primary btn-shadow rounded-0">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>   
                @endforeach
            </tbody>
        </table>
    </div>

</div>
