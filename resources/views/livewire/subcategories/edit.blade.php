<div class="mb-4">

    <x-backbutton>
        @slot('message','Lista de subcategorías')
        @slot('redirect',route('subcategories.index'))
    </x-backbutton>

    <div class="row d-flex justify-content-center">
        <div class="col-12 col-lg-4">
            <x-forms.subcategories :subcategory="$subcategory" />
        </div>
    </div>

</div>
