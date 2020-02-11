@component('mail::message')
# Order success!

<h1>YAY! Your order has shipped.</h1>
<p></p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
