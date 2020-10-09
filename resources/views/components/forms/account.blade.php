<div class="mb-4" x-data="data()">
    <form action="{{route('users.account.store',[$user])}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card shadow border-0 mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <img src="{{$user->profile_photo_path ? asset('storage/'.$user->profile_photo_path) : asset('images/avatars/3.jpg')}}"
                            class="mb-3 p-1 border">
                        @if ($edit)
                        <div class="custom-file">
                            <input name="file" type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">seleccionar</label>
                        </div>
                        @endif
                    </div>
                    <div class="col-12 mb-3">
                        <label for="" class="text-uppercase text-muted">
                            Nombre
                        </label>
                        <input name="name" type="text" value="{{$user->name}}" class="form-control"
                            {{$edit ? '' : 'disabled'}}>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="" class="text-uppercase text-muted">
                            E-mail
                        </label>
                        <input name="email" type="email" value="{{$user->email}}" class="form-control"
                            {{$edit ? '' : 'disabled'}}>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="" class="text-uppercase text-muted">
                            Teléfono
                        </label>
                        <input name="phone" type="number" value="{{$user->phone}}" class="form-control"
                            {{$edit ? '' : 'disabled'}}>
                    </div>

                    {{-- CHECKBOX TO REQUEST FOR A PASSWORD CHANGE   --}}

                    @if ($edit)
                    <div class="col-12 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="change_password" class="custom-control-input"
                                        id="changePassword" x-model="changePassword">
                                    <label class="custom-control-label text-uppercase text-muted" for="changePassword">
                                        ¿Cambiar contraseña?
                                    </label>
                                    <template x-if="changePassword">
                                        <div class="row mt-3">
                                            <div class="col-12 mb-3">
                                                <label for="" class="text-uppercase text-muted">
                                                    Contraseña actual
                                                </label>
                                                <input type="password" class="form-control" name="current_password">
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="" class="text-uppercase text-muted">
                                                    Nueva contraseña
                                                </label>
                                                <input type="password" class="form-control" name="new_password">
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="" class="text-uppercase text-muted">
                                                    Repetir contraseña
                                                </label>
                                                <input type="password" class="form-control"
                                                    name="new_password_repeated">
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
        @if ($edit)
        <button class="btn btn-success btn-wide btn-shadow rounded-0 float-right">
            <i class="fas fa-save"></i> Guardar
        </button>
        @endif
    </form>

    <script>
        function data(){
            return {
                changePassword: false,
            }
}
    </script>

</div>