@component('mail::message')
# Favorite product updated!

<p style="size: 1.2em">Your favorite product [<strong>{{ $product->name }}</strong>]'s price/sale has been updated! Let's check it out!</p>
<p></p>

<br>
We hope you enjoy it! ,<br>
{{ config('app.name') }}
@endcomponent
