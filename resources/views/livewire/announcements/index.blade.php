<div class="mb-4">

    @section('header')
    <x-page-title title="Convocatorias"
        description="Este módulo permite adminsitrar las fechas permitidas para contestar las evaluaciones.">
    </x-page-title>
    @endsection

    @can('create announcements')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('announcements.create')}}" class="btn btn-success btn-wide btn-shadow rounded-0">
            <i class="fas fa-plus"></i> Agregar
        </a>
    </div>
    @endcan

    <div class="table-responsive shadow bg-white">
        <table class="table table-bordered m-0">
            <thead>
                <tr>
                    <th class="text-uppercase">ID</th>
                    <th class="text-uppercase">Fecha inicial</th>
                    <th class="text-uppercase">Fecha final</th>
                    <th class="text-uppercase">Status</th>
                    <th class="text-uppercase">motivo</th>
                    @canany(['edit announcements','delete announcements'])
                    <th class="text-uppercase">Acciones</th>
                    @endcanany
                </tr>
            </thead>
            <tbody>
                @foreach ($announcements as $announcement)
                <tr>
                    <td>{{$announcement->id}}</td>
                    <td>{{$announcement->initial_date}}</td>
                    <td>{{$announcement->final_date}}</td>
                    <td>
                        <span class="badge badge-{{$announcement->status_color}}">
                            {{$announcement->status}}
                        </span>
                    </td>
                    <td>{{$announcement->motive ?? 'N/A'}}</td>
                    @canany(['edit announcements','delete announcements'])
                    <td class="text-center">
                        @can('delete announcements')
                        <button type="button" class="btn btn-danger btn-shadow rounded-0" data-toggle="modal" data-target="#deleteAnnouncement{{$announcement->id}}">
                            <i class="fas fa-trash"></i>
                        </button>
                        <x-modals.announcements.delete :announcement="$announcement" />
                        @endcan
                        @can('edit announcements')
                        <a href="{{route('announcements.edit',[$announcement])}}"
                            class="btn btn-warning btn-shadow rounded-0">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <button type="button" class="btn btn-success btn-shadow rounded-0" data-toggle="modal" data-target="#modalSpecialDeadlineExtension" title="Personalizar fechas por repositorio">
                            <i class="fas fa-calendar-plus"></i>
                        </button>
                        <x-modals.announcements.deadline-extension
                            title="Extensión de recepción especial"
                            :announcement="$announcement"
                            :users="$users">
                        </x-modals.announcements.deadline-extension>
                        @endcan
                    </td>
                    @endcanany
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
