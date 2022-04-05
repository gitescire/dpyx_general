<div class="mb-4" x-data="data()">

    @section('header')
        <x-page-title title="Crear usuario" description="Este módulo permite registrar nuevos usuarios."></x-page-title>
    @endsection

    <x-backbutton>
        @slot('message','Lista de usuarios')
        @slot('redirect',route('users.index'))
    </x-backbutton>

    <div class="row d-flex justify-content-center">
        <div class="col-12 col-lg-6">
            <x-forms.users/>
        </div>
    </div>

</div>
