@component('mail::message')
# Order success!

<h1>Your order is confirmed.</h1>
<h3>Order ID: {{ $order->id }}</h3>
<h3>Order Total price: {{ $order->total_price }} </h3>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
