@component('mail::message')
# {{$repository->name}}

{{$comments}}

@component('mail::button', ['url' => route('repositories.index')])
Ver repositorio
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
