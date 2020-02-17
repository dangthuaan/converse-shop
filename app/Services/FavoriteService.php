<?php

namespace App\Services;

use App\Product;
use App\Favorite;
use Illuminate\Support\Facades\Log;

class FavoriteService
{
    /**
     * Get Order by Id.
     *
     * @param  int  $id
     * @return Model
     */
    public function getProductById($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Check product is in favorite list.
     *
     * @param  int  $id
     * @return Model
     */
    public function checkFavoriteProduct($id)
    {
        return Favorite::where('product_id', $id)->exists();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createFavoriteData($data)
    {
        try {
            Favorite::create($data);
        } catch (\Exception $e) {
            Log::error($e);

            return false;
        }

        return true;
    }
}
