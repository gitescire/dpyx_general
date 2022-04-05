<div class="mb-4">
    @section('header')
    <x-page-title title="Cuenta de usuario" description="Este módulo permite editar tu información de usuario.">
    </x-page-title>
    @endsection
    <x-backbutton>
        @slot('message','Cuenta de usuario')
        @slot('redirect',route('users.account'))
    </x-backbutton>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-lg-6">
            <div class="row">
                <div class="col-12">
                    <x-forms.account :edit="true" />
                </div>
            </div>
        </div>
    </div>
</div>
