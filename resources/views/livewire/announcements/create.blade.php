<div class="mb-4">

    @section('header')
        <x-page-title title="Crear convocatoria" description="Este módulo permite generar fechas válidas para contestar las evaluaciones."></x-page-title>
    @endsection

    <x-backbutton>
        @slot('message','Lista de convocatorias')
        @slot('redirect',route('announcements.index'))
    </x-backbutton>

    <div class="row d-flex justify-content-center">
        <div class="col-12 col-lg-6">
            <x-forms.announcements/>
        </div>
    </div>

</div>
