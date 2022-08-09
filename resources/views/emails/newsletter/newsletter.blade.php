@component('mail::message')
# Hello

<div style="margin: 30px; 0">
    {!! $content !!}
</div>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
