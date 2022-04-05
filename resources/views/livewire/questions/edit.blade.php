<div class="mb-4">

    @section('header')
    <x-page-title title="Editar pregunta"
        description="Este módulo permite modificar la información la pregunta seleccionada."></x-page-title>
    @endsection

    <x-backbutton>
        @slot('message','Lista de preguntas')
        @slot('redirect',route('questions.index'))
    </x-backbutton>

    <div class="row d-flex justify-content-center">
        <div class="col-12 col-lg-6">
            <x-forms.questions :question="$question"/>
        </div>
    </div>


</div>
