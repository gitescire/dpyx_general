@component('mail::message')
# El repositorio {{$repository->name}} tiene el status: {{$repository->status}}.

{{$comments}}

@component('mail::button', ['url' => route('repositories.index')])
Ver repositorio
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
