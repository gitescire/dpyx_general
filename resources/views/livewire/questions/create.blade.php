<div class="mb-4">

    @section('header')
        <x-page-title title="Crear pregunta" description="Este módulo permite registrar una nueva pregunta para las evaluaciones."></x-page-title>
    @endsection

    <x-backbutton>
        @slot('message','Lista de preguntas')
        @slot('redirect',route('questions.index'))
    </x-backbutton>

    <div class="row d-flex justify-content-center">
        <div class="col-12 col-lg-6">
            <x-forms.questions/>
        </div>
    </div>

</div>
