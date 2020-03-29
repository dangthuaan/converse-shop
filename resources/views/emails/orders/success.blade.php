@component('mail::message')
# Order has been shipping!

<h1>YAY! Your order has shipped.</h1>
<p></p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
