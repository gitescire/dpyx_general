<div class="mb-4">
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
                    {{-- <div class="col-12 mb-3">
                    <label for="" class="text-uppercase text-muted">
                        Rol
                    </label>
                    <input type="text" value="{{$user->roles()->first()->name}}" class="form-control"
                    {{$edit ? '' : 'disabled'}}>
                </div> --}}
            </div>
        </div>
</div>
@if ($edit)
<button class="btn btn-success btn-wide btn-shadow rounded-0 float-right">
    <i class="fas fa-save"></i> Guardar
</button>
@endif
</form>
</div>