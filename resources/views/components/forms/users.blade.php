<form action="{{$user ? route('users.update',[$user]) :route('users.store')}}" method="POST">
    @csrf
    @if ($user)
    @method('PUT')
    @endif
    <div class="card border-0 shadow" x-data="data()">
        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="" class="text-muted text-uppercase">Nombre</label>
                    <input type="text" value="{{$user ? $user->name : ''}}" name="name" class="form-control"
                        placeholder="Nombre" required>
                </div>
                <div class="col-12 mb-3">
                    <label for="" class="text-muted text-uppercase">Correo</label>
                    <input type="email" value="{{$user ? $user->email : ''}}" name="email" class="form-control"
                        placeholder="Correo" required>
                </div>
                @if (is_null($user))
                <div class="col-12 mb-3">
                    <label for="" class="text-muted text-uppercase">Contraseña</label>
                    <input type="password" name="password" minlength="8" class="form-control" placeholder="********"
                        required>
                </div>
                <div class="col-12 mb-3">
                    <label for="" class="text-muted text-uppercase">Confirmar contraseña</label>
                    <input type="password" name="confirm_password" minlength="8" class="form-control"
                        placeholder="********" required>
                </div>
                @endif
                <div class="col-12 mb-3">
                    <label for="" class="text-muted text-uppercase">Teléfono</label>
                    <input type="number" value="{{$user ? $user->phone : ''}}" name="phone" minlength="10"
                        class="form-control" placeholder="Teléfono">
                </div>
                <div class="col-12 mb-3">
                    <label for="" class="text-muted text-uppercase">Roles</label>
                    <select name="role" x-ref="roles" x-on:change="checkIfIsUser($refs.roles)" class="form-control"
                        required>
                        <option value="">seleccionar</option>
                        @foreach ($roles as $role)
                        <option value="{{$role->id}}" {{$user && $user->hasRole($role->id) ? 'selected' : ''}}>
                            {{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <template x-if="isUser">
                    <div class="col-12 mb-3">
                        <label for="" class="text-muted text-uppercase">Nombre del repositorio</label>
                        <input type="text" name="repository_name" class="form-control"
                            value="{{$user && $user->hasRole('usuario') && $user->has_repositories ? $user->repositories()->first()->name : ''}}"
                            required>
                    </div>
                </template>
                @if ( config('app.is_evaluable') )
                <template x-if="isUser">
                    <div class="col-12 mb-3">
                        <label for="" class="text-muted text-uppercase">Evaluador</label>
                        <select name="evaluator_id" id="" class="form-control" required>
                            <option value="">seleccionar</option>
                            @foreach ($evaluators as $evaluator)
                            <option value="{{$evaluator->id}}"
                                {{$user && $user->hasRole('usuario') && $user->repositories()->first()->evaluation->evaluator->id == $evaluator->id ? 'selected' : '' }}>
                                {{$evaluator->name}}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text" name="repository_name" class="form-control" value="{{$user ? 'usuario' : ''}}"
                        required> --}}
                    </div>
                </template>
                @endif
                @if ($user)
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="change_password" class="custom-control-input" id="changePassword" x-model="changePassword">
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
                                            <input type="password" class="form-control" name="new_password_repeated">
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
        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-success btn-wide rounded-0 btn-shadow">
                <i class="fas fa-save"></i> Guardar
            </button>
        </div>
    </div>

    <script>
        function data(){
        return {
            changePassword: false,
            isUser: parseInt({{$user && $user->hasRole('usuario') ? 1 : 0}}),
            checkIfIsUser(rolesInput){
                role = rolesInput.options[rolesInput.selectedIndex].text
                this.isUser = role == 'usuario' ? 1 : 0
            },
        }
    }
    </script>

</form>