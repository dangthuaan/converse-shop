@component('mail::message')

<h1 style="color:red;">You have been banned!</h1>
<h3 style="display: inline;">Reason:</h3> {{ $reason }}

<br>
<br>
We're sorry about that,<br>
{{ config('app.name') }}
@endcomponent
