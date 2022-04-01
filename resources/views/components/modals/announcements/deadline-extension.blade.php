<div wire:ignore.self id="modalSpecialDeadlineExtension" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">{{$title}}</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 text-center">
                    <span>{{$announcement->motive}}</span>
                    </div>
                </div>
                <div class="row d-flext justify-content-between mb-3">
                    <div class="col-12 col-lg-4">
                        <x-input-search />
                    </div>
                </div>
                <div class="table-responsive shadow mb-3 bg-white">
                    <table id="table" class="table table-bordered m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-uppercase">Nombre</th>
                                <th class="text-uppercase">Correo</th>
                                <th class="text-uppercase">Repositorio</th>
                                <th class="text-uppercase">Extensión de fecha final</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)

                            @php
                            $userHasDateExtension = false;
                            foreach($announcementRepository as $userDateExtension){
                                $userDateExtension = $userDateExtension->repository->responsible;
                                if($userDateExtension->id === $user->id){
                                    $userHasDateExtension = true;
                                }
                            }

                            @endphp

                            @if(!$userHasDateExtension && $user->has_repositories)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->repositories ? $user->repositories->first()->name : '-'}}</td>
                                <td>
                                    <form action="{{ route('announcementrepository.store', [$announcement,$user->repositories->first()]) }}" method="POST">
                                        @csrf
                                        <input type="date" name="extended_final_date" min="{{$announcement->final_date}}" value="{{$announcement->final_date}}">
                                        <button class="btn btn-success btn-shadow btn-sm rounded-0">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-12">
                        <h5>Usuarios con fechas extendidas</h5>
                        <hr>
                    </div>
                </div>

                @if(sizeof($announcementRepository) == 0)
                <div class="row">
                    <div class="col-12 text-center">
                        <h6>Esta convocatoria no tiene usuarios con fechas extendidas</h6>
                    </div>
                </div>

                @else
                <div class="table-responsive shadow mb-3 bg-white">
                    <table id="table" class="table table-bordered m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-uppercase">Nombre</th>
                                <th class="text-uppercase">Correo</th>
                                <th class="text-uppercase">Repositorio</th>
                                <th class="text-uppercase">Extensión de fecha final</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($announcementRepository as $user)

                            @php
                            $repositoryData = $user->repository;
                            $userData = $user->repository->responsible;
                            @endphp

                            <tr>
                                <td>{{$userData->id}}</td>
                                <td>{{$userData->name}}</td>
                                <td>{{$userData->email}}</td>
                                <td>{{$repositoryData->name}}</td>
                                <td>
                                    <form action="{{ route('announcementrepository.update',[$user->id]) }}" method="POST" style="display:inline-block;">
                                        @method('PATCH')
                                        @csrf
                                        <input type="date" name="extended_final_date" min="{{$announcement->final_date}}" value="{{$user->extended_final_date}}">
                                        <button type="submit" class="btn btn-warning btn-shadow btn-sm rounded-0">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('announcementrepository.destroy',[$user->id]) }}" method="POST" style="display:inline-block;">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-shadow btn-sm rounded-0">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-shadow rounded-0" data-dismiss="modal">
                    <i class="fas fa-window-close"></i>
                </button>
            </div>
        </div>
    </div>
</div>
