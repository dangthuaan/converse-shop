<?php

if (!function_exists('cartQuantity')) {
    function cartQuantity()
    {
        $quantity = 0;

        if (auth()->check()) {
            if (session()->has('order_session')) {
                return session('order_session.quantity');
            }
        }

        return $quantity;
    }
}
