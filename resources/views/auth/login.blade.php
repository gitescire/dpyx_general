<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Iniciar sesión</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="dPyx">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{asset('css/kero.css')}}">

    <style>
        .bg-plum-plate{
            background: {{config('dpyx.auth_background_color')}} !important;
        }
        body{}
    </style>
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="h-100">
                <div class="d-flex h-100 justify-content-center align-items-center">
                    <div class="mx-auto app-login-box col-md-12">
                        <div class="mx-auto modal-dialog w-100">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <img src="{{url('images/logo.png')}}" width="80%" class="img-fluid align-items-center" alt="">
                                </div>
                            </div>
                            <div class="modal-content">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="modal-body" style="background-color:#065779;color:#ffffff;">
                                        <div class="text-center h5 modal-title">
                                            <h4 class="mt-2">
                                                    <x-jet-validation-errors class="mb-4" />
                                                <div>Bienvenido de regreso,</div>
                                                <span>Por favor inicia sesión con tu cuenta.</span>
                                                @if (session('status'))
                                                <div class="mb-4 text-sm font-medium text-green-600">
                                                    {{ session('status') }}
                                                </div>
                                                @endif
                                            </h4>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group"><input name="email" required
                                                        autofocus id="exampleEmail" placeholder="Correo electrónico"
                                                        type="email" class="form-control"></div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <input name="password" id="examplePassword" placeholder="Contraseña"
                                                        type="password" class="form-control" required
                                                        autocomplete="current-password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-relative form-check"><input name="remember"
                                                id="exampleCheck" type="checkbox" class="form-check-input"><label
                                                for="exampleCheck" class="form-check-label">Recordarme
                                                contraseña</label></div>
                                        {{-- <div class="divider"></div>
                                    <h6 class="mb-0">No account? <a href="javascript:void(0);" class="text-primary">Sign
                                            up now</a></h6> --}}
                                    </div>
                                    <div class="clearfix modal-footer" style="background-color:#5cbdd2;">
                                        @if (Route::has('password.request'))
                                        <div class="float-left">
                                            <a href="{{ route('password.request') }}"
                                                class="btn-lg btn btn-link">Recuperar
                                                contraseña</a>
                                        </div>
                                        @endif
                                        <div class="float-right">
                                            <button class="btn btn-lg" style="background-color:#b9bb2d;">Iniciar sesión</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                           {{-- <div class="mt-2 img2"><img src="{{ url('images/default/evaluation/banner.png') }}" width="1200px" class="img-fluid" alt=""></div> --}}

                        </div>
                        <div class="mt-3 text-center text-white opacity-8">dPyx - {{getenv('APP_NAME')}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>

</html>
