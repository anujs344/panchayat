@component('mail::message')
# Hello

## Welcome to The Panchayat

<div style="text-align: center;font-weight:bold;color:orangered;margin-top:30px;">
Thanks for signing up to receive our emails.
</div>
<div style="text-align: center;font-weight:bold;color:orangered;">As a new member, you'll enjoy</div>

@component('mail::button', ['url' => route('home')])
Visit latest posts
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
