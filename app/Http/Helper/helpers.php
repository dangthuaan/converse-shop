<?php

use App\Favorite;

if (!function_exists('cartQuantity')) {
    function cartQuantity()
    {
        $quantity = 0;

        if (session()->has('order_session')) {
            return session('order_session.quantity');
        }

        return $quantity;
    }
}

if (!function_exists('favoriteQuantity')) {
    function favoriteQuantity()
    {
        $userId = auth()->id();
        $favoriteCount = Favorite::where('user_id', $userId)->count();

        return $favoriteCount;
    }
}
