<div class="mb-4">

    @section('header')
        <x-page-title title="Crear subcategoría" description="Este módulo permite registrar nuevas categorías para las evaluaciones."></x-page-title>
    @endsection
    <x-backbutton>
        @slot('message','Lista de subcategorías')
        @slot('redirect',route('subcategories.index'))
    </x-backbutton>

    <div class="row d-flex justify-content-center">
        <div class="col-12 col-lg-4">
           <x-forms.subcategories/>
        </div>
    </div>

</div>
