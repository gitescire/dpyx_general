<div class="mb-4">

   @section('header')
       <x-page-title title="Convocatorias" description="Este módulo permite adminsitrar las fechas permitidas para contestar las evaluaciones."></x-page-title>
   @endsection

    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('announcements.create')}}" class="btn btn-success btn-wide btn-shadow rounded-0">
            <i class="fas fa-plus"></i> Agregar
        </a>
    </div>

    <div class="table-responsive shadow bg-white">
        <table class="table table-bordered m-0">
            <thead>
                <tr>
                    <th class="text-uppercase">ID</th>
                    <th class="text-uppercase">Fecha inicial</th>
                    <th class="text-uppercase">Fecha final</th>
                    <th class="text-uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($announcements as $announcement)
                <tr>
                    <td>{{$announcement->id}}</td>
                    <td>{{$announcement->initial_date}}</td>
                    <td>{{$announcement->final_date}}</td>
                    <td>
                        <form action="{{route('announcements.destroy',[$announcement])}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-shadow rounded-0">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <a href="{{route('announcements.edit',[$announcement])}}"
                            class="btn btn-warning btn-shadow rounded-0">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>