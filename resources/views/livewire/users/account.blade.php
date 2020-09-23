<div class="mb-4">

    <div class="row">
        <div class="col12 col-lg-6">
            <div class="card shadow border-0">
                <div class="card-body">
                    <img src="{{asset('images/avatars/3.jpg')}}">
                </div>
            </div>
        </div>
        <div class="col12 col-lg-6">
            <div class="card shadow border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="" class="text-uppercase text-muted">
                                Nombre
                            </label>
                            <input type="text" value="{{$user->name}}" class="form-control" disabled>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="" class="text-uppercase text-muted">
                                E-mail
                            </label>
                            <input type="email" value="{{$user->email}}" class="form-control" disabled>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="" class="text-uppercase text-muted">
                                Teléfono
                            </label>
                            <input type="number" value="{{$user->phone}}" class="form-control" disabled>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="" class="text-uppercase text-muted">
                                Rol
                            </label>
                            <input type="text" value="{{$user->roles()->first()->name}}" class="form-control" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>