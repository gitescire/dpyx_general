@component('mail::message')
# {{$repository->name}}

El repositorio ha sido enviado con el status: {{$repository->status}}

@component('mail::button', ['url' => route('repositories.index')])
Ver repositorio
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
