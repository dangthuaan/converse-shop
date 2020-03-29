@component('mail::message')
# Order closed!

<h1>Your order is closed.</h1>
<h3 style="display: inline;">Reason:</h3> {{ $reason }}

<br>
<br>
We're sorry about that,<br>
{{ config('app.name') }}
@endcomponent
