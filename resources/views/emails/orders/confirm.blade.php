@component('mail::message')
# Order success!

<h1>Your order is confirmed.</h1>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
