<div class="mb-4">

    <div class="table-responsive shadow">
        <table class="table table-bordered m-0">
            <thead>
                <tr>
                    <th class="text-uppercase">Nombre</th>
                    <th class="text-uppercase">Encargado</th>
                    <th class="text-uppercase">Evaluador</th>
                    <th class="text-uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($repositories as $repository)
                <tr>
                    <td>{{$repository->name}}</td>
                    <td>{{$repository->responsible->name}}</td>
                    <td>{{$repository->evaluator ? $repository->evaluator->name : ''}}</td>
                    <td></td>
                </tr>   
                @endforeach
            </tbody>
        </table>
    </div>

</div>
